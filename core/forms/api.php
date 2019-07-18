<?php

namespace MetForm\Core\Forms;

Class Api extends \MetForm\Base\Api{

    public static $instance;

    public function config(){
        $this->prefix = 'forms';
        $this->param  = "/(?P<id>\d+)";
    }

    public function post_insert(){

        $data = $this->request;

        return $data;

    }

    public function post_update_general(){

        $form_id = $this->request['id'];

        $form_data = $this->request->get_params();

        $message = Action::instance()->store_general($form_id,$form_data);

        return $message;

    }

    public function post_update_user_notification(){

        $data = $this->request->get_params();

        return $data;

    }

    public function post_update_admin_notification(){

        $data = $this->request->get_params();

        return $data;

    }

    public function get_list(){

        $post_id = $this->request['id'];

        $data = Action::instance()->get_all_data($post_id);

        return $data;

    }

}