<?php
    global $post;
    $footerhide = get_post_meta(get_the_ID(),'themeum_foot_hide',true); 
    if($footerhide === '0') {
        $footerhide = 'hide';
    } else {
        $footerhide = 'show';
    }
?>

        <?php if ( get_theme_mod( 'bottom_en', true )) { ?>
            <?php $col = get_theme_mod( 'bottom_column', 3 ); ?>
            <div id="bottom-wrap"  class="footer-<?php echo $footerhide;?>"> 
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
                    </div>
                </div>
            </div><!--/#bottom-wrap-->
        <?php } ?>
        <?php if ( get_theme_mod( 'footer_en', true )) { ?>
            <footer id="footer-wrap"> 
                <div class="container">
                    <div class="row clearfix">
                        <?php if ( get_theme_mod( 'copyright_en', true )) { ?>

                            <?php if (get_theme_mod( 'bottom_footer_menu', true ) ) { ?>
                            <div class="col-sm-12 text-sm-center text-md-left col-md-6">
                            <?php } else{?>
                            <div class="col-sm-12 col-md-12 text-center">
                            <?php }?>
                                <div class="footer-copyright">
                                    <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                        <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '© 2018 Zephyr. All Rights Reserved.') )); ?>
                                    <?php } ?>
                                </div> <!-- col-md-6 -->

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
                            </div> <!-- end footer-copyright -->
                        <?php } ?>   


                        <?php if ( get_theme_mod( 'theme_design', true )) { ?>
                            
                            <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                            <div class="col-sm-12 col-md-6 text-right">
                            <?php }else{ ?>
                            <div class="col-sm-12 col-md-12 text-center">
                            <?php } ?>
                                <?php if ( get_theme_mod( 'theme_design', true )) { ?>
                                    <span class="footer-theme-design"><?php echo wp_kses_post(balanceTags( get_theme_mod( 'theme_design', 'Design & Development by JoomShaper.') )); ?></span>
                                <?php } ?>  
                            </div>
                            
                        <?php } ?>                     


                        
                        
                    </div><!--/.row clearfix-->    
                </div><!--/.container-->    
            </footer><!--/#footer-wrap-->    
        <?php } ?>
    </div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
