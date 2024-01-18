<?php

if( ! function_exists( 'wj_testimonials_options' ) ) {
    function wj_testimonials_options() {

        $auto_play = isset( WJ_Testimonials_Settings::$options['wj_testimonials_play'] ) && WJ_Testimonials_Settings::$options['wj_testimonials_play'] == '1' ? true : false;

        $items = isset( WJ_Testimonials_Settings::$options['wj_testimonials_items'] ) ? WJ_Testimonials_Settings::$options['wj_testimonials_items'] : '1';

        $show_nav = isset( WJ_Testimonials_Settings::$options['wj_testimonials_nav'] ) && WJ_Testimonials_Settings::$options['wj_testimonials_nav'] == '1' ? true : false;

        wp_enqueue_script( 'owl-main', WJ_TESTIMONIALS_URL . 'vendor/owl/owl-main.js', array('jquery'), WJ_TESTIMONIALS_VERSION, true );

        wp_localize_script( 'owl-main', 'TESTIMONIALS_OPTIONS', array( 'autoplay' => $auto_play, 'items' => $items, 'nav' => $show_nav ) );

    }
}