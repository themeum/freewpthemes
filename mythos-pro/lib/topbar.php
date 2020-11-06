<div class="topbar">
    <div class="container">
        <div class="row">
            <?php 
            $topbarsocial   = get_theme_mod( 'topbar_social', true );
            $topbaremail    = get_theme_mod( 'topbar_email', 'support@themeum.com' );
            $topbarphone    = get_theme_mod( 'topbar_phone', '+00 44 123 456 78910' );
            ?>
            
            <?php if ( $topbaremail || $topbarphone ) {  ?>
                <div class="col-lg-6">
                    <div class="topbar-contact">
                        <span>
                            <a href="mailto:<?php print esc_attr($topbaremail);?>">
                            <i class="far fa-envelope"></i>
                                <?php print esc_attr($topbaremail);?>
                            </a>
                        </span>
                        <span class="top-contact-phone">
                            <a href="tel:<?php echo esc_attr($topbarphone); ?>">
                            <i class="fas fa-phone-volume"></i>
                                <?php echo esc_attr($topbarphone);?>
                            </a>
                        </span>
                    </div>
                </div>
            <?php } ?>

            <div class="col-lg-6 top-social-wrap text-right">
                <div class="topbar-menu social_icons">
                    
                    <!-- Woocart -->
                    <?php if (get_theme_mod('woocart_en', 'true')): ?>
                        <ul id="menu-main-menu" class="AA wp-megamenu">
                            <li class="woocart">
                                <a href="#">
                                    <?php 
                                    global $woocommerce;
                                    if($woocommerce) { ?>
                                        <span id="themeum-woo-cart" class="woo-cart" style="display:none;">
                                            <?php
                                                $has_products = '';
                                                $has_products = 'cart-has-products';
                                            ?>
                                            <i class="fas fa-cart-plus"></i>
                                            <span class="woo-cart-items">
                                                <span class="<?php echo esc_attr($has_products); ?>">
                                                    <?php echo wp_kses_post($woocommerce->cart->cart_contents_count); ?>   
                                                </span>
                                            </span>
                                            <?php the_widget( 'WC_Widget_Cart', 'title= ' ); ?>
                                        </span>
                                    <?php } ?> 
                                </a>
                            </li>
                        </ul> 
                    <?php endif; ?>
                    <!-- End Woocart --> 

                    <!-- Social Share -->
                    <?php
                        if ( $topbarsocial ) {
                            get_template_part('lib/social-link');
                        }
                    ?>  
                    <!-- End Social Share -->

                </div>
            </div>
        </div>
    </div>
</div>










