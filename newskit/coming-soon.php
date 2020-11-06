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
    $coming_soon_bg_img = get_theme_mod( 'coming_soon_bg_img', get_parent_theme_file_uri( 'images/coming-soon-bg.jpg' ) );

    if ( get_theme_mod('coming_soon_title_color', '#000') ) {
        $title_color = 'color: '.get_theme_mod('coming_soon_title_color', '#000').';';
    }

?>

<?php if($coming_soon_bg_img){ ?>
<div class="comingsoon"  style="background-image: url(<?php echo $coming_soon_bg_img; ?>)">
<?php } ?>
        <div class="comingsoon-wrap text-center">
            <div class="comingsoon-content">

                <?php $countdate = str_replace('-', '/', $comingsoon_date); ?>

                <!-- Coming Soon Logo -->
                <?php if( get_theme_mod('comingsoon-logo','url')): ?>
                <div class="coming-soon-logo">
                    <img src="<?php echo esc_url( get_theme_mod('comingsoon_logo', get_parent_theme_file_uri( 'images/coming-soon-logo.png' ))); ?>" alt="<?php  echo esc_attr__( 'Logo', 'calcio' ); ?>">
                </div>
                <?php endif; ?>
                <!-- end -->

                <div class="counter-class" data-date="'<?php echo esc_attr($countdate);?>">
                    <div id="comingsoon-countdown">
                        <div class="countdown-section"><span class="countdown-amount first-item countdown-days counter-days"></span> <span class="countdown-period"><?php echo esc_attr__('Days', 'calcio') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-hours counter-hours"></span> <span class="countdown-period"><?php echo esc_attr__('Hours', 'calcio') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-minutes counter-minutes"></span> <span class="countdown-period"><?php echo esc_attr__('Minutes', 'calcio') ?></span></div>
                        <div class="countdown-section"><span class="countdown-amount countdown-seconds counter-seconds"></span> <span class="countdown-period"><?php echo esc_attr__('Seconds', 'calcio') ?></span></div>
                    </div>
                </div>

                <div class="row justify-content-center coming-soon-content">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <h2 style="<?php print $title_color; ?>"><?php echo get_theme_mod( 'comingsoon_title', 'This Website is Live Soon!' ); ?></h2>
                        <p><?php echo get_theme_mod( 'comingsoon_desc', 'Fresh design and content is preparing right now. Dont forget to subscribe to stay tuned' ); ?></p>
                    </div>
                </div>

                <div class="text-center newsletter_contact_modal">
                    <button type="button" class="btn btn-primary btn-newsletter" data-toggle="modal" data-target="#notifyModal">
                        <?php echo esc_html__( 'Get Notify Me', 'newskit' ); ?>
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contactModal">
                        <?php echo esc_html__( 'Contact Us', 'newskit' ); ?>
                    </button>
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
                
                <div class="text-center coming-soon-copyright">
                    <span><?php echo get_theme_mod( 'coming_soon_copyright', '© 2018 Newskit. All Rights Reserved.' ); ?></span>
                </div>

            </div><!--/.comingsoon-content-->
        </div><!--/.comingsoon-wrap-->
</div><!--/.comingsoon-->

<!-- Subcribe Modal -->
<div class="modal fade coming-sooon-modal" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <div>×</div>
        </button>
      <div class="modal-newsletter-content">
        <!-- News Latter -->
        <?php if( get_theme_mod('newsletter')): ?>
            <div class="coming-soon-newslatter">
                <?php echo do_shortcode(get_theme_mod( 'newsletter' )); ?>
            </div>
        <?php endif; ?>
        <!-- end newslatter -->
      </div>
    </div>
  </div>
</div>
<!-- Subcribe Modal -->
<!-- Contact Modal -->
<div class="modal fade coming-sooon-modal modal-coming-contact" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <div>×</div>
        </button>
      <div class="modal-newsletter-content">
        <h1 class="coming-soon-contact-head"><?php echo esc_html__( "Contact Us", 'newskit' ); ?></h1>
        <!-- News Latter -->
        <?php if( get_theme_mod('contact_us')): ?>
            <div class="coming-soon-newslatter">
                <?php echo do_shortcode(get_theme_mod( 'contact_us' )); ?>
            </div>
        <?php endif; ?>
        <!-- end newslatter -->
      </div>
    </div>
  </div>
</div>
<!-- Subcribe Modal -->


<?php get_footer('alternative');