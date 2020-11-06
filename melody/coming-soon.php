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

    $coming_soon_bg_color = get_theme_mod( 'coming_soon_bg_color', '#ef3f48' );
    $coming_soon_bg_img = get_theme_mod( 'comingsoon_bg_img', get_parent_theme_file_uri( 'images/coming-soon-bg.jpg' ) );

    if ( get_theme_mod('coming_soon_title_color', '#000') ) {
        $title_color = 'color: '.get_theme_mod('coming_soon_title_color', '#fff').';';
    }

?>

<?php if($coming_soon_bg_img){ ?>
<div class="comingsoon"  style="background-image: url(<?php echo $coming_soon_bg_img; ?>)">
<?php } ?>
        <div class="comingsoon-wrap text-center">
            <div class="comingsoon-content container">

                <?php $countdate = str_replace('-', '/', $comingsoon_date); ?>

                <div class="counter-class" data-date="'<?php echo esc_attr($countdate);?>">
                    <div id="comingsoon-countdown">
                        <div class="countdown-section"><span class="countdown-amount first-item countdown-days counter-days"></span> <span class="countdown-period"><?php echo esc_attr__('Days', 'melody') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-hours counter-hours"></span> <span class="countdown-period"><?php echo esc_attr__('Hours', 'melody') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-minutes counter-minutes"></span> <span class="countdown-period"><?php echo esc_attr__('Minutes', 'melody') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-seconds counter-seconds"></span> <span class="countdown-period"><?php echo esc_attr__('Seconds', 'melody') ?></span></div>
                    </div>
                </div>

                <div class="row justify-content-center coming-soon-content">
                    <div class="col-sm-12">
                        <h2 style="<?php print $title_color; ?>"><?php echo get_theme_mod( 'comingsoon_title', 'We are coming Soon' ); ?></h2>
                    </div>
                </div>
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