<?php get_header(); ?>

<section id="main" class="wrappers-content">
    <div class="container">
    <?php get_template_part('lib/sub-header')?>
    	<div class="row">
            <div id="content" class="soccer-shop col-md-12" role="main">
                <div class="site-content">
                    <?php woocommerce_content(); ?>
                </div>
            </div> 
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>