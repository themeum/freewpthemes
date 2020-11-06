    <!-- start footer -->
        <footer id="footer" class="footer-wrap"> 
            <div class="container">
                <?php if( is_active_sidebar('bottom') ){ ?>
                    <div class="bottom">
                        <div class="row">
                            <div class="col-sm-12 text-center footer-wrapper">
                                <?php if (is_active_sidebar('bottom')) {?>
                                    <div class="bottom-widget text-center">
                                        <?php dynamic_sidebar('bottom'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ( get_theme_mod( 'copyright_en', true ) || get_theme_mod( 'footer_share', true ) || get_theme_mod( 'footer_logo', true ) ) { ?>
                    <div class="footer-copyright">
                        <div class="row"> 
                            <?php 
                                $col = 4;
                                if ( get_theme_mod( 'copyright_en', true ) && get_theme_mod( 'footer_share', true ) && get_theme_mod( 'footer_logo', true ) ) {
                                    $col = 4;
                                } elseif ( get_theme_mod( 'copyright_en', true ) && get_theme_mod( 'footer_share', true ) ) {
                                    $col = 6;
                                } elseif (get_theme_mod( 'copyright_en', true ) && get_theme_mod( 'footer_logo', true )) {
                                    $col = 6;
                                } elseif ( get_theme_mod( 'footer_share', true ) && get_theme_mod( 'footer_logo', true ) ) {
                                    $col = 6;
                                }  elseif (get_theme_mod( 'copyright_en', true ) || get_theme_mod( 'footer_share', true ) || get_theme_mod( 'footer_logo', true )) {
                                   $col = 4; 
                                }
                            ?>   
                            <?php if( get_theme_mod( 'footer_share', true ) ) { ?>
                                <div class="col-md-<?php echo $col; ?>">
                                    <?php get_template_part('lib/social-link')?>
                                </div> <!-- end row -->
                            <?php } ?>
                            <?php if( get_theme_mod( 'footer_logo', true ) ) { ?>
                                <div class="col-md-<?php echo $col; ?> text-center">
                                    <img src="<?php echo esc_url( get_theme_mod('footer_logo',get_template_directory_uri().'/images/logo.png')); ?>" alt="">
                                </div>
                            <?php } ?>
                            <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                <div class="col-md-<?php echo $col; ?> text-right copy-wrapper">
                                    <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '© 2016 Starter Pro. All Rights Reserved.') )); ?>
                                </div> <!-- end row -->
                            <?php } ?>
                        </div> <!-- end row -->
                    </div> <!-- end row -->
                <?php } ?>
            </div> <!-- end container -->
        </footer>
    </div> <!-- #page -->

    <!-- Back to Top-->
    <?php if( get_theme_mod( 'backtop', true ) ){ ?>
    <a id="back-top" class="back-to-top page-scroll" href="#main">
        <i class="fa fa-arrow-up"></i>
    </a>
    <?php } ?>
    <!-- Back to Top-->

<?php wp_footer(); ?>
</body>
</html>
