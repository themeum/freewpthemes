<?php
/*
 * Template Name: Page Full Width
 */
get_header(); ?>
<?php get_template_part('lib/sub-header')?>

<section id="content" class="site-content">
    <div id="primary" class="content-area" role="main">
        <main id="main" class="site-main">
            <?php /* The loop */ ?>
            <?php while ( have_posts() ): the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </main><!-- #main -->
    </div> <!--/#content-->
</section> <!--/#main-->
    
<?php get_footer();