<?php get_header(); ?>

<section id="main">
    <?php get_template_part('lib/sub-header')?>
    <div class="container">
    	   <div class="row">
              <div id="content" class="col-md-12" role="main">
                  <div class="site-content">
                      <?php woocommerce_content(); ?>
                  </div>
              </div> <!-- #content -->
         </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>
