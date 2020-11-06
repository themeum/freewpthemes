<?php 
/**
* Template Name: Blog Fullwidth 
*/
get_header();?>

<section id="main">

   <?php  if ( get_theme_mod( 'disable_sub_header', true ) ) {
       get_template_part('lib/sub-header');
    }?>
    <div class="container">
        <div id="content" class="site-content" role="main">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array('post_type' => 'post','paged' => $paged);
            $thequery = new WP_Query($args); 

            $index = 1;
            $col = get_theme_mod( 'blog_column', 12 );

            if ( $thequery->have_posts() ) :
                while ( $thequery->have_posts() ) : $thequery->the_post();

                    if ( $index == '1' ) { ?>
                        <div class="row">
                    <?php }?>
                        <div class="col-md-<?php echo esc_attr($col);?>">
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                        </div>
                    <?php  if ( $index == (12/esc_attr($col) )) { ?>
                        </div><!--/row-->
                    <?php $index = 1;
                    }else{
                        $index++;   
                    }                        
                endwhile;
            else:
                get_template_part( 'post-format/content', 'none' );
            endif;
            wp_reset_postdata();
            if($index !=  1 ){ ?>
               </div><!--/row-->
            <?php } ?>
           <?php                                 
                $page_numb = max( 1, get_query_var('paged') );
                $max_page = $thequery->max_num_pages;
                echo aresmurphy_pagination( $page_numb, $max_page );  
            ?>
        </div> <!-- .site-content -->
    </div><!-- .container -->
</section> 

<?php get_footer();