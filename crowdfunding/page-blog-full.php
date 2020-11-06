<?php
/*
 * Template Name: Blog Listing Full
 */
get_header(); ?>

    <section id="main">

        <div id="content" class="site-content" role="main">
            <?php get_template_part('lib/sub-header')?>

            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array('post_type' => 'post','paged' => $paged);
            $thequery = new WP_Query($args);

            if ( $thequery->have_posts() ) :
                while ( $thequery->have_posts() ) : $thequery->the_post();
                    get_template_part( 'post-format/content', get_post_format() );
                endwhile;
            else:
                get_template_part( 'post-format/content', 'none' );
            endif;
            wp_reset_postdata();
            ?>
            <?php
            $page_numb = max( 1, get_query_var('paged') );
            $max_page = $thequery->max_num_pages;
            echo themeum_pagination( $page_numb, $max_page );
            ?>
        </div> <!-- #content -->

    </section>

<?php get_footer();