<?php

if( ! class_exists( 'WJ_Testimonials_Settings' ) ) {

    class WJ_Testimonials_Settings {

        public static $options;

        public function __construct() {

            self::$options = get_option( 'wj_testimonials_options' );
            add_action( 'admin_init', array( $this, 'admin_init' ) );
        }

        public function admin_init() {

            register_setting( 'wj_testimonials_group', 'wj_testimonials_options', array( $this, 'wj_testimonials_validate' ) );

            add_settings_section(
                'wj_testimonials_main_section',
                esc_html__( 'How does it work?', 'wj-testimonials' ),
                null,
                'wj_testimonials_page1'
            );

            add_settings_field(
                'wj_testimonials_shortcode',
                esc_html__( 'Shortcode', 'wj-testimonials' ),
                array( $this, 'wj_testimonials_shortcode_callback' ),
                'wj_testimonials_page1',
                'wj_testimonials_main_section'
            );

            add_settings_section(
                'wj_testimonials_second_section',
                esc_html__( 'Other plugin Options', 'wj-testimonials' ),
                null,
                'wj_testimonials_page2'
            );

            add_settings_field(
                'wj_testimonials_title',
                esc_html__( 'Testimonials Title', 'wj-testimonials' ),
                array( $this, 'wj_testimonials_title_callback' ),
                'wj_testimonials_page2',
                'wj_testimonials_second_section'
            );

            add_settings_field(
                'wj_testimonials_thumbnail',
                esc_html__( 'Testimonials Thumbnail', 'wj-testimonials' ),
                array( $this, 'wj_testimonials_thumbnail_callback' ),
                'wj_testimonials_page2',
                'wj_testimonials_second_section'
            );

            add_settings_field(
                'wj_testimonials_play',
                esc_html__( 'Testimonials Auto Play', 'wj-testimonials' ),
                array( $this, 'wj_testimonials_autoplay_callback' ),
                'wj_testimonials_page2',
                'wj_testimonials_second_section'
            );

            add_settings_field(
                'wj_testimonials_items',
                esc_html__( 'Testimonials Items', 'wj-testimonials' ),
                array( $this, 'wj_testimonials_items_callback' ),
                'wj_testimonials_page2',
                'wj_testimonials_second_section'
            );

            add_settings_field(
                'wj_testimonials_nav',
                esc_html__( 'Testimonials Navigation', 'wj-testimonials' ),
                array( $this, 'wj_testimonials_nav_callback' ),
                'wj_testimonials_page2',
                'wj_testimonials_second_section'
            );

            add_settings_field(
                'wj_testimonials_style',
                esc_html__( 'Testimonials Style', 'wj-testimonials' ),
                array( $this, 'wj_testimonials_style_callback' ),
                'wj_testimonials_page2',
                'wj_testimonials_second_section'
            );
        }

        public function wj_testimonials_shortcode_callback() {
            ?>
            <span><?php esc_html_e( 'Use the shortcode [wj_testimonials] to display the slider in any page/post/widget', 'wj-testimonials' ) ?></span>
            <?php
        }

        public function wj_testimonials_title_callback() {
            ?>
            <input
            type="text"
            name="wj_testimonials_options[wj_testimonials_title]"
            id="wj_testimonials_title"
            value="<?php echo isset( self::$options['wj_testimonials_title'] ) ? esc_attr( self::$options['wj_testimonials_title'] ) : ''; ?>"
            >
            <?php
        }

        public function wj_testimonials_thumbnail_callback() {
            ?>
            <input 
                type="checkbox"
                name="wj_testimonials_options[wj_testimonials_thumbnail]"
                id="wj_testimonials_thumbnail"
                value="1"
                <?php 
                    if( isset( self::$options['wj_testimonials_thumbnail'] ) ){
                        checked( "1", self::$options['wj_testimonials_thumbnail'], true );
                    }    
                ?>
            />
            <label for="wj_testimonials_thumbnail"><?php esc_html_e( 'Whether to display image or not', 'wj-testimonials' ) ?></label>
            <?php
        }

        public function  wj_testimonials_autoplay_callback() {
            ?>
                <input 
                type="checkbox"
                name="wj_testimonials_options[wj_testimonials_play]"
                id="wj_testimonials_play"
                value="1"
                <?php 
                    if( isset( self::$options['wj_testimonials_play'] ) ){
                        checked( "1", self::$options['wj_testimonials_play'], true );
                    }    
                ?>
            />
            <label for="wj_testimonials_play"><?php esc_html_e( 'Whether to activate autoplay or not', 'wj-testimonials' ) ?></label>
            <?php
        }

        public function  wj_testimonials_items_callback() {
            ?>
                <input 
                type="number"
                name="wj_testimonials_options[wj_testimonials_items]"
                id="wj_testimonials_items"
                min="1"
                value="<?php echo isset( self::$options['wj_testimonials_items'] ) ? self::$options['wj_testimonials_items'] : '1'; ?>"
            />
            <?php
        }

        public function  wj_testimonials_nav_callback() {
            ?>
                <input 
                type="checkbox"
                name="wj_testimonials_options[wj_testimonials_nav]"
                id="wj_testimonials_nav"
                value="1"
                <?php 
                    if( isset( self::$options['wj_testimonials_nav'] ) ){
                        checked( "1", self::$options['wj_testimonials_nav'], true );
                    }    
                ?>
            />
            <label for="wj_testimonials_nav"><?php esc_html_e( 'Whether to show navigation arrows or not', 'wj-testimonials' ) ?></label>
            <?php
        }

        public function wj_testimonials_style_callback() {
            ?>
            <select 
                id="wj_testimonials_style" 
                name="wj_testimonials_options[wj_testimonials_style]">
                <option value="style-1"
                    <?php isset( self::$options['wj_testimonials_style'] ) ? selected( 'style-1', self::$options['wj_testimonials_style'], true ) :'' ?>>
                        Style-1</option>
                <option value="style-2"
                <?php isset( self::$options['wj_testimonials_style'] ) ? selected( 'style-2', self::$options['wj_testimonials_style'], true ) :'' ?>>
                    Style-2</option>
            </select>
            <?php
        }

        public function wj_testimonials_validate( $input ) {

            $new_input = array();
            foreach( $input as $key => $value ){
                switch ($key){
                    case 'wj_testimonials_title':
                        if( empty( $value )){
                            add_settings_error( 'wj_testimonials_options', 'wj_testimonials_message', esc_html__( 'The title can not be left empty!', 'wj-testimonials' ), 'error' );
                            $value = esc_html__( 'Please, choose a title', 'wj-testimonials' );
                        }
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                    default:
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                }
            }
            return $new_input;

        }
    }
}