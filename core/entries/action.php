<?php

namespace MetForm\Core\Entries;

Class Action{

    public static $instance;

    private $key_form_id;
    private $key_form_data;
    private $key_form_settings;
    private $key_form_total_entries;
    private $post_type;

    private $fields;
    private $entry_id;
    private $form_id;
    private $form_data;
    private $form_settings;
    private $title;

    private $message;

    public function __construct()
    {
        $this->message = (object)[
            'status' => 0,
            'error' => [
                esc_html__('some thing went wrong.','metrom'),
            ],
            'data' => [
                'message' => '',
            ],
        ];

        $this->key_form_settings = 'metform_form__form_setting';
        $this->key_form_total_entries = 'metform_form__form_total_entries';
        $this->key_form_id = 'metform_entries__form_id';
        $this->key_form_data = 'metform_entries__form_data';
        $this->post_type = Init::instance()->cpt->get_name();

    }

    public function check_settings($form_id, $form_data){

        $this->form_id = $form_id;

        $this->form_settings = get_post_meta($form_id, $this->key_form_settings, true);

        $required_loggin = isset($this->form_settings['require_login']) ? ((int)($this->form_settings['require_login'])) : 0;

        if(($required_loggin == 1) && (is_user_logged_in() == false)){
            $this->message->status = 0;
            $this->message->error[] = esc_html__('You must be logged in to submit form.','metform');
            return $this->message;
        }

        if(isset($this->form_settings['capture_entries']) && $this->form_settings['capture_entries'] == 1){

            $this->store($this->form_id, $form_data);

        }

        if(isset($this->form_settings['enable_user_notification']) && $this->form_settings['enable_user_notification'] == 1){

            $this->send_user_email($form_data);

        }

        if(isset($this->form_settings['enable_admin_notification']) && $this->form_settings['enable_admin_notification'] == 1){

            $this->send_admin_email($form_data);
        }

        return $this->message;
        
    }

    public function send_user_email($form_data){

        $user_mail = isset($form_data['email']) ? $form_data['email'] : null;
        $subject = isset($this->form_settings['user_email_subject']) ? $this->form_settings['user_email_subject'] : null;
        $from = isset($this->form_settings['user_email_from']) ? $this->form_settings['user_email_from'] : null;
        $reply_to = isset($this->form_settings['user_email_reply_to']) ? $this->form_settings['user_email_reply_to'] : null;
        $body = isset($this->form_settings['user_email_body']) ? $this->form_settings['user_email_body'] : null;
        $user_email_attached_submision_copy = isset($this->form_settings['user_email_attach_submission_copy']) ? $this->form_settings['user_email_attach_submission_copy'] : null;

        if(!$user_mail){
            $this->message->error[] = 'user mail not found';
        }else{
            $header [] = 'From : '.$from;
            $header [] = 'Reply to : '.$reply_to;
            $status = wp_mail($user_mail, $subject, $body, $header);

            if($status){
                $this->message->data['message'] = esc_html__('mail sended to user','metform');
            }
        }

    }
    public function send_admin_email($form_data){

        $subject = isset($this->form_settings['admin_email_subject']) ? $this->form_settings['admin_email_subject'] : null;
        $from = isset($this->form_settings['admin_email_from']) ? $this->form_settings['admin_email_from'] : null;
        $reply_to = isset($this->form_settings['admin_email_reply_to']) ? $this->form_settings['admin_email_reply_to'] : null;
        $body = isset($this->form_settings['admin_email_body']) ? $this->form_settings['admin_email_body'] : null;
        $admin_email_attached_submision_copy = isset($this->form_settings['admin_email_attach_submission_copy']) ? $this->form_settings['admin_email_attach_submission_copy'] : null;

        $admin_email = get_option('admin_email', false);

        $header [] = 'From : '.$from;
        $header [] = 'Reply to : '.$reply_to;

        $status = wp_mail($admin_email, $subject, $body, $header);

        if($status){
            $this->message->data['message'] = esc_html__('mail sended to admin','metform');
        }

    }

    public function store($form_id, $form_data, $entry_id = null){
        
        $this->fields = $this->get_fields();
        $this->sanitize($form_data);
        $this->entry_id = $entry_id;

        if( $this->entry_id == null ){
            return $this->insert();
        }
        else {
            return $this->update();
        }

    }

    public function get_fields(){
        return [

            'name' => [ 
                'name' => 'name',
                'level' => 'First Name',
            ],

            'phone' => [ 
                'name' => 'phone',
                'level' => 'Phone No',
            ],

            'email' => [
                'name' => 'email',
                'level' => 'Email',
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
    
    private function insert(){

        $this->title = get_the_title($this->form_id);

        $defaults = array(
            'post_title' => $this->title,
            'post_status' => 'publish',
            'post_type' => $this->post_type,
        );
        $this->entry_id = wp_insert_post($defaults);

        $entry_count = get_post_meta($this->form_id, $this->key_form_total_entries, true);
        $entry_count = ($entry_count == '') ? 1 : ((int)$entry_count);

        if($entry_count < $this->form_settings['limit_total_entries']){

            $entry_count++;

            update_post_meta( $this->form_id, $this->key_form_total_entries, $entry_count );
            update_post_meta( $this->entry_id, $this->key_form_id, $this->form_id );
            update_post_meta( $this->entry_id, $this->key_form_data, $this->form_data );

            $this->message->status = 1;
            $this->message->data['message'] = esc_html__($this->form_settings['success_message'],'metform');

        }else{

            $this->message->status = 1;
            $this->message->data['message'] = esc_html__('Form submission limit execed.','metform');

        }

        //$this->message->data['form_limit'] = esc_html__($this->form_settings['limit_total_entries'],'metform');
        $this->message->data['hide_form'] = esc_html__(isset($this->form_settings['hide_form_after_submission']) ? $this->form_settings['hide_form_after_submission'] : 0,'metform');
        $this->message->data['redirect_to'] = esc_html__(isset($this->form_settings['redirect_to']) ? $this->form_settings['redirect_to'] : 0,'metform');
        
    }
    
    private function update(){

        update_post_meta( $this->entry_id, $this->key_form_id, $this->form_id );
        update_post_meta( $this->entry_id, $this->key_form_data, $this->form_data );

        $this->message->status = 1;
        $this->message->data['message'] = esc_html__($this->form_settings['success_message'],'metform');
        $this->message->data['hide_form'] = esc_html__(isset($this->form_settings['hide_form_after_submission']) ? $this->form_settings['hide_form_after_submission'] : 0,'metform');
        $this->message->data['redirect_to'] = esc_html__(isset($this->form_settings['redirect_to']) ? $this->form_settings['redirect_to'] : 0,'metform');

    }

    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

}
