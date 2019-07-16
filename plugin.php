<?php

namespace MetForm;

defined( 'ABSPATH' ) || exit;

final class Plugin{

private static $instance;

public $entries;

public function version(){
    return '1.0.0';
}

public function package_type(){
    return 'free';
}

public function plugin_url(){
    return trailingslashit(plugin_dir_url( __FILE__ ));
}

public function plugin_dir(){
    return trailingslashit(plugin_dir_path( __FILE__ ));
}

public function core_url(){
    return $this->plugin_url() . 'core/';
}

public function core_dir(){
    return $this->plugin_dir() . 'core/';
}

public function base_url(){
    return $this->plugin_url() . 'base/';
}

public function base_dir(){
    return $this->plugin_dir() . 'base/';
}

public function utils_url(){
    return $this->plugin_url() . 'utils/';
}

public function utils_dir(){
    return $this->plugin_dir() . 'utils/';
}

public function widgets_url(){
    return $this->plugin_url() . 'widgets/';
}

public function widgets_dir(){
    return $this->plugin_dir() . 'widgets/';
}

function Include_js_css(){
wp_enqueue_script('functions', plugin_dir_url(__FILE__) . 'libs/js/functions.js', array(), '1.0.0', true);
}

public function __construct(){

    require_once 'utils/dump.php';
    require_once 'autoloader.php';

    Autoloader::run();

    add_action('wp_enqueue_scripts', [$this,'Include_js_css']);
   
    $this->entries = Core\Entries\Init::instance();

    new Core\Forms\Form;
    Widgets\Manifest::get_instance()->init();
 
}

public static function instance(){
    if (!self::$instance){
        self::$instance = new self();
    }
    return self::$instance;
}

}