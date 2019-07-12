<?php

namespace Korn\Base;

abstract Class Cpt{

    public function init() {
        // $this->post_type();
        // register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
        // register_activation_hook( __FILE__, [$this, 'flush_rewrites'] );
        add_action('init',[$this,'post_type']);   
    }

    public abstract function post_type();

    // public function flush_rewrites() {
    //     $this->post_type();
    //     flush_rewrite_rules();
    // }

}

?>