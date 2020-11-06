<?php get_header();?>

<div id="content" class="site-content">
    <section id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php get_template_part('lib/sub-header'); 
            while( have_posts() ): the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>    
                <?php
                    # category list
                    $terms2 = get_the_terms(  get_the_ID(), 'portfolio-cat' );
                    $term_name2 = '';
                    if (is_array( $terms2 )){
                        foreach ( $terms2 as $term2 )
                        {
                            $term_name2 .= $term2->slug.', ';
                        }
                    }
                    $term_name2 = substr($term_name2, 0, -2);
                ?>
                <div class="entry-content">                
                    <?php the_content(); ?>
                </div>  <!-- entry-content -->
            </article>
            <?php endwhile;?>
        </main><!-- #main -->
    </section><!-- #primary -->
</div><!-- .site-content -->

<?php get_footer();