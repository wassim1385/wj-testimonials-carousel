<?php

/**
 * Plugin Name: WJ Testimonials
 * Plugin URI: https://www.wordpress.org/wj-testimonials
 * Description: My plugin's description
 * Version: 1.0
 * Requires at least: 5.6
 * Author: Wassim JELLELI
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wj-testimonials
 * Domain Path: /languages
 */

 /*
WJ Testimonials is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
WJ Testimonials is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with WJ Testimonials. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if( ! defined( 'ABSPATH') ){
    exit;
}

if( ! class_exists( 'WJ_Testimonials' ) ){

    class WJ_Testimonials{

        function __construct(){

            $this->define_constants();

            require_once( WJ_TESTIMONIALS_PATH . 'post-types/class.wj-testimonials-cpt.php' );
            $WJ_Testimonials_Post_Type = new WJ_Testimonials_Post_Type();

            require_once( WJ_TESTIMONIALS_PATH . 'class.wj-testimonials-settings.php' );
            $WJ_Testimonials_Settings = new WJ_Testimonials_Settings();

            require_once( WJ_TESTIMONIALS_PATH . 'shortcode/class.wj-testimonials-shortcode.php' );
            $WJ_Testimonials_Shortcode = new WJ_Testimonials_Shortcode();

            require_once( WJ_TESTIMONIALS_PATH . 'functions/functions.php' );

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 999 );
        }

        public function define_constants(){

            define( 'WJ_TESTIMONIALS_PATH', plugin_dir_path( __FILE__ ) );
            define( 'WJ_TESTIMONIALS_URL', plugin_dir_url( __FILE__ ) );
            define( 'WJ_TESTIMONIALS_VERSION', '1.0.0' );
        }

        public function add_menu() {

            add_menu_page(
                esc_html__( 'WJ Testimonials Options', 'wj-testimonials' ),
                esc_html__( 'WJ Testimonials', 'wj-testimonials' ),
                'manage_options', 
                'wj_testimonials_admin',
                array( $this, 'wj_slider_settings_page' ),
                'dashicons-images-alt2'
            );

            add_submenu_page(
                'wj_testimonials_admin',
                esc_html__( 'Manage Slides', 'wj-testimonials' ),
                esc_html__( 'Manage Slides', 'wj-testimonials' ),
                'manage_options',
                'edit.php?post_type=wj-testimonials',
                null,
                null
            );

            add_submenu_page(
                'wj_testimonials_admin',
                esc_html__( 'Add New Slide', 'wj-testimonials' ),
                esc_html__( 'Add New Slide', 'wj-testimonials' ),
                'manage_options',
                'post-new.php?post_type=wj-testimonials',
                null,
                null
            );
        }

        public function wj_slider_settings_page() {

            if( ! current_user_can( 'manage_options' ) ) {

                return;
            }

            if( isset( $_GET['settings-updated'] ) ){
                add_settings_error( 'wj_testimonials_options', 'wj_testimonials_message', esc_html__( 'Settings Saved', 'wj-testimonials' ), 'success' );
            }
            
            settings_errors( 'wj_testimonials_options' );

            require( WJ_TESTIMONIALS_PATH . 'views/settings-page.php' );
        }

        public function enqueue_scripts() {

            wp_register_style( 'owl-style', WJ_TESTIMONIALS_URL . 'vendor/owl/assets/owl.carousel.min.css', array(), WJ_TESTIMONIALS_VERSION, 'all' );
            wp_enqueue_style( 'bootstrap-icons', WJ_TESTIMONIALS_URL . 'assets/bootstrap-icons/font/bootstrap-icons.min.css', array(), WJ_TESTIMONIALS_VERSION, 'all' );
            wp_register_script( 'owl-carousel', WJ_TESTIMONIALS_URL . 'vendor/owl/owl.carousel.min.js', array('jquery'), WJ_TESTIMONIALS_VERSION, true );
            wp_enqueue_style( 'main-style', WJ_TESTIMONIALS_URL . 'assets/style.css', array(), WJ_TESTIMONIALS_VERSION, 'all' );
        }

        public static function activate(){

            update_option( 'rewrite_rules', '' );
        }

        public static function deactivate(){

            flush_rewrite_rules();
        }

        public static function uninstall(){

        }
    }
}

if( class_exists( 'WJ_Testimonials' ) ){

    register_activation_hook( __FILE__, array( 'WJ_Testimonials', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'WJ_Testimonials', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'WJ_Testimonials', 'uninstall' ) );

    $wj_testimonials = new WJ_Testimonials();
} 