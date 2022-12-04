<?php

// register post type
function kidba_custom_post_type() {
 
	$kidba_service_slug = get_theme_mod('kidba_service_slug',__('ourservice', 'kidba'));

	return array (
		'kidba-services' => array('title' => 'Services', 'plural_title' => 'Services', 'rewrite' => $kidba_service_slug,'menu_icon' => 'dashicons-admin-generic'), 
	);
}
add_filter('custom_kidba_post_types', 'kidba_custom_post_type');
function kidba_custom_post_taxonomies() {
	return array (
		'class-categories' => array(
			'title' => __('Services Category', 'tp-toolkit'), 
			'plural_title' =>__('Services Categories', 'tp-toolkit'), 
			'rewrite' => __('services-cat', 'tp-toolkit'), 
			'post_type' => __('kidba-services', 'tp-toolkit')
		),
	);
}
add_filter('custom_kidba_post_taxonomies', 'kidba_custom_post_taxonomies');

function _get_custom_template( $template ) {
	if ( $theme_file = locate_template( array( $template ) ) ) {
		$file = $theme_file;
	} 
	else {
		$file = TP_TOOLKIT_DIR . 'inc/templates/'. $template;
	}
	return $file;
}
// all template includes
function _kidba_custom_template_include($template ) {
	$post_types = kidba_custom_post_type();
	foreach ( $post_types as $post_type => $fields ) {
		if ( is_singular( $post_type ) ) {
			return _get_custom_template( 'single-'. $post_type .'.php');
		}
	}
	return $template;
}
add_filter( 'template_include',  '_kidba_custom_template_include' );

if(!class_exists('kidba_custom_post')) {
    class kidba_custom_post {
        protected static $instance = null;
		private $post_types = array();
		private $taxonomies = array();
        public function __construct() {
            add_action('init', array($this, 'kidba_post_type_initialize'));
        }

        public function add_post_types( $post_types ) {
			foreach ( $post_types as $post_type => $args ) {
				$title = $args['title'];
				$plural_title = empty( $args['plural_title'] ) ? $title : $args['plural_title'];
				if ( ! empty( $args['rewrite'] ) ) {
					$args['rewrite'] = array( 'slug' => $args['rewrite'] );
				}

				$labels      = array(
					'name'                     => $plural_title,
					'singular_name'            => $title,
					'add_new'                  => esc_html__( 'Add New', 'tp-toolkit' ),
					'add_new_item'             => sprintf( esc_html__( 'Add New %s', 'tp-toolkit' ), $title ),
					'edit_item'                => sprintf( esc_html__( 'Edit %s', 'tp-toolkit' ), $title ),
					'new_item'                 => sprintf( esc_html__( 'New %s', 'tp-toolkit' ), $title ),
					'view_item'                => sprintf( esc_html__( 'View %s', 'tp-toolkit' ), $title ),
					'view_items'               => sprintf( esc_html__( 'View %s', 'tp-toolkit' ), $plural_title ),
					'search_items'             => sprintf( esc_html__( 'Search %s', 'tp-toolkit' ), $plural_title ),
					'not_found'                => sprintf( esc_html__( '%s not found', 'tp-toolkit' ), $plural_title ),
					'not_found_in_trash'       => sprintf( esc_html__( '%s found in Trash', 'tp-toolkit' ), $plural_title ),
					'parent_item_colon'        => '',
					'all_items'                => sprintf( esc_html__( 'All %s', 'tp-toolkit' ), $plural_title ),
					'archives'                 => sprintf( esc_html__( '%s Archives', 'tp-toolkit' ), $title ),
					'attributes'               => sprintf( esc_html__( '%s Attributes', 'tp-toolkit' ), $title ),
					'insert_into_item'         => sprintf( esc_html__( 'Insert into %s', 'tp-toolkit' ), $title ),
					'uploaded_to_this_item'    => sprintf( esc_html__( 'Uploaded to this %s', 'tp-toolkit' ), $title ),
					'filter_items_list'        => sprintf( esc_html__( 'Filter %s list', 'tp-toolkit' ), $plural_title ),
					'items_list_navigation'    => sprintf( esc_html__( '%s list navigation', 'tp-toolkit' ), $plural_title ),
					'items_list'               => sprintf( esc_html__( '%s list', 'tp-toolkit' ), $plural_title ),
					'item_published'           => sprintf( esc_html__( '%s published.', 'tp-toolkit' ), $title ),
					'item_published_privately' => sprintf( esc_html__( '%s published privately.', 'tp-toolkit' ), $title ),
					'item_reverted_to_draft'   => sprintf( esc_html__( '%s reverted to draft.', 'tp-toolkit' ), $title ),
					'item_scheduled'           => sprintf( esc_html__( '%s scheduled.', 'tp-toolkit' ), $title ),
					'item_updated'             => sprintf( esc_html__( '%s  updated.', 'tp-toolkit' ), $title ),
					'menu_name'                => $plural_title
				);

				if ( !empty( $args['labels_override'] ) ) {
					$labels = wp_parse_args( $args['labels_override'], $labels );
				}

				$defaults = array(
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'show_in_nav_menus'  => true,
					'query_var'          => true,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => null,
					'menu_icon'          => null,
					'supports'           => array( 'title', 'thumbnail', 'editor','excerpt' )
				);

				$args = wp_parse_args( $args, $defaults );
				$this->post_types[ $post_type ] = $args;
				register_post_type( $post_type, $args );
			}
		}
		public function add_taxonomies($taxonomies) {
			foreach ($taxonomies as $taxonomy => $args ) {
				$title = $args['title'];
				$plural_title = !empty( $args['plural_title'] ) ? $args['plural_title'] : $title;

				$labels     = array(
					'name'                       => $title,
					'singular_name'              => $title,
					'search_items'               => sprintf( esc_html__( 'Search %s', 'tp-toolkit' ), $plural_title ),
					'popular_items'              => sprintf( esc_html__( 'Popular %s', 'tp-toolkit' ), $plural_title ),
					'all_items'                  => sprintf( esc_html__( 'All %s', 'tp-toolkit' ), $plural_title ),
					'parent_item'                => sprintf( esc_html__( 'Parent %s', 'tp-toolkit' ), $title ),
					'parent_item_colon'          => sprintf( esc_html__( 'Parent %s:', 'tp-toolkit' ), $title ),
					'edit_item'                  => sprintf( esc_html__( 'Edit %s', 'tp-toolkit' ), $title ),
					'view_item'                  => sprintf( esc_html__( 'View %s', 'tp-toolkit' ), $title ),
					'update_item'                => sprintf( esc_html__( 'Update %s', 'tp-toolkit' ), $title ),
					'add_new_item'               => sprintf( esc_html__( 'Add New %s', 'tp-toolkit' ), $title ),
					'new_item_name'              => sprintf( esc_html__( 'New %s Name', 'tp-toolkit' ), $title ),
					'separate_items_with_commas' => sprintf( esc_html__( 'Separate %s with commas', 'tp-toolkit' ), $plural_title ),
					'add_or_remove_items'        => sprintf( esc_html__( 'Add or remove %s', 'tp-toolkit' ), $plural_title ),
					'choose_from_most_used'      => sprintf( esc_html__( 'Choose from the most used %s', 'tp-toolkit' ), $plural_title ),
					'not_found'                  => sprintf( esc_html__( 'No %s found.', 'tp-toolkit' ), $plural_title ),
					'no_terms'                   => sprintf( esc_html__( 'No %s', 'tp-toolkit' ), $plural_title ),
					'items_list_navigation'      => sprintf( esc_html__( '%s list navigation', 'tp-toolkit' ), $plural_title ),
					'items_list'                 => sprintf( esc_html__( '%s list', 'tp-toolkit' ), $plural_title ),
					'back_to_items'              => sprintf( esc_html__( '&larr; Back to %s', 'tp-toolkit' ), $plural_title ),
					'menu_name'                  => $plural_title,
				);

				if ( !empty( $args['labels_override'] ) ) {
					$labels = wp_parse_args( $args['labels_override'], $labels );
				}

				$defaults = array(
					'hierarchical'      => true,
					'labels'            => $labels,
					'show_in_nav_menus' => true,
					'show_ui'           => null,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => $taxonomy )
				);

				$args = wp_parse_args( $args, $defaults );
				$this->taxonomies[ $taxonomy ] = $args;
				register_taxonomy( $taxonomy, $args['post_type'], $args );
			}
		}
        public function kidba_post_type_initialize() {
            $this->kidba_register_custom_post_types();
            $this->kidba_register_custom_taxonomies();
        }
        public function kidba_register_custom_post_types() {
            $post_types = apply_filters( 'custom_kidba_post_types', $this->post_types );
			$this->add_post_types($post_types);
        }
        public function kidba_register_custom_taxonomies() {
            $taxonomies = apply_filters( 'custom_kidba_post_taxonomies', $this->taxonomies );
			$this->add_taxonomies( $taxonomies );
        }
    }
}
$post_type_initialize = new kidba_custom_post();