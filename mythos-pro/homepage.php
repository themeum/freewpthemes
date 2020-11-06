<?php
/*
 * Template Name: Homepage Default
 */
get_header(); ?>

<div id="content" class="site-content">
    <section id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php /* The loop */ ?>
            <?php while ( have_posts() ): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </main><!-- #main -->
    </section><!-- #primary -->
</div><!-- .site-content -->
    
<?php get_footer();