<?php
/*
 * Template Name: Page Full Width with SubHeader
 */
get_header(); ?>
<section id="main">
   <?php get_template_part('lib/sub-header'); ?>
        <div id="content" class="site-content" role="main">
            <?php while ( have_posts() ): the_post(); ?>
                <div id="post-<?php the_ID(); ?>">
                    <div class="entry-content clearfix">
                        <?php the_content(); ?>
                        <?php
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'crowdfunding' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) ); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div><!--/#content-->
</section><!--/#main-->
<?php get_footer();
