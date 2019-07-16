<?php

namespace MetForm\Core\Entries;

Class Init{

    private static $instance;

    public $cpt;

    public $api;

    public $form_data;

    public function __construct()
    {
        $this->cpt = new Cpt();
        $this->api = new Api();
        $this->form_data = new Form_Data();

        add_action( 'admin_menu',[$this,'metform_admin_menu']);

    }

    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    function metform_admin_menu() {

        add_menu_page(
            esc_html__('MetForm'),
            esc_html__('MetForm'),
            'read',
            'metform-menu',
            '',
            'dashicons-admin-home',
            5
        );
    
     }

}