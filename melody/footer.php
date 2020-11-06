        <?php if ( get_theme_mod( 'bottom_en', true )) { ?>
            <?php 
            $col = get_theme_mod( 'bottom_column', 3 ); 
            ?>
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
                    </div>
                </div>
            </div><!--/#bottom-wrap-->
        <?php } ?>
        <?php if ( get_theme_mod( 'footer_en', true )) { ?>
            <footer id="footer-wrap"> 
                <div class="container">
                    <div class="row clearfix">
                        <?php if ( get_theme_mod( 'copyright_en', true )) { ?>
                            <div class="col-sm-12 col-md-6">
                                <div class="footer-copyright">
                                    <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                        <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '&copy; 2017 melody. All Rights Reserved.') )); ?>
                                    <?php } ?>
                                </div> <!-- col-md-6 -->
                            </div> <!-- end footer-copyright -->
                        <?php } ?>                        
                        <?php if(get_theme_mod( 'copyright_en', true )){ ?>
                        <div class="col-sm-12 col-md-6 text-md-right">
                        <?php }else{ ?>
                        <div class="col-sm-12 col-md-12 text-center">
                        <?php }?>

                        <?php if ( has_nav_menu( 'footer' ) ) { ?>
                            <div class="footer-menu">
                              <?php  wp_nav_menu(
                                    array(
                                        'theme_location'  => 'footer',
                                        'container'       => false,
                                        'menu_class'      => 'footer-nav'
                                    )
                                ); ?>
                            </div>
                        <?php  } ?>

                        </div>
                    </div><!--/.row clearfix-->    
                </div><!--/.container-->    
            </footer><!--/#footer-wrap-->    
        <?php } ?>
    </div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
