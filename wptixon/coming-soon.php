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

<div class="container comingsoon">
    <div class="comingsoon-content">
    <div class="row">
    
        <div class="col-sm-4">
            <img class="img-responsive" src="<?php echo esc_url( get_theme_mod('comingsoonbg',get_template_directory_uri().'/images/coming-soon.png')); ?>" alt="">
        </div>

        <div class="col-sm-8" id="tixon-comingsoon">

            <?php $countdate = str_replace('-', '/', $comingsoon_date); ?>
                <?php if( get_theme_mod('comingsoon-logo','url')): ?>
                    <div class="coming-soon-logo">
                        <img src="<?php echo esc_url( get_theme_mod('comingsoonlogo',get_template_directory_uri().'/images/logo.png')); ?>" alt="">
                    </div>
                <?php endif; ?>

                <h2 class="comingsoon-title"><?php  echo esc_html(get_theme_mod( 'comingsoontitle', esc_html__('Coming Soon.', 'wptixon') )); ?></h2>
              
                <!-- News Latter -->
                <?php if( get_theme_mod('newsletter')): ?>
                    <div class="coming-soon-newslatter">
                        <?php echo do_shortcode(get_theme_mod( 'newsletter' )); ?>
                    </div>
                <?php endif; ?>
                <!-- end newslatter -->

                                <div class="text-left comingsoon-footer">
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

                <div class="counter-class" data-date="'<?php echo esc_attr($countdate);?>">
                    <div id="comingsoon-countdown">
                        <div class="countdown-section"><span class="countdown-amount first-item countdown-days counter-days"></span> <span class="countdown-period"><?php esc_html_e('Days', 'wptixon') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-hours counter-hours"></span> <span class="countdown-period"><?php esc_html_e('Hours', 'wptixon') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-minutes counter-minutes"></span> <span class="countdown-period"><?php esc_html_e('Minutes', 'wptixon') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-seconds counter-seconds"></span> <span class="countdown-period"><?php esc_html_e('Seconds', 'wptixon') ?></span></div>
                    </div>
                </div>

                <?php if ( get_theme_mod( 'copyright_en', true ) || get_theme_mod( 'footer_share', true ) || get_theme_mod( 'footer_logo', true ) ) { ?>
                    <div class="comingsoon-footer-copyright">  
                        <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                            <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '© 2017 Tixon. All Rights Reserved.') )); ?>
                        <?php } ?>
                    </div> <!-- end row -->
                <?php } ?>
        </div>
</div>
    </div>
</div>


<?php get_footer('alternative');
