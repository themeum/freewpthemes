<?php get_header(); ?>
<section id="main" class="page-content">
   <?php get_template_part('lib/sub-header')?>
    <div class="container">
        <div class="row">
        <div class="col-md-9">
        <div id="content" class="site-content" role="main">
    		<?php
            $index = 1;
            $col = get_theme_mod( 'blog_column', 12 );
    		if ( have_posts() ) :
    			while ( have_posts() ) : the_post();
                    if ( $index == '1' ) { ?>
                        <div class="row">
                    <?php }?>
                            <div class="col-md-<?php echo esc_attr($col);?>">
                                <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                            </div>
                    <?php  if ( $index == (12/esc_attr($col) )) { ?>
                        </div> <!--/row-->
                    <?php $index = 1;
                    } else {
                        $index++;
                    }
    			endwhile;
    		else :
    			get_template_part( 'content', 'none' );
    		endif;
            if($index !=  1 ) { ?>
               </div><!--/row-->
            <?php } ?>
           <?php
            $page_numb = max( 1, get_query_var('paged') );
            $max_page = $wp_query->max_num_pages;
            echo bridegroom_pagination( $page_numb, $max_page );
            ?>
        </div> <!-- .site-content -->
    </div> <!-- .col-md-9 -->
    <?php
        if (get_theme_mod( 'blog_sidebar', true )) {
            get_sidebar();
        }
    ?>
    </div> <!-- .row -->
    </div> <!-- .container -->
</section>
<?php get_footer();
