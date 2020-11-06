<?php get_header(); ?>
<?php get_template_part('lib/sub-header'); ?>

<section id="main" class="woo-product-wrap wrappers-content">
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
                <?php if (get_theme_mod('enable_sidebar', true)): ?>
                    <div class="col-md-3 shop-filter-wrap">
                        <?php dynamic_sidebar('shop');?>
                    </div>
                <?php endif ?>

                <!-- Woo Product -->
                <?php if (get_theme_mod('enable_sidebar', true)){ ?>
                <div id="content" class="col-md-9" role="main">
                <?php }else{ ?>
                <div id="content" class="col-md-12" role="main">
                <?php } ?>
                    <div class="site-content">
                        <?php woocommerce_content(); ?>
                    </div>
                </div>
            <?php } ?>
            
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); 