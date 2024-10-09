(function ($) {
    'use strict';

    $('.login-form').on('submit', function (e) {

        e.preventDefault();

        let form = $(this),
            submit_button = form.find('button[type="submit"]');

        $.ajax({

            type: 'POST',
            url: umag_object.ajax_url,
            data: form.serialize() + '&action=umag_do_login_form',
            dataType: 'json',
            beforeSend: function () {
                submit_button.attr('disabled', true);
                form.find('.alert').remove();
            },
            success: function (response) {
                if (response.success) {
                    form.prepend('<div class="alert alert-success mt-4" role="alert">\n' +
                        response.data.message +
                        '</div>');
                    setTimeout(function () {
                        window.location.href = umag_object.home_url;
                    }, 3000);
                } else {
                    form.prepend('<div class="alert alert-warning mt-4" role="alert">\n' +
                        response.data.message +
                        '</div>');
                }
            },
            complete: function () {
                submit_button.attr('disabled', false);
            },

        });

    });

    $('.post-submit').on('submit', function (e) {

        e.preventDefault();

        let data = new FormData(),
            form = $(this),
            submit_button = form.find('button[type="submit"]');

        data.append('action', 'umag_do_post_submit');
        data.append('security', $('#submit_field').val());
        data.append('thumbnail', $('#umag-thumbnail').prop('files')[0]);
        data.append('title', $('#umag-title').val());

        let editor = tinyMCE.get('umag-content'),
            content = editor.getContent();

        data.append('content', content);
        data.append('tags', $('#umag-tags').val());
        data.append('category', $('#umag-category').val());

        $.ajax({

            type: 'POST',
            url: umag_object.ajax_url,
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',

            beforeSend: function () {
                submit_button.attr('disabled', true);
            },
            success(response) {
                if (response.success) {
                    form.append('<div class="alert alert-success mt-4 mb-0" role="alert">\n' + response.data.message + '</div>');
                }
            },
            complete() {
                submit_button.attr('disabled', false);
            }
        });

    });

})(jQuery);