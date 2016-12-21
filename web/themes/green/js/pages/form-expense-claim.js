$(function () {
    var $expenses;
    var addExpenseLink = $('.add_expense');
    // Get the ul that holds the collection of tags
    $expenses = $('.expenses');
    $expenses.find('tr').each(function () {
        addExpenseFormDeleteLink($(this));
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $expenses.data('index', $expenses.find(':input').length);

    addExpenseLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addExpenseForm($expenses);
    });
    function addExpenseForm($expenses) {
        // Get the data-prototype explained earlier
        var prototype = $expenses.data('prototype');

        // get the new index
        var index = $expenses.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $expenses.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('.expenses tbody').append(newForm);
        addExpenseFormDeleteLink($newFormLi);
        // Datepicker
        $('.datepicker-basic').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    }

    function addExpenseFormDeleteLink($newFormLi) {
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