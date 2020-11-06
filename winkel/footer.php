        <!-- Footer start -->
        <?php if ( get_theme_mod( 'bottom_footer_menu', true )) { ?>
            <div id="footer-menu"> 
                <div class="container">
                    <div class="row clearfix">
                        <?php if ( has_nav_menu( 'footernav' ) ) { ?>
                            <div class="col-sm-12 col-md-12">
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
                        <?php } ?> 
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- Footer menu End -->

        <!-- Footer Widgets -->
        <?php if ( get_theme_mod( 'bottom_en', true )) { ?>
            <?php $col = get_theme_mod( 'bottom_column', 3 ); ?>
            <div id="bottom-wrap"> 
                <div class="container">
                    <div class="row clearfix">
                        <?php if (is_active_sidebar('bottom1')):?>
                            <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                                <?php dynamic_sidebar('bottom1'); ?>
                            </div>
                        <?php endif; ?> 
                        <?php if (is_active_sidebar('bottom2')):?>
                            <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                                <?php dynamic_sidebar('bottom2'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('bottom3')):?>
                            <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                                <?php dynamic_sidebar('bottom3'); ?>
                            </div>  
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom4')):?>                 
                            <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                                <?php dynamic_sidebar('bottom4'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom5')):?>                 
                            <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                                <?php dynamic_sidebar('bottom5'); ?>
                            </div>
                        <?php endif; ?> 
                        <?php if (is_active_sidebar('bottom6')):?>                 
                            <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                                <?php dynamic_sidebar('bottom6'); ?>
                            </div>
                        <?php endif; ?> 
                    </div>
                </div>
            </div><!--/#bottom-wrap-->
        <?php } ?>
        <!-- Footer widgets End -->

        <!-- Footer Copy Right -->
        <?php if ( get_theme_mod( 'footer_en', true )) { ?>
            <footer id="footer-wrap"> 
                <div class="container">
                    <div class="row clearfix">
                        <?php if ( get_theme_mod( 'copyright_en', true )) { ?>
                            <div class="col-sm-12 col-md-6">
                                <div class="footer-copyright">
                                    <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                        <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '© 2017 Winkel. All Rights Reserved.') )); ?>
                                    <?php } ?>
                                </div> <!-- col-md-6 -->
                            </div> <!-- end footer-copyright -->
                        <?php } ?>

                        <?php if ( get_theme_mod( 'footer_bottom_menu', true )) { ?>
                            <?php if ( has_nav_menu( 'footer_menu' ) ) { ?>
                                <div class="col-sm-12 col-md-6">
                                    <?php
                                    $default = array( 'theme_location'  => 'footer_menu',
                                      'container'       => '', 
                                      'menu_class'      => 'menu-footer-menu',
                                      'menu_id'         => 'menu-footer-menu2',
                                      'fallback_cb'     => 'wp_page_menu',
                                      'depth'           => 1
                                    );
                                    wp_nav_menu($default);
                                    ?>
                                </div>
                            <?php } ?> 
                        <?php } ?>   

                    </div> <!--row -->    
                </div> <!--container-->    
            </footer> <!-- footer-wrap-->    
        <?php } ?>
        <!-- Copy Right End -->

    </div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
