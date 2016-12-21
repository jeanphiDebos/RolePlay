$(function () {
    var $contacts;
    var addContactRelationLink = $('.add_contact');
    // Get the ul that holds the collection of tags
    $contacts = $('.contacts');
    $contacts.find('tr').each(function () {
        addContactRelationDeleteLink($(this));
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $contacts.data('index', $contacts.find(':input').length);

    addContactRelationLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addContactRelationForm($contacts);
    });
    function addContactRelationForm($contacts) {
        // Get the data-prototype explained earlier
        var prototype = $contacts.data('prototype');

        // get the new index
        var index = $contacts.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $contacts.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormContactRelation = $('.contacts tbody').append(newForm);
        addContactRelationDeleteLink($newFormContactRelation);
        // Select with search
        $('select').select2({
            minimumResultsForSearch: 3,
            width: "100%"
        });
    }

    function addContactRelationDeleteLink($newFormContactRelation) {
        console.log($newFormContactRelation);
        var $removeFormContactRelation = $('<button type="button" class="btn btn-danger btn-labeled btn-xs"><b><i class="icon-pin-alt"></i></b> Supprimer</button>');
        $newFormContactRelation.find('td.delete-link').html($removeFormContactRelation);
    }

    //Traitement des relations avec des tiers

    var $relationTiers;
    var addRelationTierLink = $('.add_relation_tier');
    // Get the ul that holds the collection of tags
    $relationTiers = $('.relation-tier');
    $relationTiers.find('tr').each(function () {
        addRelationTierFormDeleteLink($(this));
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $relationTiers.data('index', $relationTiers.find(':input').length);

    addRelationTierLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addRelationTierForm($relationTiers);
    });
    function addRelationTierForm($relationTiers) {
        // Get the data-prototype explained earlier
        var prototype = $relationTiers.data('prototype');

        // get the new index
        var index = $relationTiers.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $relationTiers.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormRelationTier = $('.relation-tier tbody').append(newForm);
        addRelationTierFormDeleteLink($newFormRelationTier);
        // Select with search
        $('select').select2({
            minimumResultsForSearch: 3,
            width: "100%"
        });
    }

    function addRelationTierFormDeleteLink($newFormRelationTier) {
        var $removeFormRelationTier = $('<button type="button" class="btn btn-danger btn-labeled btn-xs"><b><i class="icon-pin-alt"></i></b> Supprimer</button>');
        $newFormRelationTier.find('td.delete-link').html($removeFormRelationTier);
    }

    $(document).on('click', '.delete-link', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        var target = $(e.currentTarget).parents('tr');
        // remove the li for the tag form
        target.remove();
    });
});