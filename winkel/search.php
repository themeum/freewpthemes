<?php get_header(); ?>
    <section id="main" class="generic-padding">
        <?php get_template_part('lib/sub-header')?>
        <div class="container">
            <div class="row">
                <div id="content" class="site-content col-sm-12" role="main">
                <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array('post_type' => 'post','paged' => $paged);
                    $thequery = new WP_Query($args);
                    $col = get_theme_mod( 'blog_column', 4 );
                    if(count($thequery)>0){ ?>
                        <div class="row">
                            <?php
                            if ( $thequery->have_posts() ) :
                            while ( $thequery->have_posts() ) : $thequery->the_post(); ?>
                                <div class="separator-wrapper col-md-<?php echo esc_attr($col);?>">
                                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                            <?php endwhile;
                            endif;
                            ?>
                        </div><!--/row--> 
                    <?php  }
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $thequery->max_num_pages;
                        echo winkel_pagination( $page_numb, $max_page ); 
                    ?>
                </div><!-- content -->
            </div>
        </div> <!-- .container --> 
    </section> <!-- #main -->
<?php get_footer();