<?php

namespace MetForm\Core\Entries;

Class Api extends \MetForm\Base\Api{

    public function config(){
        $this->prefix = 'entries';
        $this->param  = "/(?P<id>\d+)";
    }

    public function post_insert(){
        $form_id = $this->request['id'];
        $form_title = $this->request['title'];
        $form_data = $this->request['data'];
        print_r($_POST); exit();
        // return $content_key;
        
        //$builder_post_title = 'entries-' . $content_type . '-' . $content_key;
        $builder_post_id = get_page_by_title($form_title, OBJECT, 'metform-entry');

        if(is_null($builder_post_id)){
            $defaults = array(
                'post_title' => $form_title,
                'post_status' => 'publish',
                'post_type' => 'metform-entry',
            );
            $builder_post_id = wp_insert_post($defaults);

            update_post_meta( $builder_post_id, 'metform_entries__form_data', $form_data );
            update_post_meta( $builder_post_id, 'metform_entries__form_id', $form_id );

            return [
                'status' => 0,
                'message' => 'inserted'
            ];


        }else{
            $builder_post_id = $builder_post_id->ID;
            return [
                'status' => 1,
                'message' => 'updated'
            ];
        }

        // $url = get_admin_url() . '/post.php?post='.$builder_post_id.'&action=elementor';
        // wp_redirect( $url );
        // exit;
    }

    public function get_list(){
        $content_id = $this->request['id'];
        $content_key = $this->request['key'];
        $content_type = $this->request['type'];
        // return $content_key;
        
        $builder_post_title = 'entries-' . $content_type . '-' . $content_key;
        $builder_post_id = get_page_by_title($builder_post_title, OBJECT, 'metform-entry');

        return $content_id;

    }
    
}

