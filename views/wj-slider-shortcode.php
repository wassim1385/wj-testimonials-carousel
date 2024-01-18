<?php
$style = isset( WJ_Testimonials_Settings::$options['wj_testimonials_style'] ) ? WJ_Testimonials_Settings::$options['wj_testimonials_style'] : 'default-style';
?>
<div class="testimonials-section <?php echo $style; ?>">
    <h5>
        <?php echo ( ! empty ( $content ) ) ? esc_html( $content ) : esc_html( WJ_Testimonials_Settings::$options['wj_testimonials_title'] ); ?>
    </h5>
    <div class="owl-carousel testimonial-carousel">
        <?php 
        
        $args = array(
            'post_type' => 'wj-testimonials',
            'post_status'   => 'publish',
            'post__in'  => $id,
            'orderby' => $orderby
        );

        $my_query = new WP_Query( $args );
        if( $my_query->have_posts() ) :
            while( $my_query->have_posts() ) : $my_query->the_post();
        ?>
            <div class="testimonial-item">
                <?php
                if( isset( WJ_Testimonials_Settings::$options['wj_testimonials_thumbnail'] ) ) {

                    if( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid' ) );
                    } else {
                        ?>
                            <img src="<?php echo WJ_TESTIMONIALS_URL . 'assets/images/no-img-testimonial.jpg' ?>">
                        <?php }
                }
                the_content() ?>
                <div class="hr-testimonials"></div>
                <h6><?php the_title() ?></h6>
                <p><b><?php the_field( 'profession' ); ?></b></p>
            </div>

        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
</div>