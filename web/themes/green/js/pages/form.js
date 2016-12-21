$(function () {
    // Checkboxes/radios (Uniform)
// ------------------------------

// RADIO BUTTON
    $(".control-primary input").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-primary-600 text-primary-800'
    });
    $(".control-danger input").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-danger-600 text-danger-800'
    });
    $(".control-success input").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-success-600 text-success-800'
    });
    $(".control-warning input").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-warning-600 text-warning-800'
    });
    $(".control-info input").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-info-600 text-info-800'
    });
    $(".control-custom input").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-indigo-600 text-indigo-800'
    });
    $(".styled, .multiselect-container input, input[type=checkbox], input[type=radio]").uniform({
        radioClass: 'choice'
    });
// File input
    $(".file-styled").uniform({
        wrapperClass: 'bg-blue',
        fileButtonHtml: '<i class="icon-file-plus"></i>'
    });
// Datepicker
    $('.datepicker-basic').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
// ColorPicker
    function loadColor() {
        $(".colorpicker").spectrum({
            preferredFormat: "rgb",
            showInitial: true,
            showAlpha: true,
            showInput: true,
            allowEmpty: true
        });
    }

    loadColor();
// Basic initialization
    $('.taginput').tagsinput();
// Select with search
    $('select').select2({
        minimumResultsForSearch: 3,
        width: "100%"
    });
//MODAL NEW
    var actionNew;
    $('[data-modal-new-form]').each(function (index, input) {
        var form = $(input).data('modal-new-form');
        $(input).after("<span class='btn btn-primary btn-label btn-xs new-form-modal' data-toggle='modal' data-target='#new_form_modal' data-type='" + input.id + "' data-form='" + form + "' data-label-form='" + $(input).data('label-form') + "'><icon class='icon-plus'></icon> " + $(input).data('label-form') + "</span>");
    });
    $('#new_form_modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        actionNew = button.data('form');
        var type = button.data('type');
        var modal = $(this);
        modal.find('.modal-title').html(type);
        $.ajax({
            url: Routing.generate(actionNew, {format: 'html'}),
            data: {'apikey': 'erp'},
            success: function (data) {
                modal.find('.modalMessage').html(data);
                loadColor();
            }
        });


    });
    $('.save-entity').on('click', function (e) {
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
        var form = $('#new_form_modal').find('form');
        $.ajax({
            url: form.attr('action'), // Le nom du fichier indiqué dans le formulaire
            type: form.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
            data: form.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: function (html) { // Je récupère la réponse du fichier PHP
                html = jQuery.parseJSON(html);
                $('[data-modal-new-form=' + actionNew + ']').append('<option value="' + html.id + '" selected>' + html.name + '</option>');
            }
        });
    });
// MULTIPLE CHECKBOX
    $('.title-checkbox-group input[type=checkbox]').change(function () {
        var list = $(this).parents('.col-sm-12').children('ul.list-inline');
        if ($(this).is(":checked")) {
            $(list).find('input[type=checkbox]').prop('checked', true);
            $.uniform.update();
        }
        else {
            $(list).find('input[type=checkbox]').prop('checked', false);
            $.uniform.update();
        }
    });

});