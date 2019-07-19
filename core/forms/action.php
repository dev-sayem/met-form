<?php
namespace MetForm\Core\Forms;

Class Action{

    public static $instance;

    private $key_form_data;
    private $post_type;

    private $fields;
    private $form_id;
    private $form_data;
    private $title;

    public function __construct()
    {
            $this->key_form_data = 'metform_form__form_data';
            $this->post_type = Init::instance()->form->get_name();

    }

    public function store($form_id, $form_data){

        $this->fields = $this->get_fields();
        $this->sanitize($form_data);
        $this->form_id = $form_id;

        if($this->form_id == 0){
            $message = $this->insert();
            return $message;
        }else{
            $message = $this->update();
            return $message;
        }
                    
    }
                
    public function insert(){
        
        $this->title = isset($this->form_data['title']) ? $this->form_data['title'] : 'Metform # '.time();
        $defaults = array(
            'post_title' => $this->title,
            'post_status' => 'publish',
            'post_type' => $this->post_type,
        );
        $this->form_id = wp_insert_post($defaults);

        update_post_meta($this->form_id, $this->key_form_data, $this->form_data);
                
        return [
            'saved' => true,
            'data' => [
                'id' => $this->form_id,
                'title' => $this->title,
                'type' => $this->post_type,
                ]
        ];
    }

    public function update(){

        update_post_meta($this->form_id, $this->key_form_data, $this->form_data);
        
        return [
            'saved' => true,
            'data' => [
                'id' => $this->form_id,
                'title' => $this->title,
                'type' => $this->post_type,
                ]
        ];
    }
            
    public function get_fields(){

        return [
        
            'title' => [ 
                'name' => 'title',
            ],
            'success_message' => [ 
                'name' => 'success_message',
            ],
            'capture_entries' => [ 
                'name' => 'capture_entries',
            ], 
            'hide_form_after_submission' => [
                'name' => 'hide_form_after_submission',
            ],
            'redirect_to' => [
                'name' => 'redirect_to',
            ],
            'require_login' => [
                'name' => 'require_login',
            ],
            'limit_total_entries' => [
                'name' => 'limit_total_entries',
            ],
            'multiple_submission' => [
                'name' => 'multiple_submission',
            ],
            'enable_recaptcha' => [
                'name' => 'enable_recaptcha',
            ],
            'capture_user_browser_data' => [
                'name' => 'capture_user_browser_data',
            ],
            'enable_user_notification' => [
                'name' => 'enable_user_notification',
            ],
            'user_notification_email_subject' => [
                'name' => 'user_notification_email_subject',
            ],
            'user_notification_email_from' => [
                'name' => 'user_notification_email_from',
            ],
            'user_notification_email_reply_to' => [
                'name' => 'user_notification_email_reply_to',
            ],
            'user_notification_email_body' => [
                'name' => 'user_notification_email_body',
            ],
            'user_notification_email_attach_submission_copy' => [
                'name' => 'user_notification_email_attach_submission_copy',
            ],
            'enable_admin_notification' => [
                'name' => 'enable_admin_notification',
            ],
            'admin_notification_email_subject' => [
                'name' => 'admin_notification_email_subject',
            ],
            'admin_notification_email_from' => [
                'name' => 'admin_notification_email_from',
            ],
            'admin_notification_email_reply_to' => [
                'name' => 'admin_notification_email_reply_to',
            ],
            'admin_notification_email_body' => [
                'name' => 'admin_notification_email_body',
            ],
            'admin_notification_email_attach_submission_copy' => [
                'name' => 'admin_notification_email_attach_submission_copy',
            ],
        ];
    }

    public function sanitize($form_data, $fields = null){
        if($fields == null){
            $fields = $this->fields;
        }
        foreach( $form_data as $key => $value){

            if(isset($fields[$key])){
                $this->form_data[ $key ] = $value;
            }

        }
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

                'enable_user_notification' => get_post_meta($post->ID, $this->key_form_user.'_enable_notification', true),
                'user_notification_email_subject' => get_post_meta($post->ID, $this->key_form_user.'_notification_email_subject', true),
                'user_notification_email_from' => get_post_meta($post->ID, $this->key_form_user.'_notification_email_from', true),
                'user_notification_email_reply_to' => get_post_meta($post->ID, $this->key_form_user.'_notification_email_reply_to', true),
                'user_notification_email_body' => get_post_meta($post->ID, $this->key_form_user.'_notification_email_body', true),
                'user_notification_email_attach_submission_copy' => get_post_meta($post->ID, $this->key_form_user.'_notification_email_attach_submission_copy', true),
                
                'enable_admin_notification' => get_post_meta($post->ID, $this->key_form_admin.'_enable_notification', true),
                'admin_notification_email_subject' => get_post_meta($post->ID, $this->key_form_admin.'_notification_email_subject', true),
                'admin_notification_email_from' => get_post_meta($post->ID, $this->key_form_admin.'_notification_email_from', true),
                'admin_notification_email_reply_to' => get_post_meta($post->ID, $this->key_form_admin.'_notification_email_reply_to', true),
                'admin_notification_email_body' => get_post_meta($post->ID, $this->key_form_admin.'_notification_email_body', true),
                'admin_notification_email_attach_submission_copy' => get_post_meta($post->ID, $this->key_form_admin.'_notification_email_attach_submission_copy', true),
                
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