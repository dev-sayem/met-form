<?php

namespace MetForm\Core\Entries;

Class Action{

    public static $instance;

    private $key_form_id;
    private $key_form_data;
    private $key_form_settings;
    private $key_browser_data;
    private $key_form_total_entries;
    private $post_type;

    private $fields;
    private $entry_id;
    private $form_id;
    private $form_data;
    private $form_settings;
    private $title;
    private $entry_count;

    private $response;

    public function __construct()
    {
        $this->response = (object)[
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
        $this->key_browser_data = 'metform_form__entry_browser_data';
        $this->key_form_id = 'metform_entries__form_id';
        $this->key_form_data = 'metform_entries__form_data';
        $this->post_type = Init::instance()->cpt->get_name();

    }

    public function get_entry_count(){
        if($this->entry_count != null){
            return $this->entry_count;
        }
        $this->entry_count = get_post_meta($this->form_id, $this->key_form_total_entries, true);
        $this->entry_count = ($this->entry_count == '') ? 1 : ((int)$this->entry_count);

        return $this->entry_count;

    }
    public function get_browser_data(){

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        return [
            'ip' => $ip,
            'user_agent' => $user_agent,
        ];
    }

    public function submit($form_id, $form_data){

        $this->form_id = $form_id;

        $this->form_settings = get_post_meta($form_id, $this->key_form_settings, true);

        $this->response->data['redirect_to'] = (!isset($this->form_settings['redirect_to'])) ? '' : $this->form_settings['redirect_to'];
        $this->response->data['hide_form'] = (!isset($this->form_settings['hide_form_after_submission']) ? '' : $this->form_settings['hide_form_after_submission']);
        
        $required_loggin = isset($this->form_settings['require_login']) ? ((int)($this->form_settings['require_login'])) : 0;

        if(($required_loggin == 1) && (!is_user_logged_in())){
            $this->response->status = 0;
            $this->response->error[] = esc_html__('You must be logged in to submit form.','metform');
            return $this->response;
        }

        $entry_limit = ((int)($this->form_settings['limit_total_entries']));

        if(($entry_limit == 1) && ($this->get_entry_count() >= $this->form_settings['limit_total_entries'])){
            $this->response->status = 0;
            $this->response->error[] = esc_html__('Form submission limit execed.','metform');

            return $this->response;
        }

        // $multiple_submission = (!isset($this->form_settings['multiple_submission'])) ? '' : $this->form_settings['multiple_submission'];

        // if($multiple_submission == '' && isset($_COOKIE['metform_form_submitted'])){
            
        //     $this->response->status = 0;
        //     $this->response->error[] = esc_html__('You can not submit this form multiple.','metform');
        //     return $this->response;

        // }else{

        //     $visit_time = date('d-m-Y g:i a');
        //     setcookie('metform_form_submitted',  $visit_time, time()+86400);

        // }

        if(isset($this->form_settings['store_entries']) && $this->form_settings['store_entries'] == 1){

            $this->store($form_id, $form_data);

        }

        if(isset($this->form_settings['enable_user_notification']) && $this->form_settings['enable_user_notification'] == 1){

            $this->send_user_email($form_data);

        }

        if(isset($this->form_settings['enable_admin_notification']) && $this->form_settings['enable_admin_notification'] == 1){

            $this->send_admin_email();
        } 

        
        return $this->response;
        
    }

    public function send_user_email($form_data){

        $user_mail = isset($form_data['email']) ? $form_data['email'] : null;
        $subject = isset($this->form_settings['user_email_subject']) ? $this->form_settings['user_email_subject'] : null;
        $from = isset($this->form_settings['user_email_from']) ? $this->form_settings['user_email_from'] : null;
        $reply_to = isset($this->form_settings['user_email_reply_to']) ? $this->form_settings['user_email_reply_to'] : null;
        $body = isset($this->form_settings['user_email_body']) ? $this->form_settings['user_email_body'] : null;
        $user_email_attached_submision_copy = isset($this->form_settings['user_email_attach_submission_copy']) ? $this->form_settings['user_email_attach_submission_copy'] : null;

        if(!$user_mail){
            $this->response->error[] = 'user mail not found';
        }else{
            $header [] = 'From : '.$from;
            $header [] = 'Reply to : '.$reply_to;
            $status = wp_mail($user_mail, $subject, $body, $header);

            if($status){
                $this->response->status = 1;
                $this->response->data['message'] = esc_html__('mail sended to user','metform');
            }
        }

    }
    public function send_admin_email(){

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
            $this->response->status = 1;
            $this->response->data['message'] = esc_html__('mail sended to admin','metform');
        }

    }

    public function store($form_id, $form_data, $entry_id = null){
        
        $this->form_id = $form_id;
        $this->fields = $this->get_fields();
        $this->sanitize($form_data);
        $this->entry_id = $entry_id;

        if( $this->entry_id == null ){
            $this->insert();
        }
        else {
            $this->update();
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
        foreach($form_data as $key => $value){

            if(isset($fields[$key])){
                $this->form_data[ $key ] = $value;
            }

        }
    }
    
    private function insert(){
        
        $form_settings = $this->form_settings;
        $form_id = $this->form_id;

        $this->title = get_the_title($this->form_id);
        
        $defaults = array(
            'post_title' => $this->title,
            'post_status' => 'publish',
            'post_content' => '',
            'post_type' => $this->post_type,
        );
        //$this->response->data['form_settings'] = $this->form_settings;
        $this->entry_id = wp_insert_post($defaults);

        $this->response->data['form_id'] = $form_id;
        $this->response->data['form_settings'] = $form_settings;

        $this->entry_count++;
        update_post_meta( $form_id, $this->key_form_total_entries, $this->entry_count );
        update_post_meta( $this->entry_id, $this->key_form_id, $form_id );
        update_post_meta( $this->entry_id, $this->key_form_data, $this->form_data );
        
        //$this->response->data['form_settings'] = $form_settings;

        if(isset($form_settings['capture_user_browser_data']) && $form_settings['capture_user_browser_data'] == '1'){
            update_post_meta( $this->entry_id, $this->key_browser_data, $this->get_browser_data() );
            $this->response->status = 1;
            $this->response->data['message1'] = esc_html__('capture browser data','metform');
        }

        $this->response->status = 1;
        $this->response->data['message'] = $form_settings['success_message'];
        
    }
    
    private function update(){

        update_post_meta( $this->entry_id, $this->key_form_id, $this->form_id );
        update_post_meta( $this->entry_id, $this->key_form_data, $this->form_data );

        $this->response->status = 1;
        $this->response->data['message'] = $this->form_settings['success_message'];

    }

    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

}
