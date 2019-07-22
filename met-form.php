<?php

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


defined( 'ABSPATH' ) || exit;

require 'plugin.php';

function metform(){
    return MetForm\Plugin::instance();
}

add_action( 'plugins_loaded', 'metform' );

// $data = get_post_meta(150, 'metform_form__form_total_entries', true);
// var_dump($data);