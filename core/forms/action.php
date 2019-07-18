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
            $this->key_form_user_notification = 'mf_form__user';
            $this->key_form_admin_notification = 'mf_form__admin';
            
            $this->post_type = Init::instance()->form->get_name();

    }

    public function store_general($id,$data){

        $this->title = $data['title'];

        $success_message = $data['success_message'];
        $capture_entries = $data['capture_entries'];
        $hide_form_after_submission = $data['hide_form_after_submission'];
        $redirect_to = $data['redirect_to'];
        $require_login = $data['require_login'];
        $limit_total_entries = $data['limit_total_entries'];
        $multiple_submission = $data['multiple_submission'];
        $enable_recaptcha = $data['enable_recaptcha'];
        $capture_user_browser_data = $data['capture_user_browser_data'];

        if($id == 0){
            $defaults = array(
                'post_title' => $this->title,
                'post_status' => 'publish',
                'post_type' => $this->post_type,
            );
            $this->form_id = wp_insert_post($defaults);
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


    public function get_all_data($post_id){

        $post = get_post($post_id);

        if($post != null){

            return [
                'title' => $post->post_title,
                'success_message' => get_post_meta($post->ID,$this->key_form_general.'_success_message',true),
                'capture_entries' => get_post_meta($post->ID,$this->key_form_general.'_capture_entries',true),
                'hide_form_after_submission' => get_post_meta($post->ID,$this->key_form_general.'_hide_form_after_submission',true),
                'redirect_to' => get_post_meta($post->ID,$this->key_form_general.'_redirect_to',true),
                'require_login' => get_post_meta($post->ID,$this->key_form_general.'_require_login',true),
                'limit_total_entries' => get_post_meta($post->ID,$this->key_form_general.'_limit_total_entries',true),
                'multiple_submission' => get_post_meta($post->ID,$this->key_form_general.'_multiple_submission',true),
                'enable_recaptcha' => get_post_meta($post->ID,$this->key_form_general.'_enable_recaptcha',true),
                'capture_user_browser_data' => get_post_meta($post->ID,$this->key_form_general.'_capture_user_browser_data',true),
                
            ];

        } 
        //return true;

    }




    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    
}