<?php

namespace MetForm;

defined( 'ABSPATH' ) || exit;

final class Plugin{

    private static $instance;

    private $entries;
    private $forms;

    public function __construct(){

        require_once 'utils/dump.php';
        require_once 'autoloader.php';

        Autoloader::run();

        add_action( 'admin_menu',[$this,'metform_admin_menu']);

        //test settings
        add_action( 'admin_menu', [$this,'settings_page_create']);

        add_action('admin_enqueue_scripts', [$this,'Include_js_css_admin']);
        add_action('wp_enqueue_scripts', [$this,'Include_js_css_public']);
        add_action('admin_footer', [$this, 'modal_view']);
    
        $this->entries = Core\Entries\Init::instance();
        $this->forms = Core\Forms\Init::instance();

        Widgets\Manifest::get_instance()->init();
    
    }

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

        //test settings screen condition
        if($screen->id == 'edit-metform-form' || $screen->id == 'metform_page_mt-form-settings'){
            include_once $this->core_dir() . 'forms/view/modal_editor.php';
        }
    }

    function Include_js_css_public(){

        wp_enqueue_script('functions', plugin_dir_url(__FILE__) . 'libs/assets/js/functions.js', array(), '1.0.0', true);
        // wp_localize_script('functions', 'rest_api_login', [
        //     'nonce' => wp_create_nonce('wp_rest'),
        //   ]);
        
    }

    function Include_js_css_admin(){

        $screen = get_current_screen();

        // echo $screen->id;
        // die;

        //test settings screen condition
        if($screen->id == 'edit-metform-form' || $screen->id == 'metform_page_mt-form-settings'){

            wp_enqueue_style('metform-bootstrap', plugin_dir_url(__FILE__). 'libs/assets/css/bootstrap.css', false, '1.0.0');
            wp_enqueue_style('metform-admin-style', plugin_dir_url(__FILE__). 'libs/assets/css/admin-style.css', false, '1.0.0');

            wp_enqueue_script('metform-bootstrap', plugin_dir_url(__FILE__) . 'libs/assets/js/bootstrap.min.js', array(), '1.0.0', true);
            wp_enqueue_script('metform-admin-script', plugin_dir_url(__FILE__) . 'libs/assets/js/admin-script.js', array(), '1.0.0', true);
            wp_localize_script('metform-admin-script', 'metform_api', array( 'resturl' => get_rest_url() ));
        
        }
    }

    function metform_admin_menu() {

        add_menu_page(
            esc_html__('MetForm'),
            esc_html__('MetForm'),
            'read',
            'metform-menu',
            '',
            'dashicons-admin-home',
            5
        );
    
    }

    //test settings
    function settings_page_create() {
        $parent_slug = 'metform-menu';
        $page_title = 'Form Settings';
        $menu_title = 'Settings';
        $capability = 'edit_posts';
        $menu_slug = 'mt-form-settings';
        $function = [$this,'mt_form_settings_page_show'];
        $icon_url = '';
        $position = 24;

        add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    }

    //test settings
    function mt_form_settings_page_show(){
        ?>
        <h2>Setting Page</h2>
        <div class="column-title">
            <a data-metform-form-id="152" class="attr-btn attr-btn-info metform-form-edit-btn" href="#">Click Here</a>
        </div>
        
        <?php
    }

    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

}