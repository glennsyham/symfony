;
(function($) {

    $.vpsValidation = function(el, options) {
        // Private Functions
        function debug(e) {
            console.log(e);
        }

        // Global Private Variables
        var basef = this;
        basef.vpsValidation.init = function() {
            basef.vpsValidation.configure();
        };
        basef.vpsValidation.configure = function() {
            $('#configure').on('submit', function() {
                return basef.vpsValidation.check();
            })
        };
        basef.vpsValidation.check = function() {
            var var_cHN = basef.vpsValidation.hostNme();

            var var_cDB = basef.vpsValidation.dbFinal();

            var is_valid = true;
            if (var_cHN == false) {
                is_valid = false;
            }
            if (var_cDB == false) {
                is_valid = false;
            }

            return is_valid;
        };
        basef.vpsValidation.hostNme = function() {
            var host_name = document.getElementById('host_name').value;
            var domain_name = document.getElementById('domain_name').value;
            var extension_name = document.getElementById('extension_name').value;
            var returnvalue = true;
            var error_empty = '';
            var error_no_symbols = '';
            var error_no_sym_num = '';
            var error_alpha = '';
            var host_name_string_alpha = host_name.replace(new RegExp("[^a-zA-Z]+", "g"), "");
            var host_name_string = host_name.replace(new RegExp("[!^a-zA-Z0-9]+", "g"), "");
            var domain_name_string = domain_name.replace(new RegExp("[!^a-zA-Z0-9-]+", "g"), "");
            var extension_name_string = extension_name.replace(new RegExp("[!^a-zA-Z.]+", "g"), "");
            var warnings = "";
            var dot_extension = extension_name.replace(new RegExp("[^.]+", "g"), "");
            var frst_char_domain = domain_name.substr(0, 1).replace(new RegExp("[!^a-zA-Z0-9]+", "g"), "");
            var domain_length = domain_name.length - 1;
            var end_char_domain = domain_name.substr(domain_length, 1).replace(new RegExp("[!^a-zA-Z0-9]+", "g"), "");
            var tempformValue = host_name.toLowerCase();
            var host_valid_www = tempformValue.match('www') == null;

            if (host_name == '') {
                error_empty += 'Host<br>';
            } else if (host_name.length > 15) {
                returnvalue = false;
                warnings += 'Host maximum length is 15<br>';
            } else if (!host_valid_www) {
                returnvalue = false;
                warnings += 'Do not use "www" in Host<br>';
            } else if (host_name_string.length >= 1) {
                error_no_symbols += 'Host<br>';
            } else if (host_name_string_alpha.length <= 0) {
                error_alpha += 'Host<br>';
            }

            if (domain_name == '') {
                error_empty += 'Domain<br>';
            } else if (domain_name.length > 25) {
                returnvalue = false;
                warnings += 'Domain maximum length is 25<br>';
            } else if (domain_name_string.length >= 1) {
                error_no_symbols += 'Domain<br>';
            }

            if (extension_name == '') {
                error_empty += 'Extension<br>';
            } else if (extension_name.length > 10) {
                returnvalue = false;
                warnings += 'Extension maximum length is 10<br>';
            } else if (extension_name[0] == '.') {
                returnvalue = false;
                warnings += 'Extension cannot begin with a period<br>';
            } else if (extension_name[extension_name.length - 1] == '.' && extension_name.length > 1) {
                returnvalue = false;
                warnings += 'Missing characters on the Extension a period on the end<br>';
            } else if (extension_name_string.length >= 1) {
                error_no_sym_num += 'Extension<br>';
            }

            if (dot_extension.length >= 2) {
                returnvalue = false;
                warnings += 'Only One period allowed in Extension<br>';
            }

            if (error_empty != '') {
                returnvalue = false;
                warnings += 'You have missing info that is required :<br>' + error_empty;
            }

            if (error_no_symbols != '') {
                returnvalue = false;
                warnings += 'Symbols are not allowed in the following:<br>' + error_no_symbols;
            }

            if (frst_char_domain != '' || end_char_domain != '') {
                returnvalue = false;
                warnings += 'Dash (-) is not allowed in the beginning or at the end of Domain.<br>';
            }

            if (error_no_sym_num != '') {
                returnvalue = false;
                warnings += 'Symbols and Numbers are not allowed in the following:<br>' + error_no_sym_num;
            }

            if (error_alpha != '') {
                returnvalue = false;
                warnings += 'You have must have at least one letter in the following :<br>' + error_alpha;
            }

            if (warnings != '') {
                basef.vpsValidation.errorMsg(warnings);
            } else {
                if (document.getElementById('hostname')) {
                    document.getElementById('hostname').value = host_name + '.' + domain_name + '.' + extension_name;
                }
            }
            return returnvalue;
        };
        basef.vpsValidation.dbFinal = function() {
            var selDesc = document.getElementById('database');
            var temptext = $.trim(selDesc.options[selDesc.selectedIndex].text);
            var n = temptext.match(/MSSQL/g);
            var is_valid = true;
            if (n != null && n.length) {
                if (getControl('cpus').value <= 1) {
                    is_valid = false;
                    basef.vpsValidation.errorMsg('cpu is not valid');
                }
                if (getControl('ram').value <= 1) {
                    is_valid = false;
                    basef.vpsValidation.errorMsg('ram is not valid');
                }
                if (is_valid == false) {
                    basef.vpsValidation.errorMsg('You cannot continue with 1 CPU and MSSQL installation, you have to have at least 2CPU and 2GB RAM');
                }

            }
            return is_valid;
        };
        basef.vpsValidation.errorMsg = function(msg) {
            if (msg == '') {
                return false;
            }
            if ($(".floating_alert").length <= 0) {
                $(".js-main-content").prepend('<div class="alert alert-danger floating_alert" >' + msg + '</div>');
                $(".floating_alert").fadeTo(2000, 500).slideUp(500, function() {
                    this.remove();
                    return false;
                });
            }
            return false;
        };

        basef.vpsValidation.init();
    };
    $.fn.vpsValidation = function(options) {
        return this.each(function() {
            var bp = new $.vpsValidation(this, options);

        });
    };
})(jQuery);

$(document).ready(function() {
    $(function() {
        var $cpu_slider = $("#cpu_slider");
        var $ram_slider = $("#ram_slider");
        var $hd_text = $("#hd_text");

        var cpu_slider = $cpu_slider.slider({
            orientation: "horizontal",
            range: "min",
            value: 1,
            min: 1,
            max: 8,
            step: 1,
            animate: true,
            slide: function(event, ui) {
                var $cpus = $('#cpus');
                $cpus.val(ui.value);
                //$( "#cpu_slide a" ) phpstorm warning
                $("#cpu_slider").find('a').html(ui.value + 'CPU');
                $cpus.click();
            }
        });
        var ram_slider = $ram_slider.slider({
            orientation: "horizontal",
            range: "min",
            value: 1,
            min: 1,
            max: 32,
            step: 1,
            animate: true,
            slide: function(event, ui) {
                var $ram = $('#ram');
                $ram.val(ui.value);
                $("#ram_slider").find('a').html(ui.value + 'GB');
                $ram.click();
            }
        });
        var hd_slider = $hd_text.slider({
            orientation: "horizontal",
            range: "min",
            value: 1,
            min: 1,
            max: 16,
            step: 1,
            animate: true,
            slide: function(event, ui) {
                var $hd = $('#hd');
                $hd.val(ui.value);
                $("#hd_text").find('a').html((parseInt(ui.value) * 50) + 'GB');
                $hd.click();
            }
        });

        $('#cpus').val($cpu_slider.slider("value"));
        $cpu_slider.find("a").html($cpu_slider.slider("value") + 'CPU');
        $('#ram').val($ram_slider.slider("value"));
        $ram_slider.find("a").html($ram_slider.slider("value") + 'GB');
        $('#hd').val($hd_text.slider("value"));
        $hd_text.find("a").html((parseInt($hd_text.slider("value")) * 50) + 'GB');

        $("#configurator").find("a.arrow_next").each(function() {
            $(this).click(function() {
                var prev = $(this).attr('prev');
                var next = $(this).attr('next');
                if ($('#os').val() == 0) {
                    $.vpsValidation.errorMsg('Please select an Operating System')
                    return false;
                }
                if (prev != '') {
                    $(prev).slideToggle('slow');
                    $(prev + '_header').toggleClass('bottom');
                }
                if (next != '') {
                    $(next).slideToggle('slow');
                    $(next + '_header').toggleClass('bottom');
                }
            });

        });
        $('h3').each(function() {
            if ($(this).attr('role') == 'tab') {
                $(this).click(function() {
                    if ($('#os').val() == 0) {
                        $.vpsValidation.errorMsg('Please select an Operating System');
                        return false;
                    }
                    var lists = ['server', 'software', 'vps_name_server'];
                    var value = this.id;
                    value = value.replace("_header", "");
                    lists.map(function(list) {
                        var $list = $('#' + list);
                        if ($list.attr('style')) {
                            var str = $list.attr('style');
                            var n = str.match(/none/gi);
                        } else {
                            n = false;
                        }
                        if (list == value && n) {
                            $list.slideToggle('slow');
                            $(this).toggleClass('bottom');
                        } else if (list != value && !n) {
                            $list.slideToggle('slow');
                            $('#' + list + '_header').toggleClass('bottom');
                        }
                    });

                })
            }
        });
        $.vpsValidation();
    });

})
