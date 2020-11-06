<div class="footer-wraper">
    <?php if ( get_theme_mod( 'bottom_en', true ) && (is_active_sidebar('bottom1') || is_active_sidebar('bottom2') || is_active_sidebar('bottom3') || is_active_sidebar('bottom4') || is_active_sidebar('bottom5'))) { ?>
        <?php 
            $wid_count = get_theme_mod( 'bottom_column', 4 ); 
            $wid_layout = get_theme_mod('cal_footer_widget', 'lay1');
        ?>
        <div id="bottom-wrap"> 
            <div class="container heading-font">
                <?php if($wid_layout == 'lay1'): ?>
                    <div class="row clearfix">
                        <?php if (is_active_sidebar('bottom1') && $wid_count < 6 ):?>
                            <div class="col-sm-6 col-md-6 col-lg">
                                <?php dynamic_sidebar('bottom1'); ?>
                            </div>
                        <?php endif; ?> 
                        <?php if (is_active_sidebar('bottom2') && $wid_count < 5):?>
                            <div class="col-sm-6 col-md-6 col-lg">
                                <?php dynamic_sidebar('bottom2'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('bottom3') && $wid_count < 4):?>
                            <div class="col-sm-6 col-md-6 col-lg">
                                <?php dynamic_sidebar('bottom3'); ?>
                            </div>  
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom4') && $wid_count < 3):?>                 
                            <div class="col-sm-6 col-md-6 col-lg">
                                <?php dynamic_sidebar('bottom4'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom5') && $wid_count < 2):?>                 
                            <div class="col-sm-6 col-md-6 col-lg">
                                <?php dynamic_sidebar('bottom5'); ?>
                            </div>
                        <?php endif; ?>  
                    </div>
                <?php elseif($wid_layout == 'lay2'):  ?>
                    <div class="row">
                        <?php if (is_active_sidebar('bottom1')):?>
                            <div class="col-sm-6 col-lg-2">
                                <?php dynamic_sidebar('bottom1'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom2')):?>
                            <div class="col-sm-6 col-lg-2">
                                <?php dynamic_sidebar('bottom2'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom3')):?>
                            <div class="col-sm-6 col-lg-4">
                                <?php dynamic_sidebar('bottom3'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom4')):?>
                            <div class="col-sm-6 col-lg-4">
                                <?php dynamic_sidebar('bottom4'); ?>
                            </div>
                        <?php endif; ?>  
                    </div>
                <?php elseif($wid_layout == 'lay3'):  ?>
                    <div class="row">
                        <?php if (is_active_sidebar('bottom1')):?>
                            <div class="col-sm-6 col-lg-3">
                                <?php dynamic_sidebar('bottom1'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom2')):?>
                            <div class="col-sm-6 col-lg-3">
                                <?php dynamic_sidebar('bottom2'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom3')):?>
                            <div class="col-sm-6 col-lg-2">
                                <?php dynamic_sidebar('bottom3'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom4')):?>
                            <div class="col-sm-6 col-lg-2">
                                <?php dynamic_sidebar('bottom4'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom5')):?>
                            <div class="col-sm-6 col-lg-2">
                                <?php dynamic_sidebar('bottom5'); ?>
                            </div>
                        <?php endif; ?>  
                    </div>
                <?php elseif($wid_layout == 'lay4'):  ?>
                    <div class="row">
                        <?php if (is_active_sidebar('bottom1')):?>
                            <div class="col-sm-6 col-lg-2">
                                <?php dynamic_sidebar('bottom1'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom2')):?>
                            <div class="col-sm-6 col-lg-3">
                                <?php dynamic_sidebar('bottom2'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom3')):?>
                            <div class="col-sm-6 col-lg-2">
                                <?php dynamic_sidebar('bottom3'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom4')):?>
                            <div class="col-sm-6 col-lg-2">
                                <?php dynamic_sidebar('bottom4'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php if (is_active_sidebar('bottom5')):?>
                            <div class="col-sm-6 col-lg-3">
                                <?php dynamic_sidebar('bottom5'); ?>
                            </div>
                        <?php endif; ?>  
                    </div>
                <?php endif; ?>
            </div>
        </div><!--/#bottom-wrap-->
    <?php } ?>
    <?php if ( get_theme_mod( 'footer_en', true )) {
            $footer_abs = get_theme_mod('is_absolute', false);
            if($footer_abs){
                $footer_abs = 'absolute-footer';
            }
        ?>
        <footer id="footer-wrap" class="<?php echo esc_attr($footer_abs); ?>"> 
            <div class="container heading-font">
                <div class="row clearfix">
                    <?php if ( get_theme_mod( 'copyright_en', true )) { ?>
                        <div class="col-sm-12 col-md">
                            <div class="footer-copyright">
                                <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                    <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '&copy; 2017 Calypso. All Rights Reserved.') )); ?>
                                <?php } ?>
                            </div> <!-- col-md-6 -->
                        </div> <!-- end footer-copyright -->
                    <?php } ?>                        
                    <?php if(get_theme_mod('dev_credit', false)){ 
                        ?> 
                            <div class="col-sm-12 col-md">
                                <div class="template-credit text-md-right">
                                    <p><?php echo esc_html__( 'Design & Development By ', 'calypso' ); ?><a href="https://www.themeum.com/"><?php echo esc_html__( 'Themeum', 'calypso' ); ?></a></p>
                                </div>
                            </div>
                        <?php
                    } ?>
                </div><!--/.row clearfix-->    
            </div><!--/.container-->    
        </footer><!--/#footer-wrap-->    
    <?php } ?>
</div>
    </div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
