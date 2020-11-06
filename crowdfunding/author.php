<?php get_header(); ?>

<?php get_template_part('lib/sub-header')?>

<section id="main">
    <div id="content" class="site-content" role="main">
        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    get_template_part( 'post-format/content', get_post_format() );
                endwhile;
            else:
                get_template_part( 'post-format/content', 'none' );
            endif;
        ?>
        <?php
            global $wp_query;
            $page_numb = max( 1, get_query_var('paged') );
            $total_page = $wp_query->max_num_pages;
        ?>
        <?php themeum_pagination( $page_numb,$total_page ); ?>
    </div> <!-- #content -->
</section> 

<?php get_footer();