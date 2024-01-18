<?php 

if( !class_exists( 'WJ_Testimonials_Post_Type') ){

    class WJ_Testimonials_Post_Type{

        function __construct(){

            add_action( 'init', array( $this, 'create_post_type' ) );
        }

        public function create_post_type(){

            register_post_type(
                'wj-testimonials',
                array(
                    'label' => esc_html__( 'Testimonial', 'wj-testimonials' ),
                    'description'   => esc_html__( 'Testimonials', 'wj-testimonials' ),
                    'labels' => array(
                        'name'  => esc_html__( 'Testimonials', 'wj-testimonials' ),
                        'singular_name' => esc_html__( 'Testimonial', 'wj-testimonials' )
                    ),
                    'public'    => true,
                    'supports'  => array( 'title', 'editor', 'thumbnail' ),
                    'hierarchical'  => false,
                    'show_ui'   => true,
                    'show_in_menu'  => false,
                    'rewrite' => [ 'slug' => 'testimonials' ],
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export'    => true,
                    'has_archive'   => false,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'show_in_rest'  => true,
                    'menu_icon' => 'dashicons-testimonial'
                )
            );
        }

    }
}
