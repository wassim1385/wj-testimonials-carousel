<div class="wrap">
    <h1><?php esc_html_e( get_admin_page_title(), 'wj-testimonials' ); ?></h1>
    <?php 
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
    <a href="?page=wj_testimonials_admin&tab=main_options" class="nav-tab <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : ''; ?>">Main Options</a>
    <a href="?page=wj_testimonials_admin&tab=additional_options" class="nav-tab <?php echo $active_tab == 'additional_options' ? 'nav-tab-active' : ''; ?>">Additional Options</a>
    </h2>
    <form action="options.php" method="post">
        <?php
        if( $active_tab == 'main_options' ) {

            settings_fields( 'wj_testimonials_group' );
            do_settings_sections( 'wj_testimonials_page1' );
        } else {

            settings_fields( 'wj_testimonials_group' );
            do_settings_sections( 'wj_testimonials_page2' );
        }
        
        submit_button( esc_html__( 'Save Settings', 'wj-testimonials' ) );
        ?>
    </form>
</div>