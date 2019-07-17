<?php

namespace MetForm\Core\Entries;

Class Api extends \MetForm\Base\Api{

    public function config(){
        $this->prefix = 'entries';
        $this->param  = "/(?P<id>\d+)";
    }

    public function post_insert(){
        
        $form_id = $this->request['id'];

        $form_data = $this->request->get_params();

        $message = Action::instance()->store($form_id, $form_data);

        return $message;

    }

    public function get_list(){
        $content_id = $this->request['id'];
        $content_key = $this->request['key'];
        $content_type = $this->request['type'];
        
        $builder_post_title = 'entries-' . $content_type . '-' . $content_key;
        $builder_post_id = get_page_by_title($builder_post_title, OBJECT, 'metform-entry');

        return $content_id;

    }
    
}

