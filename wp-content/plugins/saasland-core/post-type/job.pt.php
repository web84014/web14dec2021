<?php
// event.pt.php

/**
 * Use namespace to avoid conflict
 */
namespace PostType;

/**
 * Class Job
 * @package PostType
 *
 * Use actual name of post type for
 * easy readability.
 *
 * Potential conflicts removed by namespace
 */
class Job {

    /**
     * @var string
     *
     * Set post type params
     */
    private $type               = 'job';
    private $slug               = 'job';
    private $name               = 'Jobs';
    private $singular_name      = 'Job';
    private $icon               = 'dashicons-clipboard';

    /**
     * Register post type
     */
    public function register() {
        $opt = get_option( 'saasland_opt');
        $slug = !empty($opt['job_slug']) ? strtolower(str_replace( ' ', '', $opt['job_slug'])) : $this->slug;
        $labels = array(
            'name'                  => esc_html_x( 'Jobs', 'Post Type General Name', 'saasland-core' ),
            'singular_name'         => esc_html_x( 'Job', 'Post Type Singular Name', 'saasland-core' ),
            'add_new'               => esc_html__( 'Add New', 'saasland-core' ),
            'add_new_item'          => esc_html__( 'Add New ', 'saasland-core' )   . $this->singular_name,
            'edit_item'             => esc_html__( 'Edit ', 'saasland-core' ) . $this->singular_name,
            'new_item'              => esc_html__( 'New ', 'saasland-core' ) . $this->singular_name,
            'all_items'             => esc_html__( 'All ', 'saasland-core' )  . $this->name,
            'view_item'             => esc_html__( 'View ', 'saasland-core' ) . $this->singular_name,
            'view_items'            => esc_html__( 'View ', 'saasland-core' ) . $this->name,
            'search_items'          => esc_html__( 'Search ', 'saasland-core' ) . $this->name,
            'not_found'             => esc_html__( 'No ', 'saasland-core' ) . strtolower($this->name) . esc_html__( ' found', 'saasland-core'),
            'not_found_in_trash'    => esc_html__( 'No ', 'saasland-core' ) . strtolower($this->name) .  esc_html__( ' found in Trash', 'saasland-core'),
            'parent_item_colon'     => '',
            'menu_name'             => $this->name,
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => $slug ),
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => true,
            'menu_position'         => 8,
            'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
            'yarpp_support'         => true,
            'menu_icon'             => $this->icon
        );

        register_post_type( $this->type, $args );

        register_taxonomy($this->type.'_cat', $this->type, array(
            'public'                => true,
            'hierarchical'          => true,
            'show_admin_column'     => true,
            'show_in_nav_menus'     => false,
            'labels'                => array(
                'name'  => $this->singular_name.esc_html__( ' Categories', 'saasland-core'),
            )
        ));

        register_taxonomy($this->type.'_location', $this->type, array(
            'public'                => true,
            'hierarchical'          => true,
            'show_admin_column'     => true,
            'show_in_nav_menus'     => false,
            'labels'                => array(
                'name'  => $this->singular_name.esc_html__( ' Locations', 'saasland-core'),
            )
        ));

        register_taxonomy($this->type.'_type', $this->type, array(
            'public'                => true,
            'hierarchical'          => true,
            'show_admin_column'     => true,
            'show_in_nav_menus'     => false,
            'labels'                => array(
                'name'  => $this->singular_name.esc_html__( ' Type', 'saasland-core'),
            )
        ));
    }

    /**
     * @param $columns
     * @return mixed
     *
     * Choose the columns you want in
     * the admin table for this post
     */
    public function set_columns($columns) {
        // Set/unset post type table columns here

        return $columns;
    }

    /**
     * @param $column
     * @param $post_id
     *
     * Edit the contents of each column in
     * the admin table for this post
     */
    public function edit_columns($column, $post_id) {
        // Post type table column content code here
    }

    /**
     * Job constructor.
     *
     * When class is instantiated
     */
    public function __construct() {

        // Register the post type
        add_action( 'init', array($this, 'register'));

        // Admin set post columns
        add_filter( 'manage_edit-'.$this->type.'_columns',        array($this, 'set_columns'), 10, 1) ;

        // Admin edit post columns
        add_action( 'manage_'.$this->type.'_posts_custom_column', array($this, 'edit_columns'), 10, 2 );

    }

}

/**
 * Instantiate class, creating post type
 */
new Job();