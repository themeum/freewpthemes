
    <?php if( is_active_sidebar('bottom') ){ ?>
        <div class="bottom">
            <div class="container">
                <div class="row clearfix">
                    <?php if (is_active_sidebar('bottom')) {?>
                        <?php dynamic_sidebar('bottom'); ?>
                    <?php } ?>
                </div>
            </div>
        </div><!--/#footer-->
    <?php } ?>

    <!-- start footer -->
        <footer id="footer" class="footer-wrap"> 
            <div class="container">
                <?php if ( get_theme_mod( 'copyright_en', true ) || get_theme_mod( 'footer_share', true ) || get_theme_mod( 'footer_logo', true ) ) { ?>
                    <div class="footer-copyright">
                        <div class="row">   
                            <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                <div class="col-md-12 text-center copy-wrapper">
                                    <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '© 2017 Tixon. All Rights Reserved.') )); ?>
                                </div> <!-- end row -->
                            <?php } ?>
                        </div> <!-- end row -->
                    </div> <!-- end row -->
                <?php } ?>
            </div> <!-- end container -->
        </footer>
    </div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
