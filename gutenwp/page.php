<?php get_header(); ?>
<section id="main" class="gutenwp-overlay-cont page-content">

    <!-- SubHeader disable Option -->
    <?php $disable_subheader = get_post_meta( get_the_ID(), 'themeum_disable_subheader', true ); ?>
    <?php if (empty($disable_subheader)): ?>   
        <?php get_template_part('lib/sub-header')?>
    <?php endif ?>
    <!-- End Loop -->

    <div class="container">
        <div id="content" class="site-content" role="main">
            <?php while ( have_posts() ): the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                <div class="row">
                    <div class="entry-thumbnail col-md-12">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="entry-content entry-content-page  clearfix">
                <?php
                    the_content();
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gutenwp' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) ); 
                ?>
            </div>
            <?php
                # If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                 comments_template();
                endif;
            ?>
        </div>
        <?php endwhile; ?>
        </div> <!--/#content-->
    </div>
</section> <!--/#main-->
<?php get_footer();
