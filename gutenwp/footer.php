<?php 
    $enable_bottom_section  = get_theme_mod( 'enable_bottom_section', true );
    $footer_style           = get_theme_mod( 'footer_style', true );  
?>

    <div class="footer-widgets">
        <?php if ($enable_bottom_section == 'true'): ?>
            <div class="bottom footer-wrap">
                <div class="container bottom-footer-cont">
                    <div class="row clearfix">
                        <?php if ( $footer_style == 'style1' ) { ?>
                            <?php if (is_active_sidebar('bottom1')):?>
                                <div class="col-md-3 bottom-wrap <?php echo $footer_style; ?>">
                                    <div class="gutenwp-about">
                                        <?php dynamic_sidebar('bottom1'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom2')):?>
                                <div class="col-md-3 bottom-wrap <?php echo $footer_style; ?>">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom2'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom3')):?>
                                <div class="col-md-3 bottom-wrap <?php echo $footer_style; ?>">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom3'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom4')):?>
                                <div class="col-md-3 bottom-wrap <?php echo $footer_style; ?>">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom4'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php }else if( $footer_style == 'style2' ) { ?>

                            <div class="col-md-7 text-left footer-menu">
                                <div class="footer-menu">
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
                                </div> 
                            </div> 

                            <div class="col-md-5 text-right">
                                <div class="footer-social-share">
                                    <span><?php esc_html_e('Follow Us: ', 'gutenwp'); ?></span>
                                    <?php get_template_part('lib/social-link')?>
                                </div> 
                            </div>

                            <?php if (is_active_sidebar('bottom1')):?>
                                <div class="col-md-3 bottom-wrap lifestyle-footer">
                                    <div class="gutenwp-about">
                                        <?php dynamic_sidebar('bottom1'); ?>
                                    </div>
                                    <div class="text-left copy-wrapper">
                                        <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                            <span><?php echo wp_kses_post( get_theme_mod( 'copyright_text', '© 2018 gutenwp. All Rights Reserved.') ); ?></span>
                                        <?php } ?>
                                    </div> <!-- end row -->
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom2')):?>
                                <div class="col-md-3 bottom-wrap lifestyle-footer">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom2'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom3')):?>
                                <div class="col-md-6 bottom-wrap lifestyle-footer">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom3'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php }else if( $footer_style == 'style3' ) { ?>

                            <?php if (is_active_sidebar('bottom1')):?>
                                <div class="col-md-4 bottom-wrap lifestyle-footer <?php echo $footer_style; ?>">
                                    <div class="gutenwp-about">
                                        <?php dynamic_sidebar('bottom1'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom2')):?>
                                <div class="col-md-8 bottom-wrap lifestyle-footer <?php echo $footer_style; ?>">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom2'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php }elseif ($footer_style == 'style4') { ?>
                            <?php if (is_active_sidebar('bottom1')):?>
                                <div class="col-md-3 bottom-wrap lifestyle-footer <?php echo $footer_style; ?>">
                                    <div class="gutenwp-about">
                                        <?php dynamic_sidebar('bottom1'); ?>
                                    </div>
                                    <div class="text-left copy-wrapper">
                                        <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                            <span><?php echo wp_kses_post( get_theme_mod( 'copyright_text', '© 2018 gutenwp. All Rights Reserved.') ); ?></span>
                                        <?php } ?>
                                    </div> <!-- end row -->
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom2')):?>
                                <div class="col-md-3 bottom-wrap lifestyle-footer">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom2'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom3')):?>
                                <div class="col-md-3 bottom-wrap lifestyle-footer">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom3'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (is_active_sidebar('bottom4')):?>
                                <div class="col-md-3 bottom-wrap lifestyle-footer">
                                    <div class="gutenwp-container">
                                        <?php dynamic_sidebar('bottom4'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php }  ?>
                        
                    </div>
                </div>
            </div><!--/#footer-->
        <?php endif; ?>
    </div>

    <?php if ( $footer_style == 'style1' || $footer_style == 'style3' ){
        if ( get_theme_mod( 'enable_footer_en', true )) { ?>
            <!-- Start Footer -->
            <footer id="footer" class="footer-banner <?php echo $footer_style; ?>"> 
                <div class="container">
                    <div class="footer-copyright">
                        <div class="row">  
                            <div class="col-md-12 text-center copy-wrapper">
                                <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                    <span><?php echo wp_kses_post( get_theme_mod( 'copyright_text', '© 2018 gutenwp. All Rights Reserved.') ); ?></span>
                                <?php } ?>
                            </div> <!-- end row -->
                            
                        </div> <!-- end row -->
                    </div> <!-- end row --> 
                </div> <!-- end container -->
            </footer>
            <!-- End footer -->
        <?php } 
    } 

    ?>
    

</div> <!-- #page -->
<?php wp_footer(); ?>


<!-- Offcanvas menu Script -->
<script type="text/javascript">
    var menu = document.querySelector(".menu"),
    toggle = document.querySelector(".menu-toggle");
    if (toggle) {
        function toggleToggle() {
          toggle.classList.toggle("menu-open");
        };
        function toggleMenu() {
          menu.classList.toggle("active");
        };
        toggle.addEventListener("click", toggleToggle, false);
        toggle.addEventListener("click", toggleMenu, false);         
    }
</script>
<!-- End Offcanvas menu Script -->

</body>
</html>
