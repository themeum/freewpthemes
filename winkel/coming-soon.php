<?php
/*
 * Template Name: Coming Soon
 */
get_header('alternative'); ?>

    <?php
    $comingsoon_date = '';
    if ( get_theme_mod('comingsoon_date') ) {
        $comingsoon_date = esc_attr( get_theme_mod('comingsoon_date', '2020-08-09') );
    }
?>

<div class="container">
    <div class="comingsoon comingsoon-content">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 equal-height-1" id="tixon-comingsoon">
                <div class="comingsoon-warper">
                    <?php $countdate = str_replace('-', '/', $comingsoon_date); ?>
                    <div class="counter-class" data-date="'<?php echo esc_attr($countdate);?>">
                        <div id="comingsoon-countdown">
                            <div class="countdown-section">
                                <span class="countdown-amount first-item countdown-days counter-days"></span>
                                <span class="countdown-period"><?php esc_html_e('Days', 'winkel') ?></span>
                            </div>
                            <div class="countdown-bottom">
                                <div class="countdown-section">
                                    <span class="countdown-amount countdown-hours counter-hours"></span>
                                    <span class="countdown-period"><?php esc_html_e('H', 'winkel') ?></span>
                                </div>
                                <div class="countdown-section">
                                    <span class="countdown-amount countdown-minutes counter-minutes"></span> 
                                    <span class="countdown-period"><?php esc_html_e('M', 'winkel') ?></span>
                                </div>
                                <div class="countdown-section">
                                    <span class="countdown-amount countdown-seconds counter-seconds"></span> 
                                    <span class="countdown-period"><?php esc_html_e('S', 'winkel') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 equal-height-1 comingsoon-right-content">
               <div class="inner">
                    <div class="coming-soon-logo">
                        <?php
                            $logoimg   = get_theme_mod( 'comming_soon_logo', get_template_directory_uri().'/images/logo-404.png' );

                            if( !empty($logoimg) ) { ?>
                                <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'winkel' ); ?>" title="<?php  esc_html_e( 'Logo', 'winkel' ); ?>">

                            <?php } 
                        ?>
                    </div>
                    <p><?php  echo esc_html(get_theme_mod( 'comingsoontitle', esc_html__('We are working in our new website, stay tuned!', 'winkel') )); ?></p>
                    <p><a href="#" class="btn mc-open round-btn"><?php  echo esc_html(get_theme_mod( 'subscribe_btn', esc_html__('Subscribe Now', 'winkel') )); ?></a></p>

                    <?php if( get_theme_mod('newsletter')): ?>
                        <!-- start mailchimp-popup -->
                        <div class="thm-mailchimp-popup">
                            <div class="thm-mailchimp-inner">
                               <a href="#" class="mc-close winkel winkel-multiply"></a>
                                <?php echo do_shortcode(get_theme_mod( 'newsletter' )); ?>
                            </div>
                        </div> <!-- end mailchimp-popup -->
                    <?php endif; ?>

               </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('alternative');
