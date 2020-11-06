<?php get_header(); ?>
    <section id="main" class="generic-padding">
        <?php get_template_part('lib/sub-header')?>
        <div class="container">
            <div class="row">
                <div id="content" class="site-content col-sm-12" role="main">
                    <?php
                        $col = get_theme_mod( 'blog_column', 12 );?>
                        <div class="row">
                            <?php
                            if ( have_posts() ) :
                            while ( have_posts() ) : the_post(); ?>
                                <div class="separator-wrapper col-md-<?php echo esc_attr($col);?>">
                                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                            <?php endwhile;
                            endif;
                            ?>
                        </div><!--/row--> 
                        <?php 
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $wp_query->max_num_pages;
                        echo wp_kses_post(mythos_pagination( $page_numb, $max_page ));  
                    ?>
                </div><!-- content -->
            </div>
        </div> <!-- .container --> 
    </section> <!-- #main -->
<?php get_footer();