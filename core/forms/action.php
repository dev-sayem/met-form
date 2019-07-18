<?php
namespace MetForm\Core\Forms;

Class Action{

    public static $instance;

    private $key_form_general;
    private $key_form_admin_notification;
    private $key_form_user_notification;
    private $post_type;

    private $fields;
    private $entry_id;
    private $form_id;
    private $form_data;
    private $title;

    public function __construct()
    {
            $this->key_form_general = 'mf_form__general';
            $this->key_form_user = 'mf_form__user';
            $this->key_form_admin = 'mf_form__admin';
            
            $this->post_type = Init::instance()->form->get_name();

    }

    public function store_general($id, $data){

        $this->title = $data['title'];

        $success_message = $data['success_message'];
        $capture_entries = isset($data['capture_entries']) ? $data['capture_entries'] : 0;
        $hide_form_after_submission = isset($data['hide_form_after_submission']) ? $data['hide_form_after_submission'] : 0;
        $redirect_to = $data['redirect_to'];
        $require_login = isset($data['require_login']) ? $data['require_login'] : 0;
        $limit_total_entries = $data['limit_total_entries'];
        $multiple_submission = isset($data['multiple_submission']) ? $data['multiple_submission'] : 0;
        $enable_recaptcha = isset($data['enable_recaptcha']) ? $data['enable_recaptcha'] : 0;
        $capture_user_browser_data = isset($data['capture_user_browser_data']) ? $data['capture_user_browser_data'] : 0;

        if($id == 0){
            $defaults = array(
                'post_title' => $this->title,
                'post_status' => 'publish',
                'post_type' => $this->post_type,
            );
            $this->form_id = wp_insert_post($defaults);
        }
        else{
            $this->form_id = $id;
        }

        update_post_meta( $this->form_id, $this->key_form_general.'_success_message', $success_message );
        update_post_meta( $this->form_id, $this->key_form_general.'_capture_entries', $capture_entries );
        update_post_meta( $this->form_id, $this->key_form_general.'_hide_form_after_submission', $hide_form_after_submission );
        update_post_meta( $this->form_id, $this->key_form_general.'_redirect_to', $redirect_to );
        update_post_meta( $this->form_id, $this->key_form_general.'_require_login', $require_login );
        update_post_meta( $this->form_id, $this->key_form_general.'_limit_total_entries', $limit_total_entries );
        update_post_meta( $this->form_id, $this->key_form_general.'_multiple_submission', $multiple_submission );
        update_post_meta( $this->form_id, $this->key_form_general.'_enable_recaptcha', $enable_recaptcha );
        update_post_meta( $this->form_id, $this->key_form_general.'_capture_user_browser_data', $capture_user_browser_data );

        return [
            'saved' => true,
            'data' => [
                'id' => $this->form_id,
                'title' => $this->title,
                'type' => $this->post_type,
            ]
        ];

    }

    public function store_user($id, $data){

        $this->title = ($id == 0) ? 'MetForm # '.time() : get_the_title($id); 

        if($id == 0){
            $defaults = array(
                'post_title' => $this->title,
                'post_status' => 'publish',
                'post_type' => $this->post_type,
            );
            $this->form_id = wp_insert_post($defaults);
        }
        else{
            $this->form_id = $id;
        }

        $enable_user_notification = isset($data['enable_user_notification']) ? $data['enable_user_notification'] : 0;
        $user_notification_email_subject = $data['user_notification_email_subject'];
        $user_notification_email_from = $data['user_notification_email_from'];
        $user_notification_email_reply_to = $data['user_notification_email_reply_to'];
        $user_notification_email_body = $data['user_notification_email_body'];
        $user_notification_email_attach_submission_copy = isset($data['user_notification_email_attach_submission_copy']) ? $data['user_notification_email_attach_submission_copy'] : 0;

        update_post_meta($this->form_id, $this->key_form_user.'_enable_user_notification', $enable_user_notification);
        update_post_meta($this->form_id, $this->key_form_user.'_user_notification_email_subject', $user_notification_email_subject);
        update_post_meta($this->form_id, $this->key_form_user.'_user_notification_email_from', $user_notification_email_from);
        update_post_meta($this->form_id, $this->key_form_user.'_user_notification_email_reply_to', $user_notification_email_reply_to);
        update_post_meta($this->form_id, $this->key_form_user.'_user_notification_email_body', $user_notification_email_body);
        update_post_meta($this->form_id, $this->key_form_user.'_user_notification_email_attach_submission_copy', $user_notification_email_attach_submission_copy);

        return [
            'saved' => true,
            'data' => [
                'id' => $this->form_id,
                'title' => $this->title,
                'type' => $this->post_type,
            ]
        ];

    }


    public function get_all_data($post_id){

        $post = get_post($post_id);

        if($post != null){

            return [
                
                'title' => $post->post_title,
                'success_message' => get_post_meta($post->ID, $this->key_form_general.'_success_message',  true),
                'capture_entries' => get_post_meta($post->ID, $this->key_form_general.'_capture_entries', true),
                'hide_form_after_submission' => get_post_meta($post->ID, $this->key_form_general.'_hide_form_after_submission', true),
                'redirect_to' => get_post_meta($post->ID, $this->key_form_general.'_redirect_to', true),
                'require_login' => get_post_meta($post->ID, $this->key_form_general.'_require_login', true),
                'limit_total_entries' => get_post_meta($post->ID, $this->key_form_general.'_limit_total_entries', true),
                'multiple_submission' => get_post_meta($post->ID, $this->key_form_general.'_multiple_submission', true),
                'enable_recaptcha' => get_post_meta($post->ID, $this->key_form_general.'_enable_recaptcha', true),
                'capture_user_browser_data' => get_post_meta($post->ID, $this->key_form_general.'_capture_user_browser_data', true),

                'enable_user_notification' => get_post_meta($post->ID, $this->key_form_user.'_enable_user_notification', true),
                'user_notification_email_subject' => get_post_meta($post->ID, $this->key_form_user.'_user_notification_email_subject', true),
                'user_notification_email_from' => get_post_meta($post->ID, $this->key_form_user.'_user_notification_email_from', true),
                'user_notification_email_reply_to' => get_post_meta($post->ID, $this->key_form_user.'_user_notification_email_reply_to', true),
                'user_notification_email_body' => get_post_meta($post->ID, $this->key_form_user.'_user_notification_email_body', true),
                'user_notification_email_attach_submission_copy' => get_post_meta($post->ID, $this->key_form_user.'_user_notification_email_attach_submission_copy', true),
                
            ];

        } 

    }




    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    
}