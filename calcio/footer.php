
    </div>
    <!-- start footer -->
    <?php if( is_active_sidebar('bottom') ){ ?>
        <div class="bottom">
            <div class="container">
                <div class="row clearfix">
                    <?php if (is_active_sidebar('bottom')) { ?>
                        <?php dynamic_sidebar('bottom'); ?>
                    <?php } ?>
                </div>
            </div>
        </div><!--/#footer-->
    <?php } ?>

    <footer id="footer" class="footer-wrap">
        <?php if ( get_theme_mod( 'copyright_en', true ) || get_theme_mod( 'footer_share', true ) ) { ?>
            <div class="container">
                <div class="row">
                    <?php if( get_theme_mod( 'copyright_en', true ) ){ ?>
                        <div class="col-sm-6 text-left">
                        <?php echo wp_kses_post ( get_theme_mod( 'copyright_text', '2018 Your Company. Designed By THEMEUM' ) ); ?>
                        </div> <!-- end row -->
                    <?php } ?>
                    <div class="col-sm-6 text-right">
                        <?php get_template_part('lib/social-link'); ?>
                    </div>
                </div> <!-- end row -->
            </div>  <!-- end container -->
        <?php } ?>
    </footer>

<?php wp_footer(); ?>
</body>
</html>