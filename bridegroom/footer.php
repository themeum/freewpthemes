<?php 
$footer_banner          = get_theme_mod( 'footer_banner', get_template_directory_uri().'/images/footer_banner.jpg');
$couple_banner          = get_theme_mod( 'couple_banner', get_template_directory_uri().'/images/bride_groom.png');
$intro_text             = get_theme_mod( 'widding_intro_text', true);
$footer_style           = get_theme_mod( 'footer_style', true); ?>

<?php if ( get_theme_mod( 'enable_footer_en', true )) { ?>
    <!-- Start Footer -->
    <footer id="footer" class="footer-banner" style="background-image: url(<?php echo $footer_banner; ?>); background-size: cover; background-position: 0; background-repeat: no-repeat;"> 
        <div class="container">
            <div class="footer-copyright">
                <div class="row"> 

                    <?php if ($footer_style == 'style1'){ ?>
                        <div class="col-md-12 text-center couple-photo">
                            <div class="photo-wrap">
                                <img src="<?php echo $couple_banner; ?>">
                            </div>
                            <?php if ($intro_text) { ?>
                                <h2> <?php echo esc_html(get_theme_mod( 'intro_text', esc_html__('Thanks For Coming', 'bridegroom') )); ?> </h2>
                            <?php } ?>
                        </div>

                        <div class="col-md-12 text-center copy-wrapper">
                            <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                <span><?php echo wp_kses_post( get_theme_mod( 'copyright_text', '2018 BrideGroom. All Rights Reserved.') ); ?></span>
                            <?php } ?>
                        </div> <!-- end row -->

                    <?php }else { ?>

                        <div class="col-md-8 text-left copy-wrapper style2">
                            <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                <span><?php echo wp_kses_post( get_theme_mod( 'copyright_text', '2018 BrideGroom. All Rights Reserved.') ); ?></span>
                            <?php } ?>

                            <div class="footer-nav">
                                <?php
                                    $default = array( 'theme_location'  => 'footernav',
                                    'container'       => '', 
                                    'menu_class'      => 'menu-footer-menu',
                                    'menu_id'         => 'menu-footer-menu',
                                    'fallback_cb'     => 'wp_page_menu',
                                    'depth'           => 1
                                    );
                                    wp_nav_menu($default);
                                ?>
                            </div> <!-- end row -->
                        </div> <!-- end row -->

                        <div class="col-md-4 text-right copy-wrapper style2 social-share">
                            <?php if( get_theme_mod( 'socialshare_en', true ) ) { ?>
                            <?php get_template_part('lib/social-link')?>
                            <?php } ?>
                        </div> <!-- end row -->
                    <?php } ?>

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
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.js"></script>

</body>
</html>
