//console.log('loaded');
jQuery(document).ready(function ($) {
    "use strict"; 

    $('.row-actions .edit a, .page-title-action, .metform-form-edit-btn').on('click', function (e) {
        e.preventDefault();
        //console.log($(this));
        var id = 0;
        var modal = $('#metform_form_modal');
        var parent = $(this).parents('.column-title');

        modal.addClass('loading');
        modal.modal('show');
        if (parent.length > 0) {
            id = $(this).attr('data-metform-form-id');
            //console.log(id);
            id = (id !== undefined) ? id : parent.find('.hidden').attr('id').split('_')[1];


            $.get(window.metform_api.resturl + 'metform/v1/forms/get/' + id, function (data) {
                //console.log(data);
                MetForm_Form_Editor(data);
                modal.removeClass('loading');
            });
        } else {
            var data = {
                form_title: '',
            };
            MetForm_Form_Editor(data);
            modal.removeClass('loading');
        }

        modal.find('form').attr('data-mf-id', id);
    });

    $('.metform-form-save-btn-editor').on('click', function () {
        var form = $('#metform-form-modalinput-settings');
        form.attr('data-open-editor', '1');
        form.trigger('submit');
    });

    $('#metform-form-modalinput-settings').on('submit', function (e) {
        e.preventDefault();
        var modal = $('#metform-form-modal');
        modal.addClass('loading');

        var form_data = $(this).serialize();
        //console.log("submitted data : "+form_data);
        var id = $(this).attr('data-mf-id');
        var open_editor = $(this).attr('data-open-editor');
        var admin_url = $(this).attr('data-editor-url');

        $.post(window.metform_api.resturl + 'metform/v1/forms/update/' + id, form_data, function (output) {

            $('#message').css('display','block');
            $('#message').html(output.status);
            setTimeout( function(){ 
                $('#message').css('display','none');
            }  , 1500 );
            
            //console.log(output.status);

            modal.removeClass('loading');

            if (open_editor == '1') {
                window.location.href = admin_url + '?post=' + output.data.id + '&action=elementor';
            }else if(id == '0'){
                location.reload();
            }
        });

    });

    $('input.mf-form-modalinput-limit_status').click(function(){
        if($(this).is(":checked")){
            $('#limit_status').removeClass('hide_input');
            $('#limit_status').addClass('show_input');
        }
        else if($(this).is(":not(:checked)")){
            $('#limit_status').removeClass('show_input');
            $('#limit_status').addClass('hide_input');
        }
    });

    $('input.mf-form-modalinput-capture_user_browser_data').click(function(){
        if($(this).is(":checked")){
            $('#multiple_submission').removeClass('hide_input');
            $('#multiple_submission').addClass('show_input');
        }
        else if($(this).is(":not(:checked)")){
            $('#multiple_submission').removeClass('show_input');
            $('#multiple_submission').addClass('hide_input');
        }
    });

    function MetForm_Form_Editor(data) {

        //console.log(data);

        $('.mf-form-modalinput-title').val(data.form_title);
        $('.mf-form-modalinput-success_message').val(data.success_message);
        $('.mf-form-modalinput-redirect_to').val(data.redirect_to);
        $('.mf-form-modalinput-limit_total_entries').val(data.limit_total_entries);

        var store_entries = $('.mf-form-modalinput-store_entries');
        if (data.store_entries == '1') {
            store_entries.attr('checked', true);
        } else {
            store_entries.removeAttr('checked');
        }

        var hide_form_after_submission = $('.mf-form-modalinput-hide_form_after_submission');
        if (data.hide_form_after_submission == '1') {
            hide_form_after_submission.attr('checked', true);
        } else {
            hide_form_after_submission.removeAttr('checked');
        }

        var require_login = $('.mf-form-modalinput-require_login');
        if (data.require_login == '1') {
            require_login.attr('checked', true);
        } else {
            require_login.removeAttr('checked');
        }
        var limit_entry_status = $('.mf-form-modalinput-limit_status');
        if (data.limit_total_entries_status == '1') {
            limit_entry_status.attr('checked', true);
            $('#limit_status').removeClass('hide_input');
            $('#limit_status').addClass('show_input');
        } else {
            limit_entry_status.removeAttr('checked');
        }

        var multiple_submission = $('.mf-form-modalinput-multiple_submission');
        if (data.multiple_submission == '1') {
            multiple_submission.attr('checked', true);
        } else {
            multiple_submission.removeAttr('checked');
        }

        var enable_recaptcha = $('.mf-form-modalinput-enable_recaptcha');
        if (data.enable_recaptcha == '1') {
            enable_recaptcha.attr('checked', true);
        } else {
            enable_recaptcha.removeAttr('checked');
        }

        var capture_user_browser_data = $('.mf-form-modalinput-capture_user_browser_data');
        if (data.capture_user_browser_data == '1') {
            capture_user_browser_data.attr('checked', true);
            $('#multiple_submission').removeClass('hide_input');
            $('#multiple_submission').addClass('show_input');
        } else {
            capture_user_browser_data.removeAttr('checked');
        }


        $('.mf-form-user-email-subject').val(data.user_email_subject);
        $('.mf-form-user-email-from').val(data.user_email_from);
        $('.mf-form-user-reply-to').val(data.user_email_reply_to);
        $('.mf-form-user-email-body').val(data.user_email_body);

    
        var enable_user_notification = $('.mf-form-user-enable')
        if(data.enable_user_notification == '1'){
            enable_user_notification.attr('checked', true);
        }
        else{
            enable_user_notification.removeAttr('checked');
        }

        var user_submission_copy = $('.mf-form-user-submission-copy')
        if(data.user_email_attach_submission_copy == '1'){
            user_submission_copy.attr('checked', true);
        }
        else{
            user_submission_copy.removeAttr('checked');
        }

        $('.mf-form-admin-email-subject').val(data.admin_email_subject);
        $('.mf-form-admin-email-from').val(data.admin_email_from);
        $('.mf-form-admin-reply-to').val(data.admin_email_reply_to);
        $('.mf-form-admin-email-body').val(data.admin_email_body);


        var enable_admin_notification = $('.mf-form-admin-enable')
        if(data.enable_admin_notification == '1'){
            enable_admin_notification.attr('checked', true);
        }
        else{
            enable_admin_notification.removeAttr('checked');
        }

        var admin_submission_copy = $('.mf-form-admin-submission-copy')
        if(data.admin_email_attach_submission_copy == '1'){
            admin_submission_copy.attr('checked', true);
        }
        else{
            admin_submission_copy.removeAttr('checked');
        }

    }

});