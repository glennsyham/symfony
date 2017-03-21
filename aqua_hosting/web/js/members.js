function membersDetailinit() {
    var $wrapper = $('.js-members-detail-wrapper');
    // Get the data-prototype explained earlier
    var prototype = $wrapper.data('prototype');

    // get the new index
    var index = $wrapper.data('index');
    if(index > 0) {
        return;
    }
    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $wrapper.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    $($wrapper).before(newForm);
}