<?php 
    $col = get_theme_mod( 'bottom_column', 3 );
    $enable_bottom_section  = get_theme_mod( 'enable_bottom_section', true );
    $enable_mailchimp       = get_theme_mod( 'enable_mailchimp', true ); 
    $footer_banner          = get_theme_mod( 'footer_banner', get_template_directory_uri().'/images/footer_banner.jpg');
?>

    <div class="mailchimp-banners" style="background-image: url(<?php echo $footer_banner; ?>); background-size: cover;">
        <?php if ($enable_bottom_section == 'true'): ?>
            <div class="bottom footer-wrap">
                <div class="container bottom-footer-cont">
                    <div class="row clearfix">
                        <!-- Without MailChimp -->
                        <?php if ($enable_mailchimp == 'true'){ ?>
                             <!-- mailchil-container start -->
                            <?php if (is_active_sidebar('bottom1')):?>
                                <div class="col-lg-12 mailchimp-inner bottom-wrap">
                                    <div class="mailchil-container">
                                        <?php dynamic_sidebar('bottom1'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- mailchimp end --> 
                        <?php } ?>
                    </div>
                </div>
            </div><!--/#footer-->
        <?php endif; ?>
    </div>

    <?php if ( get_theme_mod( 'enable_footer_en', true )) { ?>
        <!-- Start Footer -->
        <footer id="footer" class="footer-banner"> 
            <div class="container">
                <div class="footer-copyright">
                    <div class="row">  
                        <div class="col-md-6 text-left copy-wrapper">
                            <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                <span><?php echo wp_kses_post( get_theme_mod( 'copyright_text', '© 2018 Eventco. All Rights Reserved.') ); ?></span>
                            <?php } ?>
                        </div> <!-- end row -->
                        <div class="col-md-6 text-right copy-wrapper">
                            <?php if( get_theme_mod( 'socialshare_en', true ) ) { ?>
                            <?php get_template_part('lib/social-link')?>
                            <?php } ?>
                        </div> <!-- end row -->
                    </div> <!-- end row -->
                </div> <!-- end row --> 
            </div> <!-- end container -->
        </footer>
        <!-- End footer -->
    <?php } ?>
    

</div> <!-- #page -->
<?php wp_footer(); ?>

<script>
        $(window).load(function(){
            $('#global').fadeOut();
        });
    </script>
</body>
</html>
