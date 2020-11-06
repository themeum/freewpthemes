<?php

get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php get_template_part('lib/header-content'); ?>
            <?php while ( have_posts() ): the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <?php the_post_thumbnail(); ?>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?php
                            the_content();
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'personalblog' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ) ); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div> <!--/.col-sm-12-->
    </div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer();
