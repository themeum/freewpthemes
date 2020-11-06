<?php
/*
 * Template Name: Coming Soon
 */
get_header('alternative'); 
    $comingsoon_date = '';
    if ( get_theme_mod('comingsoon_date') ) {
        $comingsoon_date = esc_attr( get_theme_mod('comingsoon_date', '2019-08-09') );
    }

?>

<div class="comingsoon-warper">
    <div class="container">
        <div class="comingsoon comingsoon-content">
            <div class="row h-100 align-items-center">
                <div class="col-12 my-auto">
                    <?php
                    $logoimg   = get_theme_mod( 'logo-404', get_template_directory_uri().'/images/logo-404.png' );
                    if( !empty($logoimg) ) { ?>
                        <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'rhino' ); ?>" title="<?php  esc_html_e( 'Logo', 'rhino' ); ?>">
                    <?php } ?>
                    <div class="comingsoon-inner">
                        <?php $countdate = str_replace('-', '/', $comingsoon_date); ?>
                        <h2 class="comingsoon-title"><?php  echo esc_html(get_theme_mod( 'comingsoontitle', esc_html__('Coming Soon', 'rhino') )); ?></h2>
                        <div class="counter-class" data-date="'<?php echo esc_attr($countdate);?>">
                            <div id="comingsoon-countdown">
                                <div class="countdown-section"><span class="countdown-amount first-item countdown-days counter-days"></span> <span class="countdown-period"><?php esc_html_e('Days', 'rhino') ?></span></div>
                                <div class="countdown-section"><span class="countdown-amount countdown-hours counter-hours"></span> <span class="countdown-period"><?php esc_html_e('Hours', 'rhino') ?></span></div>
                                <div class="countdown-section"><span class="countdown-amount countdown-minutes counter-minutes"></span> <span class="countdown-period"><?php esc_html_e('Minutes', 'rhino') ?></span></div>
                                <div class="countdown-section"><span class="countdown-amount countdown-seconds counter-seconds"></span> <span class="countdown-period"><?php esc_html_e('Seconds', 'rhino') ?></span></div>
                            </div>
                        </div>
                        <div class="comingsoon-newslatter-descrip">
                            <?php  echo get_theme_mod( 'coming_description', esc_html__('We are come back soon', 'rhino') ); ?>
                        </div>
                    </div>
                    
                    <!-- News Latter -->
                    <?php if( get_theme_mod('newsletter')): ?>
                        <div class="coming-soon-newslatter">
                            <?php echo do_shortcode(get_theme_mod( 'newsletter' )); ?>
                        </div>
                    <?php endif; ?>

                    <div class="comingsoon-footer">
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
                        <?php if (get_theme_mod( 'comingsoon_copyright', '2018 Rhino All rights reserved')) { ?>
                            <p class="footer-copyright"><?php echo esc_html__(get_theme_mod( 'comingsoon_copyright', '2018 Rhino All rights reserved')); ?></p>
                        <?php  } ?>
                    </div><!--/.comingsoon-footer-->
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('alternative');