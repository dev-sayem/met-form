<?php

namespace MetForm\Core\Entries;

Class Action{

    public static $instance;

    private $key_form_id;
    private $key_form_data;
    private $post_type;

    private $fields;
    private $entry_id;
    private $form_id;
    private $form_data;
    private $title;

    public function __construct()
    {
            $this->key_form_id = 'metform_entries__form_id';
            $this->key_form_data = 'metform_entries__form_data';
            $this->post_type = Init::instance()->cpt->get_name();
    }

    public function store($form_id, $form_data, $entry_id = null){
        
        $this->fields = $this->get_fields();
        $this->sanitize($form_data);
        $this->form_id = $form_id;
        $this->entry_id = $entry_id;

        if( $this->entry_id == null ){
            $message = $this->insert();
            return $message;
        }
        else {
            $message = $this->update();
            return $message;
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

        update_post_meta( $this->entry_id, $this->key_form_id, $this->form_id );
        update_post_meta( $this->entry_id, $this->key_form_data, $this->form_data );

        return [
            'status' => 1,
            'message' => esc_html__('From submitted','metform'),
        ];

    }

    private function update(){
        update_post_meta( $this->entry_id, $this->key_form_id, $this->form_id );
        update_post_meta( $this->entry_id, $this->key_form_data, $this->form_data );
        
        return [
            'status' => 1,
            'message' => esc_html__('From updated','metform'),
        ];
    }

    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

}
