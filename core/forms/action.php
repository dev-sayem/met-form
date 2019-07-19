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
            $this->key_form_data = 'metform_form__form_setting';
            $this->post_type = Init::instance()->form->get_name();

    }

    public function store( $form_id, $form_data ){

        $this->fields = $this->get_fields();
        $this->sanitize( $form_data );
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

        $this->title = isset( $this->form_data['form_title']) ? $this->form_data['form_title'] : 'Metform # '.time();

        $defaults = array(
            'post_title' => $this->title,
            'post_status' => 'publish',
            'post_type' => $this->post_type,
        );
        $this->form_id = wp_insert_post( $defaults );

        update_post_meta( $this->form_id, $this->key_form_data, $this->form_data );
                
        return [
            'saved' => true,
            'status' => "Form settings inserted",
            'data' => [
                'id' => $this->form_id,
                'title' => $this->title,
                'type' => $this->post_type,
                ]
        ];
    }

    public function update(){

        if( isset( $this->form_data['form_title'] ) ){
            $update_post = array(
                'ID'           => $this->form_id,
                'post_title'   => $this->form_data['form_title'],
            );
            wp_update_post( $update_post );
        }

        update_post_meta( $this->form_id, $this->key_form_data, $this->form_data );
        
        return [
            'saved' => true,
            'status' => 'Form settings updated',
            'data' => [
                'id' => $this->form_id,
                'title' => $this->title,
                'type' => $this->post_type,
                ]
        ];
    }
            
    public function get_fields(){

        return [
        
            'form_title' => [ 
                'name' => 'form_title',
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
            'user_email_subject' => [
                'name' => 'user_email_subject',
            ],
            'user_email_from' => [
                'name' => 'user_email_from',
            ],
            'user_email_reply_to' => [
                'name' => 'user_email_reply_to',
            ],
            'user_email_body' => [
                'name' => 'user_email_body',
            ],
            'user_email_attach_submission_copy' => [
                'name' => 'user_email_attach_submission_copy',
            ],
            'enable_admin_notification' => [
                'name' => 'enable_admin_notification',
            ],
            'admin_email_subject' => [
                'name' => 'admin_email_subject',
            ],
            'admin_email_from' => [
                'name' => 'admin_email_from',
            ],
            'admin_email_reply_to' => [
                'name' => 'admin_email_reply_to',
            ],
            'admin_email_body' => [
                'name' => 'admin_email_body',
            ],
            'admin_email_attach_submission_copy' => [
                'name' => 'admin_email_attach_submission_copy',
            ],
        ];
    }

    public function sanitize( $form_data, $fields = null ){
        if( $fields == null ){
            $fields = $this->fields;
        }
        foreach( $form_data as $key => $value ){

            if( isset( $fields[$key] ) ){
                $this->form_data[ $key ] = $value;
            }

        }
    }


    public function get_all_data( $post_id ){

        $post = get_post( $post_id );

        $data = get_post_meta( $post->ID, $this->key_form_data,  true );

        return $data;   

    }

    public static function instance(){
        if ( !self::$instance ){
            self::$instance = new self();
        }
        return self::$instance;
    }

    
}