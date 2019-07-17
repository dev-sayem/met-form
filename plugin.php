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
public function modal_view(){
    $screen = get_current_screen();
    if($screen->id == 'edit-metform-form'){
        include_once $this->core_dir() . 'forms/view/modal_editor.php';
    }
}

function Include_js_css_public(){
    wp_enqueue_script('functions', plugin_dir_url(__FILE__) . 'libs/assets/js/functions.js', array(), '1.0.0', true);
}

function Include_js_css_admin(){

    $screen = get_current_screen();

    if($screen->id == 'edit-metform-form'){

        wp_enqueue_style('metform-bootstrap', plugin_dir_url(__FILE__). 'libs/assets/css/bootstrap.css', false, '1.0.0');
        wp_enqueue_style('metform-admin-style', plugin_dir_url(__FILE__). 'libs/assets/css/select2.min.css', false, '1.0.0');
        wp_enqueue_style('metform-admin-style', plugin_dir_url(__FILE__). 'libs/assets/css/admin-style.css', false, '1.0.0');

        wp_enqueue_script('metform-bootstrap', plugin_dir_url(__FILE__) . 'libs/assets/js/bootstrap.min.js', array(), '1.0.0', true);
        wp_enqueue_script('metform-select2', plugin_dir_url(__FILE__) . 'libs/assets/js/select2.min.js', array(), '1.0.0', true);
        wp_enqueue_script('metform-admin-script', plugin_dir_url(__FILE__) . 'libs/assets/js/admin-script.js', array(), '1.0.0', true);
        wp_localize_script('metform-admin-script', 'metform_form_url', array( 'siteurl' => get_option('siteurl') ));
    
    }
}

public function __construct(){

    require_once 'utils/dump.php';
    require_once 'autoloader.php';

    Autoloader::run();

    add_action('admin_enqueue_scripts', [$this,'Include_js_css_admin']);
    add_action('wp_enqueue_scripts', [$this,'Include_js_css_public']);
    add_action('admin_footer', [$this, 'modal_view']);
   
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