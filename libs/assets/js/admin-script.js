jQuery(document).ready(function ($) {
    "use strict"; 

    $('.row-actions .edit a, .page-title-action').on('click', function (e) {
        e.preventDefault();
        var id = 0;
        var modal = $('#metform_form_modal');
        var parent = $(this).parents('.column-title');

        modal.addClass('loading');
        modal.modal('show');
        if (parent.length > 0) {
            id = parent.find('.hidden').attr('id').split('_')[1];

            $.get(window.metform_api.resturl + 'metform/v1/forms/list/' + id, function (data) {
                //console.log('Response : '+data['limit_total_entries']);
                MetForm_Form_Editor(data);
                modal.removeClass('loading');
            });
        } else {
            var data = {
                title: '',
                type: 'header',
                condition_a: 'entire_site',
                condition_singular: 'all',
                activation: '',
            };
            MetForm_Form_Editor(data);
            modal.removeClass('loading');
        }

        modal.find('form').attr('data-mf-id', id);
    });

    $('.metform-form-save-btn-editor').on('click', function () {
        var form = $('#metform-form-modalinput-form');
        form.attr('data-open-editor', '1');
        form.trigger('submit');
    });

    $('#metform-form-modalinput-general').on('submit', function (e) {
        e.preventDefault();
        var modal = $('#metform-form-modal');
        modal.addClass('loading');

        var form_data = $(this).serialize();
        var id = $(this).attr('data-mf-id');
        var open_editor = $(this).attr('data-open-editor');
        var admin_url = $(this).attr('data-editor-url');

        $.post(window.metform_api.resturl + 'metform/v1/forms/update_general/' + id, form_data, function (output) {
            console.log("response : "+output);
            modal.removeClass('loading');

            // set list table data
            var row = $('#post-' + output.data.id);
            console.log(row.length);

            if(row.length > 0){
                row.find('.column-type')
                    .html(output.data.type_html);

                row.find('.column-condition')
                    .html(output.data.cond_text);

                row.find('.row-title')
                    .html(output.data.title)
                    .attr('aria-label', output.data.title);

                console.log(output.data.title);
            }

            if (open_editor == '1') {
                window.location.href = admin_url + '?post=' + output.data.id + '&action=elementor';
            }else if(id == '0'){
                location.reload();
            }
        });

    });

    $('#metform-form-modalinput-user-notification').on('submit', function (e) {
        e.preventDefault();
        var modal = $('#metform-form-modal');
        modal.addClass('loading');

        var form_data = $(this).serialize();
        //var id = $(this).attr('data-mf-id');
        var id = 64;
        var open_editor = $(this).attr('data-open-editor');
        var admin_url = $(this).attr('data-editor-url');

        //console.log(form_data);

        $.post(window.metform_api.resturl + 'metform/v1/forms/update_user_notification/' + id, form_data, function (output) {
            console.log(output);
            modal.removeClass('loading');

        });

    });

    $('#metform-form-modalinput-admin-notification').on('submit', function (e) {
        e.preventDefault();
        var modal = $('#metform-form-modal');
        modal.addClass('loading');

        var form_data = $(this).serialize();
        //var id = $(this).attr('data-mf-id');
        var id = 64;
        var open_editor = $(this).attr('data-open-editor');
        var admin_url = $(this).attr('data-editor-url');

        //console.log(form_data);

        $.post(window.metform_api.resturl + 'metform/v1/forms/update_admin_notification/' + id, form_data, function (output) {
            console.log(output);
            modal.removeClass('loading');

        });

    });


    function MetForm_Form_Editor(data) {
        console.log(data);
        // set the form data
        $('.mf-form-modalinput-title').val(data.title);
        $('.mf-form-modalinput-success_message').val(data.success_message);
        $('.mf-form-modalinput-redirect_to').val(data.redirect_to);
        $('.mf-form-modalinput-limit_total_entries').val(data.limit_total_entries);
        $('.mf-form-modalinput-type').val(data.type);

        // var activation_input = $('.mf-form-modalinput-activition');
        // if (data.activation == 'yes') {
        //     activation_input.attr('checked', true);
        // } else {
        //     activation_input.removeAttr('checked');
        // }

        $('.mf-form-modalinput-activition, .mf-form-modalinput-type, .mf-form-modalinput-condition_a, .mf-form-modalinput-condition_singular')
            .trigger('change');

    }

});