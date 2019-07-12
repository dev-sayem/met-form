<?php

namespace Korn\Core\Settings;

Class Setting extends \Korn\Base\Cpt{

    public function __construct()
    {
        parent::init();
    }

    public function get_name(){
        return 'korn-form-setting';
    }

    public function post_type()
    {
        $labels = array(
            'name'                  => _x( 'Form Settings', 'Post Type General Name', 'korn' ),
            'singular_name'         => _x( 'Form setting', 'Post Type Singular Name', 'korn' ),
            'menu_name'             => esc_html__( 'Form setting', 'korn' ),
            'name_admin_bar'        => esc_html__( 'Form setting', 'korn' ),
            'archives'              => esc_html__( 'Setting Archives', 'korn' ),
            'attributes'            => esc_html__( 'Setting Attributes', 'korn' ),
            'parent_item_colon'     => esc_html__( 'Parent Setting:', 'korn' ),
            'all_items'             => esc_html__( 'All Settings', 'korn' ),
            'add_new_item'          => esc_html__( 'Add New Setting', 'korn' ),
            'add_new'               => esc_html__( 'Add New', 'korn' ),
            'new_item'              => esc_html__( 'New Setting', 'korn' ),
            'edit_item'             => esc_html__( 'Edit Setting', 'korn' ),
            'update_item'           => esc_html__( 'Update Setting', 'korn' ),
            'view_item'             => esc_html__( 'View Setting', 'korn' ),
            'view_items'            => esc_html__( 'View Settings', 'korn' ),
            'search_items'          => esc_html__( 'Search Setting', 'korn' ),
            'not_found'             => esc_html__( 'Not found', 'korn' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'korn' ),
            'featured_image'        => esc_html__( 'Featured Image', 'korn' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'korn' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'korn' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'korn' ),
            'insert_into_item'      => esc_html__( 'Insert into setting', 'korn' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this setting', 'korn' ),
            'items_list'            => esc_html__( 'Settings list', 'korn' ),
            'items_list_navigation' => esc_html__( 'Settings list navigation', 'korn' ),
            'filter_items_list'     => esc_html__( 'Filter setting list', 'korn' ),
        );
        $rewrite = array(
            'slug'                  => 'korn-form-setting',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__( 'Form Settings', 'korn' ),
            'description'           => esc_html__( 'korn-form-settings', 'korn' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'elementor', 'permalink' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'publicly_queryable' => true,
            'rewrite'               => $rewrite,
            'query_var' => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            'rest_base'             => 'korn-content',
        );

        return $args;

    }

}