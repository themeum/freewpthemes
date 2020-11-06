<?php get_header(); ?>
<section id="main" class="generic-padding">
    <?php get_template_part('lib/sub-header')?>
    <div class="container"> 
        <div id="content" class="site-content" role="main">
            <div class="row">
                <?php
                    $col = get_theme_mod( 'blog_column', 4 );
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post(); ?>
                                <div class="separator-wrapper col-md-<?php echo esc_attr($col);?>">
                                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                            <?php
                        endwhile;
                    else:
                        get_template_part( 'post-format/content', 'none' );
                    endif;                              
                $page_numb = max( 1, get_query_var('paged') );
                $max_page = $wp_query->max_num_pages;
                echo flatpro_pagination( $page_numb, $max_page ); 
                ?>
            </div><!-- .row -->
        </div><!-- .container -->
    </div> <!-- #content -->
</section> 

<?php get_footer();