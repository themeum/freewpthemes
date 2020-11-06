<?php
/*
 * Template Name: Coming Soon
 */
get_header('alternative'); ?>

<?php
    $comingsoon_date = '';
    if ( get_theme_mod('comingsoon_date') ) {
        $comingsoon_date = esc_attr( get_theme_mod('comingsoon_date', '2018-08-09') );
    }
?>

    <div class="comingsoon" style="background-image: url(<?php echo esc_url( get_theme_mod('comingsoonbg','bg')); ?>);">
    
        <div class="comingsoon-wrap text-center">
            <div class="comingsoon-content">
            <?php $countdate = str_replace('-', '/', $comingsoon_date); ?>
                <!-- Coming Soon Logo -->
                <?php if( get_theme_mod('comingsoon-logo','url')): ?>
                    <div class="coming-soon-logo">
                        <img src="<?php echo esc_url( get_theme_mod('comingsoonlogo',get_template_directory_uri().'/images/logo.png')); ?>" alt="">
                    </div>
                <?php endif; ?>
                <!-- end -->

                <div class="counter-class" data-date="'<?php echo esc_attr($countdate);?>">
                    <div id="comingsoon-countdown">
                        <div class="countdown-section"><span class="countdown-amount first-item countdown-days counter-days"></span> <span class="countdown-period"><?php esc_html_e('Days', 'starterpro') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-hours counter-hours"></span> <span class="countdown-period"><?php esc_html_e('Hours', 'starterpro') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-minutes counter-minutes"></span> <span class="countdown-period"><?php esc_html_e('Minutes', 'starterpro') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-seconds counter-seconds"></span> <span class="countdown-period"><?php esc_html_e('Seconds', 'starterpro') ?></span></div>
                    </div>
                </div>

                <!-- News Latter -->
                <?php if( get_theme_mod('newsletter')): ?>
                    <div class="coming-soon-newslatter">
                        <?php echo do_shortcode(get_theme_mod( 'newsletter' )); ?>
                    </div>
                <?php endif; ?>
                <!-- end newslatter -->

                <div class="text-center comingsoon-footer">
                    <div class="social-share">
                        <ul>
                            <?php if ( get_theme_mod( 'comingsoon_facebook' ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'comingsoon_facebook' )); ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'comingsoon_twitter' ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'comingsoon_twitter' ) ); ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'comingsoon_google_plus' ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'comingsoon_google_plus' ) ); ?>"><i class="fa fa-google-plus"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'comingsoon_pinterest' ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'comingsoon_pinterest' ) ); ?>"><i class="fa fa-pinterest"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'comingsoon_youtube' ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'comingsoon_youtube' ) ); ?>"><i class="fa fa-youtube"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'comingsoon_linkedin' ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'comingsoon_linkedin') ); ?>"><i class="fa fa-linkedin"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'comingsoon_dribbble' ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'comingsoon_dribbble' ) ); ?>"><i class="fa fa-dribbble"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'comingsoon_instagram' ) ) { ?>  
                            <li><a target="_blank" href="<?php echo esc_url( get_theme_mod( 'comingsoon_instagram' ) ); ?>"><i class="fa fa-instagram"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div> <!--/.social-share-->
                </div><!--/.comingsoon-footer-->
            </div><!--/.comingsoon-content-->
        </div><!--/.comingsoon-wrap-->
</div><!--/.comingsoon-->


<?php get_footer('alternative');
