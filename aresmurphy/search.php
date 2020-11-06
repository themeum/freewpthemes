<?php get_header(); ?>

<section id="main">
   <?php  if ( get_theme_mod( 'disable_sub_header', true ) ) {
       get_template_part('lib/sub-header');
    }?>

    <div class="search-content">
        <div class="container">
            <div class="row">
                <div id="content" class="site-content col-sm-12" role="main">
                    <?php if ( have_posts() ) : ?>

                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                        <?php endwhile; ?>

                       <?php                                 
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $wp_query->max_num_pages;
                        echo aresmurphy_pagination( $page_numb, $max_page ); 
                        ?>

                    <?php else: ?>
                        <?php get_template_part( 'post-format/content', 'none' ); ?>
                    <?php endif; ?>
                </div> <!-- #content -->
                <?php //get_sidebar(); ?>
            </div> <!-- .row -->
        </div><!-- .container -->
    </div>
</section>
<?php get_footer();