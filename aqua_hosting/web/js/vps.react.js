var OSystemSection = React.createClass({
    getInitialState: function() {
        return {
            osystems: [],
            cpanels: [],
            database: [],
            remote_backups: [],
            cpu_unit_price: 0,
            ram_unit_price: 0,
            hd_unit_price: 0,
            ip_unit_price: 0
        }
    },

    componentDidMount: function() {
        this.loadOSystemsFromServer(0);
        setInterval(this.loadOSystemsFromServer(1), 2000);
        this.loadHidden();
        this.loadSubmit();
    },
    reloadDB: function(db) {
        var database_list = [];
        var i = [];
        for (var x in db) {
            var databases = db[x];
            for (var i in databases) {
                database_list.push(databases[i]);
            }
        }
        return database_list;
    },
    loadOSystemsFromServer: function(initrun) {
        $.ajax({
            url: this.props.url,
            success: function(data) {
                this.setState({
                    osystems: data.osystems,
                    cpanels: data.cpanels,
                    database: data.databases,
                    remote_backups: data.remote_backups,
                    cpu_unit_price: data.packages['cpu'].price,
                    ram_unit_price: data.packages['ram'].price,
                    hd_unit_price: data.packages['hd'].price,
                    ip_unit_price: data.packages['ip'].price
                });
                this.loadRemoteBackups(this.state.remote_backups);
                this.loadIp();
                if (initrun == 0) {
                    this.reactPrice();
                }
            }.bind(this)
        });

    },
    check_submit_enable: function() {
        var check_validate = true;
        if ($("#package_message").html().length > 0 && $("#os").val() > 0) {
            check_validate = false;
        }
        $("#submit_button").prop("disabled", check_validate);
        $("#link_submit").prop("disabled", check_validate);
    },
    /* reactPrice */
    getVPSPrice: function(n_Id, element) {
        var data_array = [];
        switch (element) {
            case 'cpanel':
                data_array = this.state.cpanels;
                break;
            case 'database':
                data_array = this.reloadDB(this.state.database);
                break;
            case 'remote':
                data_array = this.state.remote_backups;
                break;
        }
        if (data_array === undefined) {
            data_array = [];
        }
        var result = 0;
        for (var i in data_array) {
            if (data_array[i].id == n_Id) {
                result = data_array[i].price;
            }
        }
        return result;
    },
    getControl: function(s_controlId) {
        return $('#' + s_controlId);
    },
    getValue: function(s_controlId) {
        var result = 0;

        var o_control = this.getControl(s_controlId);
        if (o_control.length > 0) {
            result = o_control.val();
        }
        return result;
    },
    calc_ip_price: function(n_ips) {
        return (n_ips >= 2)
            ? (n_ips - 1) * this.state.ip_unit_price
            : 0;
    },
    roundNumber: function(num, dec) {
        return Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
    },
    updateLineItem: function(s_controlId, s_boundId, n_unitPrice) {
        var n_units = this.getValue(s_controlId);
        var total = this.roundNumber(n_units * n_unitPrice, 2);
        var o_bound = this.getControl(s_boundId);
        if (o_bound != null) {
            o_bound.html('$' + total);
        }
    },
    updateLineItemDirect: function(s_elementId, f_price) {
        var o_element = this.getControl(s_elementId);
        o_element.html('$' + f_price);
    },
    get_prices: function(pkg_monthly_fee) {

        var oneyear_calc = {
            'months_pay': 10,
            'actual': 12
        };
        var twoyear_calc = {
            'months_pay': 19,
            'actual': 24
        };
        var threeyear_calc = {
            'months_pay': 26,
            'actual': 36
        };
        var fouryear_calc = {
            'months_pay': 32,
            'actual': 48
        };
        var fiveyear_calc = {
            'months_pay': 36,
            'actual': 60
        };

        var quarter = (pkg_monthly_fee * 3).toFixed(2);
        var oneyear = (pkg_monthly_fee * oneyear_calc['months_pay']).toFixed(2);
        var twoyear = (pkg_monthly_fee * twoyear_calc['months_pay']).toFixed(2);
        var threeyear = (pkg_monthly_fee * threeyear_calc['months_pay']).toFixed(2);
        var fouryear = (pkg_monthly_fee * fouryear_calc['months_pay']).toFixed(2);
        var fiveyear = (pkg_monthly_fee * fiveyear_calc['months_pay']).toFixed(2);

        var oneyear_monthly = (oneyear / oneyear_calc['actual']).toFixed(2);
        var twoyear_monthly = (twoyear / twoyear_calc['actual']).toFixed(2);
        var threeyear_monthly = (threeyear / threeyear_calc['actual']).toFixed(2);
        var fouryear_monthly = (fouryear / fouryear_calc['actual']).toFixed(2);
        var fiveyear_monthly = (fiveyear / fiveyear_calc['actual']).toFixed(2);

        oneyear_calc['free'] = oneyear_calc['actual'] - oneyear_calc['months_pay'];
        twoyear_calc['free'] = twoyear_calc['actual'] - twoyear_calc['months_pay'];
        threeyear_calc['free'] = threeyear_calc['actual'] - threeyear_calc['months_pay'];
        fouryear_calc['free'] = fouryear_calc['actual'] - fouryear_calc['months_pay'];
        fiveyear_calc['free'] = fiveyear_calc['actual'] - fiveyear_calc['months_pay'];

        var save_oneyear = (pkg_monthly_fee * oneyear_calc['free']).toFixed(2);
        var save_twoyear = (pkg_monthly_fee * twoyear_calc['free']).toFixed(2);
        var save_threeyear = (pkg_monthly_fee * threeyear_calc['free']).toFixed(2);
        var save_fouryear = (pkg_monthly_fee * fouryear_calc['free']).toFixed(2);
        var save_fiveyear = (pkg_monthly_fee * fiveyear_calc['free']).toFixed(2);

        $('#quarter').html("<li>Quarterly $" + quarter);
        $('#year').html("<li>One Year $" + oneyear + "&nbsp;&nbsp;&nbsp;$" + oneyear_monthly + "/m </li><li><font color='#85b358'>" + oneyear_calc['free'] + "&nbsp;months&nbsp;FREE</font>&nbsp;&nbsp;&nbsp;<font color='#85b358'>SAVE $" + save_oneyear + "!</font></li>");
        $('#twoyear').html("<li>Two Years $" + twoyear + "&nbsp;&nbsp;&nbsp;$" + twoyear_monthly + "/m </li><li><font color='#85b358'>" + twoyear_calc['free'] + "&nbsp;months&nbsp;FREE</font>&nbsp;&nbsp;&nbsp;<font color='#85b358'>SAVE $" + save_twoyear + "!</font></li>");
        $('#threeyear').html("<li>Three Years $" + threeyear + "&nbsp;&nbsp;&nbsp;$" + threeyear_monthly + "/m </li><li><font color='#85b358'>" + threeyear_calc['free'] + "&nbsp;months&nbsp;FREE</font>&nbsp;&nbsp;&nbsp;<font color='#85b358'>SAVE $" + save_threeyear + "!</font></li>");
        $('#fouryear').html("<li>Four Years $" + fouryear + "&nbsp;&nbsp;&nbsp;$" + fouryear_monthly + "/m </li><li><font color='#85b358'>" + fouryear_calc['free'] + "&nbsp;months&nbsp;FREE</font>&nbsp;&nbsp;&nbsp;<font color='#85b358'>SAVE $" + save_fouryear + "!</font></li>");
        $('#fiveyear').html("<li>Five Years $" + fiveyear + "&nbsp;&nbsp;&nbsp;$" + fiveyear_monthly + "/m </li><li><font color='#85b358'>" + fiveyear_calc['free'] + "&nbsp;months&nbsp;FREE</font>&nbsp;&nbsp;&nbsp;<font color='#85b358'>SAVE $" + save_fiveyear + "!</font></li>");
    },
    uses: function(elements) {
        var result = true;
        for (var i in elements) {

            if ($('#' + elements[i]).length <= 0) {
                result = false;
                break;
            }
        }
        return result;
    },
    reactPrice: function() {
        var elements = [
            "cpus",
            "ram",
            "hd",
            "cpu_price",
            "ram_price",
            "hd_price",
            "package_message",
            "submit_button",
            "package_price"
        ];
        if (!this.uses(elements)) {
            return false;
        }

        var cpus = this.getValue('cpus');
        var ram = this.getValue('ram');
        var db = this.getValue('database');
        var hd = this.getValue('hd');
        var ip_addresses = this.getValue('ip_addresses');
        var control_panel = this.getValue('cp');
        var rb = this.getValue('rb_id');
        var cp_price = this.getVPSPrice(control_panel, 'cpanel');
        var db_price = this.getVPSPrice(db, 'database');
        var rb_price = this.getVPSPrice(rb, 'remote');
        var cpu_unit_price = this.state.cpu_unit_price;
        var ram_unit_price = this.state.ram_unit_price;
        var hd_unit_price = this.state.hd_unit_price;

        if (cpus > 0) {
            this.updateLineItem('cpus', 'cpu_price', cpu_unit_price);
        }

        if (ram > 0) {
            this.updateLineItem('ram', 'ram_price', ram_unit_price);
        }

        if (hd > 0) {
            this.updateLineItem('hd', 'hd_price', hd_unit_price);
        }

        var ip_total_price = this.calc_ip_price(ip_addresses);
        this.updateLineItemDirect('ip_addresses_price', ip_total_price);
        this.updateLineItemDirect('database_price', db_price);
        this.updateLineItemDirect('rb_price', rb_price);
        this.updateLineItemDirect('cp_price', cp_price);

        if (cpus > 0 && ram > 0 && hd > 0) {
            var total;
            total = 0;
            total += cpus * cpu_unit_price;
            total += ram * ram_unit_price;
            total += hd * hd_unit_price;
            total += ip_total_price;
            total += cp_price * 1;
            total += db_price * 1;
            total += rb_price * 1;
            total = this.roundNumber(total, 2);
            $('#package_message').html('Monthly $' + total);
            $('#package_price').val(total);
            this.get_prices(total);
            this.check_submit_enable();
        }
    },
    /* end of reactPrice */
    loadIp: function(remote_backups) {
        ReactDOM.render(
            <IpSection ip_unit_price={this.state.ip_unit_price} reactPrice={this.reactPrice}/>, document.getElementById('js-ipaddress-wrapper'));
    },
    loadRemoteBackups: function(remote_backups) {
        ReactDOM.render(
            <RemoteSection remote_backups={remote_backups} reactPrice={this.reactPrice}/>, document.getElementById('js-remote-wrapper'));
    },
    loadSubmit: function() {
        ReactDOM.render(
            <SubmitSection reactPrice={this.reactPrice}/>, document.getElementById('js-submit-wrapper'));
    },
    loadHidden: function() {
        ReactDOM.render(
            <CpusSection reactPrice={this.reactPrice}/>, document.getElementById('js-cpus-wrapper'));
        ReactDOM.render(
            <RamSection reactPrice={this.reactPrice}/>, document.getElementById('js-ram-wrapper'));
        ReactDOM.render(
            <HdSection reactPrice={this.reactPrice}/>, document.getElementById('js-hd-wrapper'));
    },
    render: function() {
        return (<OSystemList osystems={this.state.osystems} cpanel={this.state.cpanels} database={this.state.database} reactPrice={this.reactPrice}/>);
    }
});

var OSystemList = React.createClass({
    changeDataType: function(e) {

        var os_selected = parseInt(e.target.value);
        var index = this.props.osystems.findIndex(x => x.id === os_selected);
        var cpanel_conn = this.props.osystems[index].cpanel_conn;
        var database = this.props.database[this.props.osystems[index].platform_id];
        var tmp_cpanel = [];
        var sel_cpanel = [];
        var i = [];
        for (i in cpanel_conn) {
            tmp_cpanel = this.props.cpanel[this.props.cpanel.findIndex(x => x.id === cpanel_conn[i])];
            sel_cpanel.push(tmp_cpanel);
        }
        ReactDOM.render(
            <CpanelSection cpanels_list={sel_cpanel} reactPrice={this.props.reactPrice}/>, document.getElementById('js-cpanel-wrapper'));
        ReactDOM.render(
            <DatabaseSection database_list={database} reactPrice={this.props.reactPrice}/>, document.getElementById('js-database-wrapper'));
    },
    render() {
        let osystemNodes = this.props.osystems.map(osystem => {
            return <option key={osystem.id} value={osystem.id}>{osystem.name}</option>
        });
        return (
            <select id="os" name="vps_hosting_form[vpsos]" className="form-control" onChange={this.changeDataType}>
                <option value="0">Select an operating system</option>
                {osystemNodes}
            </select>
        );
    }
});

var CpanelSection = React.createClass({
    changeDataType: function(e) {
        this.props.reactPrice();
    },
    render() {
        let cpanelNodes = this.props.cpanels_list.map(cpanel_list => {
            return <option key={cpanel_list.id} value={cpanel_list.id}>{cpanel_list.description}
                ${cpanel_list.price}</option>
        });
        return (
            <select id="cp" name="vps_hosting_form[vpscpanel]" className="form-control" onChange={this.changeDataType}>
                <option value="">No Control Panel</option>
                {cpanelNodes}
            </select>
        );
    }
});

var DatabaseSection = React.createClass({
    changeDataType: function(e) {
        this.props.reactPrice();
    },
    render() {
        let databaseNodes = this.props.database_list.map(database => {
            return <option key={database.id} value={database.id}>{database.description}
                ${database.price}</option>
        });

        return (
            <select name="vps_hosting_form[vpsdatabase]" id="database" className="form-control" onChange={this.changeDataType}>
                <option value="">No Database</option>
                {databaseNodes}
            </select>
        );
    }
});

var RemoteSection = React.createClass({
    changeDataType: function(e) {
        this.props.reactPrice();
    },
    render() {
        let remoteNodes = this.props.remote_backups.map(remote_backup => {
            return <option key={remote_backup.id} value={remote_backup.id}>{remote_backup.description}
                ${remote_backup.price}</option>
        });
        return (
            <select id="rb_id" name="vps_hosting_form[remotebackup]" className="form-control" onChange={this.changeDataType}>
                <option value="">No Remote Backup</option>
                {remoteNodes}
            </select>
        );
    }
});

var IpSection = React.createClass({
    changeDataType: function(e) {
        this.props.reactPrice();
    },
    render() {
        let ipNodes = Array.from(new Array(23), (val, index) => index + 1).map(list => {
            return <option key={list} value={list}>{list}
                ip addresses ${(list >= 2)
                    ? (list - 1) * this.props.ip_unit_price
                    : 0}.00</option>
        });
        return (
            <select id="ip_addresses" name="vps_hosting_form[ip_addresses]" className="form-control" onChange={this.changeDataType}>
                {ipNodes}
            </select>
        );
    }
});

var SubmitSection = React.createClass({
    changeDataType: function(e) {
        this.props.reactPrice();
        $("#submit_button").click();
    },
    render() {
        return (
            <a className="arrow_next" id="link_submit" name="link_submit" onClick={this.changeDataType}>Purchase Cloud VPS</a>
        );
    }
});

var CpusSection = React.createClass({
    changeDataType: function(e) {
        this.props.reactPrice();
    },
    render() {
        return (<input id="cpus" type="hidden" name="vps_hosting_form[cpu]" value="1" onClick={this.changeDataType}/>);
    }
});

var RamSection = React.createClass({
    changeDataType: function(e) {
        this.props.reactPrice();
    },
    render() {
        return (<input id="ram" type="hidden" name="vps_hosting_form[ram]" value="1" onClick={this.changeDataType}/>);
    }
});

var HdSection = React.createClass({
    changeDataType: function(e) {
        this.props.reactPrice();
    },
    render() {
        return (<input id="hd" type="hidden" name="vps_hosting_form[hd]" value="1" onClick={this.changeDataType}/>);
    }
});

window.OSystemSection = OSystemSection;
