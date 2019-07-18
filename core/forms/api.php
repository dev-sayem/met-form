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

        $data = $this->request->get_params();

        return $data;

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

        $content_id = $this->request['id'];
        return $content_id;

    }

}