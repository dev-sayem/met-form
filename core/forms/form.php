<?php

namespace MetForm\Core\Forms;

Class Form extends \MetForm\Base\Cpt{

    public function __construct()
    {
        parent::init();
    }

    public function get_name(){
        return 'metform-form';
    }

    public function post_type()
    {
        $labels = array(
            'name'                  => _x( 'Forms', 'Post Type General Name', 'met-form' ),
            'singular_name'         => _x( 'Form', 'Post Type Singular Name', 'met-form' ),
            'menu_name'             => esc_html__( 'Form', 'met-form' ),
            'name_admin_bar'        => esc_html__( 'Form', 'met-form' ),
            'archives'              => esc_html__( 'Form Archives', 'met-form' ),
            'attributes'            => esc_html__( 'Form Attributes', 'met-form' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'met-form' ),
            'all_items'             => esc_html__( 'All Items', 'met-form' ),
            'add_new_item'          => esc_html__( 'Add New Item', 'met-form' ),
            'add_new'               => esc_html__( 'Add New', 'met-form' ),
            'new_item'              => esc_html__( 'New Item', 'met-form' ),
            'edit_item'             => esc_html__( 'Edit Item', 'met-form' ),
            'update_item'           => esc_html__( 'Update Item', 'met-form' ),
            'view_item'             => esc_html__( 'View Item', 'met-form' ),
            'view_items'            => esc_html__( 'View Items', 'met-form' ),
            'search_items'          => esc_html__( 'Search Item', 'met-form' ),
            'not_found'             => esc_html__( 'Not found', 'met-form' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'met-form' ),
            'featured_image'        => esc_html__( 'Featured Image', 'met-form' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'met-form' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'met-form' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'met-form' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'met-form' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'met-form' ),
            'items_list'            => esc_html__( 'Forms list', 'met-form' ),
            'items_list_navigation' => esc_html__( 'Forms list navigation', 'met-form' ),
            'filter_items_list'     => esc_html__( 'Filter froms list', 'met-form' ),
        );
        $rewrite = array(
            'slug'                  => 'metform-form',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__( 'Forms', 'met-form' ),
            'description'           => esc_html__( 'metform form', 'met-form' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'elementor', 'permalink' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_icon'             => 'dashicons-text-page',
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
            'rest_base'             => $this->get_name(),
        );

        return $args;

    }

}