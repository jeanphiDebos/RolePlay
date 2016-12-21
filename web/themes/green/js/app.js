$(function () {
    'use strict';
    //NOTIFY
    var body = $('body');

    function checkNotify() {
        if (body.find('notify-session').length != -1) {
            $.each($('.notify-session'), function () {
                var el = $(this);
                //Options PNotify
                var opts = {
                    text: el.data('message'),
                    stack: {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 1},
                    cornerclass: "no-border-radius",
                    width: "100%"
                };

                switch (el.data('type')) {
                    case 'info':
                        opts.title = "Information : ";
                        opts.addclass = "stack-custom-top bg-info";
                        opts.type = "info";
                        break;
                    case 'success':
                        opts.title = "Information : ";
                        opts.addclass = "stack-custom-top bg-success";
                        opts.type = "success";
                        break;
                    case 'error':
                        opts.title = "Information : ";
                        opts.addclass = "stack-custom-top bg-danger";
                        opts.type = "error";
                        break;
                }
                new PNotify(opts);
            });
        }
    }

    setTimeout(checkNotify, 200);

    //MODALREMOVE
    var actionRemove;
    $('#modal_theme_danger').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        actionRemove = button.data('action');
        var title = button.data('title');
        var message = button.data('message');
        var modal = $(this);
        modal.find('.modal-title').html(title);
        modal.find('.modalMessage').html(message);
    });
    $('.remove-entity').on('click', function () {
        $(location).attr('href', actionRemove);
    });

    $(window).on('resize', function () {
        setTimeout(function () {

            if ($(window).width() <= 1080) {

                // Revert left detached position
                if (!body.hasClass('sidebar-xs')) {
                    body.addClass('sidebar-xs');
                }
            }
            else {
                // Revert left detached position
                if (body.hasClass('sidebar-xs')) {
                    body.removeClass('sidebar-xs');
                }
            }
        }, 100);
    }).resize();
});
