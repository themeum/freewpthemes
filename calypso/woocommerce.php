<?php get_header(); ?>

<?php $col = (is_product()) ? 12 : 8; ?>

<section id="main" class="woo-product-wrap wrappers-content">
    <?php get_template_part('lib/sub-header'); ?>
    <div class="container">
    	<div class="row">
            
            <?php if (is_single()) { ?>
                <!-- Single Page Content -->
                <div id="content" class="col-md-12" role="main">
                    <div class="site-content">
                        <?php woocommerce_content(); ?>
                    </div>
                </div> 
            <?php }else{ ?>
                <!-- Woo Sidebar -->
                <div class="col-md-3 shop-filter-wrap">
                    <?php dynamic_sidebar('shop');?>
                </div>
                <!-- Woo Product -->
                <div id="content" class="col-md-9" role="main">
                    <div class="site-content">
                        <?php woocommerce_content(); ?>
                    </div>
                </div>
            <?php } ?>
            
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>