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

    }

    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

}