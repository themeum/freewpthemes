<?php get_header(); ?>

<section id="main" class="wrappers-content generic-padding">

    <?php 
        get_template_part('lib/sub-header');
    ?>
    <div class="container">
        <?php 
            if( !is_product() ){
                if ( is_active_sidebar( 'shop-cat' ) ) { ?>
                <div class="row"> 
                    <div class="col-md-12 shop-filter-wrap">
                        <?php dynamic_sidebar('shop-cat');?>
                    </div>
                </div>
                <?php }
            }
        ?>
        <div class="row">        
            <div id="content" class="col-md-12" role="main">
                <div class="site-content">
                    <?php //winkel_breadcrumbs(); ?>
                    <?php woocommerce_content(); ?>
                </div>
            </div> 
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>