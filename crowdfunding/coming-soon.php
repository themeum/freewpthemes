<?php 

/*
 * Template Name: Coming Soon
 */

get_header('alternative'); ?>

<?php
    global $themeum_options;
    $comingsoon_date = '';
    if (isset($themeum_options['comingsoon-date'])) {
        $comingsoon_date = esc_attr($themeum_options['comingsoon-date']);
    }
?>

<div id="comming-soon" class="comingsoon">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center wow fadeIn">
                <div class="logo">
                    <img src="<?php echo esc_url($themeum_options['comingsoon']['url']); ?>" class="wow pulse" data-wow-delay=".1s">
                </div>

                <div class="comingsoon-content">
                    <h1><?php if (isset($themeum_options['comingsoon-title'])) echo esc_html($themeum_options['comingsoon-title']); ?></h1>
                    <p><?php if (isset($themeum_options['comingsoon-message-desc'])) echo esc_html($themeum_options['comingsoon-message-desc']); ?></p>

                    <script type="text/javascript">
                    jQuery(function($) {
                        $('#comingsoon-countdown').countdown("<?php echo str_replace('-', '/', $comingsoon_date); ?>", function(event) {
                            $(this).html(event.strftime('<div class="countdown-section"><span class="countdown-amount first-item">%-D </span><span class="countdown-period">%!D:<?php echo __("Day", "themeum"); ?>,<?php echo __("Days", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-H </span><span class="countdown-period">%!H:<?php echo __("Hour", "themeum"); ?>,<?php echo __("Hours", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-M </span><span class="countdown-period">%!M:<?php echo __("Minute", "themeum"); ?>,<?php echo __("Minutes", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-S </span><span class="countdown-period">%!S:<?php echo __("Second", "themeum"); ?>,<?php echo __("Seconds", "themeum"); ?>;</span></div>'));
                        });
                    });
                    </script>

                    <div id="comingsoon-countdown"></div>
                    <?php if (isset($themeum_options['csshare-en'])) { ?>
                        <div class="social-bar">
                            <ul class="list-unstyled list-inline">
                             <?php if ( isset($themeum_options['csfacebook']) && $themeum_options['csfacebook'] ) { ?>
                                <li><a href="<?php echo esc_url($themeum_options['csfacebook']); ?>"><i class="fa fa-facebook"></i></a></li>
                             <?php } ?>
                             <?php if ( isset($themeum_options['cstwitter']) && $themeum_options['cstwitter'] ) { ?>
                                <li><a href="<?php echo esc_url($themeum_options['cstwitter']); ?>"><i class="fa fa-twitter"></i></a></li>
                             <?php } ?>
                             <?php if ( isset($themeum_options['csgplus']) && $themeum_options['csgplus'] ) { ?>
                                <li><a href="<?php echo esc_url($themeum_options['csgplus']); ?>"><i class="fa fa-google-plus"></i></a></li>
                             <?php } ?>
                             <?php if ( isset($themeum_options['csyoutube']) && $themeum_options['csyoutube'] ) { ?>
                                <li><a href="<?php echo esc_url($themeum_options['csgplus']); ?>"><i class="fa fa-youtube"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <div class="copyright">
                        <?php if (isset($themeum_options['comingsoon-copyright'])){  echo esc_html($themeum_options['comingsoon-copyright']); } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php get_footer('alternative');