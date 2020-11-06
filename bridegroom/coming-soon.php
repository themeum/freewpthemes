<?php
/*
* Template Name: Coming Soon
*/
get_header('alternative');

$comingsoon_date = '';

if ( get_theme_mod('comingsoon_date') ) {
    $comingsoon_date = esc_attr( get_theme_mod('comingsoon_date', '2019-08-09') );
} ?>

<div class="comingsoon-wrap" style="background-image: url(<?php echo esc_url( get_theme_mod('comingsoonbg', get_parent_theme_file_uri().'/images/coming-soon.jpg')); ?>)">
    <div class="comingsoon">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="comingsoon-bg">
                        <div class="comingsoon-section">
                            <h3 class="comingsoon-title">
                                <?php echo esc_html(get_theme_mod( 'comingsoontitle', esc_html__('The Wedding Of', 'bridegroom') )); ?>     
                            </h3>

                            <h2 class="bridegroom-name">
                                <?php echo esc_html(get_theme_mod( 'bridegroom_name', esc_html__('James & Amelia', 'bridegroom') )); ?>     
                            </h2>

                            <span class="comingsoon-descrip">
                                <?php echo get_theme_mod( 'coming_description', esc_html__('Coming Soon', 'bridegroom') ); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="content-wrap">

                        <?php if( get_theme_mod('date_en')){ ?>
                            <!-- Wedding Countdown -->
                            <?php $countdate = str_replace('-', '/', $comingsoon_date); ?>
                            <div class="counter-class" data-date="<?php echo esc_attr($countdate);?>">
                                <div id="comingsoon-countdown">
                                    <div class="countdown-section"><span class="countdown-amount first-item countdown-days counter-days"></span> <span class="countdown-period"><?php esc_html_e('Days', 'bridegroom') ?></span></div>
                                    <div class="countdown-section"><span class="countdown-amount countdown-hours counter-hours"></span> <span class="countdown-period"><?php esc_html_e('Hours', 'bridegroom') ?></span></div>
                                    <div class="countdown-section"><span class="countdown-amount countdown-minutes counter-minutes"></span> <span class="countdown-period"><?php esc_html_e('Min', 'bridegroom') ?></span></div>
                                    <div class="countdown-section"><span class="countdown-amount countdown-seconds counter-seconds"></span> <span class="countdown-period"><?php esc_html_e('Secs', 'bridegroom') ?></span></div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- News Latter -->
                        <?php if( get_theme_mod('coming_newslatter')): ?>
                            <div class="coming-soon-newslatter">
                                <?php echo do_shortcode(get_theme_mod( 'coming_newslatter' )); ?>
                            </div>
                        <?php endif; ?>
                        <!-- End Newslatter -->

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
                        </div>
                        <!--/.social-share-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('alternative');