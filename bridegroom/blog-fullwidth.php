<?php 
/**
* Template Name: Blog Fullwidth 
*/
get_header();?>

<?php get_template_part('lib/sub-header'); ?>

<section id="main" class="page-content blog-full-width">
    <div class="container">
        <div class="row"> 

            <div id="content" class="site-content col-md-12" role="main">
                <?php
                # Query for FontPage and default template. 
                if (is_front_page()) {
                    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                }else{
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                }
                
                $args = array('post_type' => 'post','paged' => $paged);
                $thequery = new WP_Query($args); 

                if ( $thequery->have_posts() ) :
                    while ( $thequery->have_posts() ) : $thequery->the_post();
                        get_template_part( 'post-format/content', get_post_format() );
                    endwhile;
                else:
                    get_template_part( 'post-format/content', 'none' );
                endif; ?>

                <div class="row">
                    <div class="bridegroom-pagination">
                        <?php 
                            $page_numb = max( 1, get_query_var('paged') );
                            $max_page = $thequery->max_num_pages;
                            bridegroom_pagination($page_numb, $max_page); 
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- .container -->
</section> 

<?php get_footer();