<?php get_header(); ?>

<?php $col = (is_product()) ? 12 : 8; ?>

<section id="main" class="wrappers-content generic-padding">
    <?php get_template_part('lib/sub-header')?>
    <div class="container">
    	<div class="row">
            <div id="content" class="col-md-12" role="main">
                <div class="site-content">
                    <?php woocommerce_content(); ?>
                </div>
            </div> 
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>