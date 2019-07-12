<?php

namespace MetForm\Core\Entries;

Class Entry extends \MetForm\Base\Cpt {

    public function __construct()
    {
        parent::init();
    }

    public function get_name(){
        return 'korn-form-entry';
    }

    public function post_type()
    {
        $labels = array(
            'name'                  => _x( 'Form entries', 'Post Type General Name', 'korn' ),
            'singular_name'         => _x( 'Form entry', 'Post Type Singular Name', 'korn' ),
            'menu_name'             => esc_html__( 'Form entry', 'korn' ),
            'name_admin_bar'        => esc_html__( 'Form entry', 'korn' ),
            'archives'              => esc_html__( 'Entry Archives', 'korn' ),
            'attributes'            => esc_html__( 'Entry Attributes', 'korn' ),
            'parent_item_colon'     => esc_html__( 'Parent Entry:', 'korn' ),
            'all_items'             => esc_html__( 'All Entries', 'korn' ),
            'add_new_item'          => esc_html__( 'Add New Entry', 'korn' ),
            'add_new'               => esc_html__( 'Add New', 'korn' ),
            'new_item'              => esc_html__( 'New Entry', 'korn' ),
            'edit_item'             => esc_html__( 'Edit Entry', 'korn' ),
            'update_item'           => esc_html__( 'Update Entry', 'korn' ),
            'view_item'             => esc_html__( 'View Entry', 'korn' ),
            'view_items'            => esc_html__( 'View Entries', 'korn' ),
            'search_items'          => esc_html__( 'Search Entry', 'korn' ),
            'not_found'             => esc_html__( 'Not found', 'korn' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'korn' ),
            'featured_image'        => esc_html__( 'Featured Image', 'korn' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'korn' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'korn' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'korn' ),
            'insert_into_item'      => esc_html__( 'Insert into entry', 'korn' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this entry', 'korn' ),
            'items_list'            => esc_html__( 'Entries list', 'korn' ),
            'items_list_navigation' => esc_html__( 'Entries list navigation', 'korn' ),
            'filter_items_list'     => esc_html__( 'Filter entry list', 'korn' ),
        );
        $rewrite = array(
            'slug'                  => 'korn-form-entry',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__( 'Form entry', 'korn' ),
            'description'           => esc_html__( 'korn-form-entry', 'korn' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'elementor', 'permalink' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 10,
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

?>