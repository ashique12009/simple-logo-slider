<?php
namespace SimpleLogoSlider\Admin;
/**
 * Class for registering a custom post type
 */
class SimpleLogoPostType {

    public function __construct()
    {
        add_action('init', [$this, 'register_post_type']);
    }

    /**
     * Register the custom post type
     */
    public function register_post_type() {
        $labels = array(
            'name'               => __( 'Simple Logo Slider', 'simple-logo-slider' ),
            'singular_name'      => __( 'Simple Logo Slider', 'simple-logo-slider' ),
            'menu_name'          => __( 'Simple Logo Slider', 'simple-logo-slider' ),
            'name_admin_bar'     => __( 'Simple Logo Slider', 'simple-logo-slider' ),
            'add_new'            => __( 'Add New', 'simple-logo-slider' ),
            'add_new_item'       => __( 'Add New Logo', 'simple-logo-slider' ),
            'new_item'           => __( 'New Logo', 'simple-logo-slider' ),
            'edit_item'          => __( 'Edit Logo', 'simple-logo-slider' ),
            'view_item'          => __( 'View Logo', 'simple-logo-slider' ),
            'all_items'          => __( 'All Logos', 'simple-logo-slider' ),
            'search_items'       => __( 'Search Logos', 'simple-logo-slider' ),
            'not_found'          => __( 'No logos found.', 'simple-logo-slider' ),
            'not_found_in_trash' => __( 'No logos found in Trash.', 'simple-logo-slider' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'simple-logo-slider' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'thumbnail', 'custom-fields' ),
            'show_in_rest'       => true, // Enable Gutenberg editor support
        );

        register_post_type( 'simple-logo-slider', $args );
    }
}
