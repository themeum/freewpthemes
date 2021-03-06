        <?php if ( get_theme_mod( 'bottom_en', true )) { ?>
            <?php 
            $col = get_theme_mod( 'bottom_column', 3 ); 
            $bottom_style = get_theme_mod( 'bottom_style', 'style_one' );
            ?>
            <div id="bottom-wrap"> 
                <div class="container">
                    <div class="row clearfix">
                        <?php if (is_active_sidebar('bottom1')):?>
                            <?php if($bottom_style == 'style_one') {?>
                                <div class="col-sm-6 col-md-6 col-lg-2 footer-single-wrap footer-col-one">
                            <?php }else{?>
                                <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                            <?php }?>
                                <?php dynamic_sidebar('bottom1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('bottom2')):?>
                            <?php if($bottom_style == 'style_one') {?>
                                <div class="col-sm-6 col-md-6 col-lg-6 footer-single-wrap">
                            <?php }else{?>
                                <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                            <?php }?>
                                <?php dynamic_sidebar('bottom2'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('bottom3')):?>
                            <?php if($bottom_style == 'style_one') {?>
                                <div class="col-sm-6 col-md-6 col-lg-2 footer-single-wrap">
                            <?php }else{?>
                                <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                            <?php }?>
                                <?php dynamic_sidebar('bottom3'); ?>
                            </div>  
                        <?php endif; ?>  

                        <?php if (is_active_sidebar('bottom4')):?>                 
                            <?php if($bottom_style == 'style_one') {?>
                                <div class="col-sm-6 col-md-6 col-lg-2 footer-single-wrap">
                            <?php }else{?>
                                <div class="col-sm-6 col-md-6 col-lg-<?php echo $col;?>">
                            <?php }?>
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
                                        <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '&copy; 2017 Newskit. All Rights Reserved.') )); ?>
                                    <?php } ?>
                                </div> <!-- col-md-6 -->
                            </div> <!-- end footer-copyright -->
                        <?php } ?>                        
                        <?php if(get_theme_mod( 'copyright_en', true )){ ?>
                        <div class="col-sm-12 col-md-6 text-md-right">
                        <?php }else{ ?>
                        <div class="col-sm-12 col-md-12 text-center">
                        <?php }?>
                            <div class="template-credit">
                                <p><?php echo esc_html__( 'Design & Development By ','newskit' ); ?><a href="#"><?php echo esc_html__( 'Themeum','newskit' ); ?></a></p>
                            </div>
                        </div>
                    </div><!--/.row clearfix-->    
                </div><!--/.container-->    
            </footer><!--/#footer-wrap-->    
        <?php } ?>
    </div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
