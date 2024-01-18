<?php

if( ! class_exists( 'WJ_Testimonials_Shortcode' ) ) {

    class WJ_Testimonials_Shortcode{

        public function __construct() {

            add_shortcode( 'wj_testimonials', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag= '' ) {

            $atts = array_change_key_case( (array) $atts, CASE_LOWER );

            extract( shortcode_atts(
                array(
                    'id' => '',
                    'orderby' => 'rand'
                ),
                $atts,
                $tag
            ));

            if( ! empty( $id ) ){
                $id = array_map( 'absint', explode( ',', $id ) );
            }

            ob_start();
            require( WJ_TESTIMONIALS_PATH . 'views/wj-slider-shortcode.php' );
            wp_enqueue_style( 'owl-style' );
            wp_enqueue_script( 'owl-carousel' );
            wj_testimonials_options();
            return ob_get_clean();
        }
    }
}