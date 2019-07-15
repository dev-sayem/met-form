<?php

namespace MetForm\Widgets;

Class Manifest{

    private static $instance = null;

    public static function get_instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

	public function init() {

		//$this->includes();

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

	}

	public function includes() {

		require_once plugin_dir_path(__FILE__) . 'form.php';

	}

	public function register_widgets() {

        $this->includes();

		//require_once plugin_dir_path(__FILE__) . 'wp-sayem-widget.php';

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Widget_My_Form() );
		

	}

}


?>