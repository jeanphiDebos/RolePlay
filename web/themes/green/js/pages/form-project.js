$(function () {
    var $roleContacts;
    var addRoleContactLink = $('.add_project_role_contact');
    // Get the ul that holds the collection of tags
    $roleContacts = $('.roleContacts');
    $roleContacts.find('tr').each(function () {
        addRoleContactFormDeleteLink($(this));
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $roleContacts.data('index', $roleContacts.find(':input').length);

    addRoleContactLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addRoleContactForm($roleContacts);
    });
    function addRoleContactForm($roleContacts) {
        // Get the data-prototype explained earlier
        var prototype = $roleContacts.data('prototype');

        // get the new index
        var index = $roleContacts.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $roleContacts.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('.roleContacts tbody').append(newForm);
        addRoleContactFormDeleteLink($newFormLi);
        // Datepicker
        $('.datepicker-basic').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    }

    function addRoleContactFormDeleteLink($newFormLi) {
        var $removeFormA = $('<button type="button" class="btn btn-danger btn-labeled btn-xs"><b><i class="icon-pin-alt"></i></b> Supprimer</button>');
        $newFormLi.find('td.delete-link').html($removeFormA);
    }

    $(document).on('click', '.delete-link', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        var target = $(e.currentTarget).parents('tr');
        // remove the li for the tag form
        target.remove();
    });
});