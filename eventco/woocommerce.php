<?php get_header(); ?>
<?php get_template_part('lib/sub-header')?>

<section id="main" class="wrappers-content">
    <div class="container">
        <div class="row">
            <?php if (!is_single()){ ?>  
                <?php $sidebar_enable = get_theme_mod('shop_sidebar_disable', true); ?>
                <?php if ($sidebar_enable == true){ ?>
                    <div id="content" class="col-md-9" role="main">
                        <div class="site-content">
                            <?php woocommerce_content(); ?>
                        </div>
                    </div> 
                    <div id="shop" class="col-md-3" role="complementary">
                        <aside class="widget-area">
                            <?php 
                                if ( is_active_sidebar( 'shop' ) ) {
                                    dynamic_sidebar('shop');
                                }
                             ?>
                        </aside>
                    </div>
                <?php }else { ?>
                    <div id="content" class="col-md-12" role="main">
                        <div class="site-content">
                            <?php woocommerce_content(); ?>
                        </div>
                    </div> 
                <?php } ?>
            <?php }else{ ?>
                <div id="content" class="col-md-12" role="main">
                    <div class="site-content">
                        <?php woocommerce_content(); ?>
                    </div>
                </div> 
            <?php } ?>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>