<?php

namespace MetForm\Core\Forms;

Class Api extends \MetForm\Base\Api{

    public static $instance;

    public function config(){
        $this->prefix = 'forms';
        $this->param  = "/(?P<id>\d+)";
    }

    public function post_update(){

        $form_id = $this->request['id'];

        $form_data = $this->request->get_params();

        $message = Action::instance()->store($form_id,$form_data);

        return $message;

    }

    public function get_get(){

        $post_id = $this->request['id'];

        return $post_id;

        // $data = Action::instance()->get_all_data($post_id);

        // return $data;

    }

}