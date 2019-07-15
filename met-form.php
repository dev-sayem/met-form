<?php

namespace MetForm;

defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name: MetForm
 * Plugin URI:  https://xpeedstudio.com/metform/
 * Description: Most powerful plugin created to make building elementor forms
 * Version:     1.0.0
 * Author:      XpeedStudio
 * Author URI:  https://xpeedstudio.com
 * Text Domain: metform
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

 final class MetForm{
    
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

    public function __construct(){

        require_once 'utils/dump.php';
        require_once 'autoloader.php';

        Autoloader::run();
       
        $test = new  Core\Test();
        $msg = $test->get_test();
        
        new Core\Entries\Cpt;
        new Core\Forms\Form;
        Widgets\Manifest::get_instance()->init();
        
    }

 }

 new MetForm();


