<?php

namespace MetForm\Core\Forms;

Class Init{

    private static $instance;

    public $form;

    public $api;

    public function __construct()
    {
        $this->form = new Form();
        $this->api = new Api();

    }

    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

}