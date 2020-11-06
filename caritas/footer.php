<?php
global $post;
$footerhide = get_post_meta(get_the_ID(),'caritas_foot_hide',true);
if($footerhide === '0') {
	$footerhide = 'hide';
} else {
	$footerhide = 'show';
}

?>
<?php
$footer_shortcode = get_theme_mod('caritas_footer_shortcode', '');
if(!empty($footer_shortcode)){
	echo do_shortcode($footer_shortcode);
}
?>

<?php if ( get_theme_mod( 'bottom_en', true )) { ?>
	<?php $col = get_theme_mod( 'bottom_column', 3 ); ?>
    <div id="bottom-wrap"  class="footer-<?php echo $footerhide;?>">
        <div class="container">
            <div class="row clearfix">
				<?php if (is_active_sidebar('bottom1')):?>
                    <div class="col-sm-6 col-lg">
						<?php dynamic_sidebar('bottom1'); ?>
                    </div>
				<?php endif; ?>
				<?php if (is_active_sidebar('bottom2')):?>
                    <div class="col-sm-6 col-lg">
						<?php dynamic_sidebar('bottom2'); ?>
                    </div>
				<?php endif; ?>
				<?php if (is_active_sidebar('bottom3')):?>
                    <div class="col-sm-6 col-lg">
						<?php dynamic_sidebar('bottom3'); ?>
                    </div>
				<?php endif; ?>
				<?php if (is_active_sidebar('bottom4')):?>
                    <div class="col-sm-6 col-lg">
						<?php dynamic_sidebar('bottom4'); ?>
                    </div>
				<?php endif; ?>
                <?php if (is_active_sidebar('bottom5')):?>
                    <div class="col-12 col-lg">
						<?php dynamic_sidebar('bottom5'); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div><!--/#bottom-wrap-->
<?php } ?>
<?php if ( get_theme_mod( 'footer_en', true )) { ?>
    <footer id="footer-wrap">
        <div class="container">

            <?php
                $footer_class = (get_theme_mod( 'bottom_footer_menu', true ) && has_nav_menu( 'footernav' )) || caritas_has_social();
                $footer_class = !empty($footer_class) ? 'justify-content-between' : 'justify-content-center';
            ?>

            <div class="row align-items-center <?php echo $footer_class;?>">
				<?php if ( get_theme_mod( 'copyright_en', true )) { ?>
                    <div class="col-auto">
                        <div class="footer-copyright">
							<?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
								<?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '&copy; 2018 Caritas. All Rights Reserved.') )); ?>
							<?php } ?>
                        </div> <!-- col-md-6 -->
                    </div> <!-- end footer-copyright -->
                <?php } ?>

				<?php if ( get_theme_mod( 'bottom_footer_menu', true ) && has_nav_menu( 'footernav' )) { ?>
                    <div class="col text-center footer-menu-center">
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

                <?php if(caritas_has_social()){
                    ?>
                        <div class="col-auto">
                            <?php
                            include('lib/social-link.php');
                            ?>
                        </div>
                    <?php
                } ?>




            </div><!--/.row clearfix-->
        </div><!--/.container-->
    </footer><!--/#footer-wrap-->
<?php } ?>
</div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
