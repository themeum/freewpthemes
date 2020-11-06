<?php get_header(); ?>
    <section id="main" class="page-content">
        <?php get_template_part('lib/sub-header')?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="search-title"><?php printf( __( 'Search Results for: %s', 'gutenwp' ), get_search_query() ); ?></h1>
                </div>

                <div id="content" class="site-content col-md-12 guten-blog-default" role="main">
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
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $wp_query->max_num_pages;
                        echo gutenwp_pagination( $page_numb, $max_page );
                    ?>
                </div>


            </div>
        </div> <!-- .container -->
    </section> <!-- #main -->
<?php get_footer();
