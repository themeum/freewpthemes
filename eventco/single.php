<?php get_header(); ?>

    <!-- SubHeader disable Option -->
    <?php $disable_subheader = get_post_meta( get_the_ID(), 'themeum_disable_subheader', true ); ?>
    <?php if (empty($disable_subheader)): ?>   
        <?php get_template_part('lib/sub-header'); ?>
    <?php endif ?>
    <!-- End Loop -->

    <section id="main" class="page-content">
        <div class="container">
            <div class="row">

            <?php
                $s_col = '12';
                if(get_theme_mod('blog_single_sidebar', true)) {
                    $s_col = '8';
                }
            ?>

                <div id="content" class="site-content col-md-<?php echo esc_attr($s_col); ?> blog-content-wrapper" role="main">
                    <?php if ( have_posts() ) :  ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>

                            <?php if(get_theme_mod('blog_single_author', false)):  ?>
                                <div class="eventco-single-post-author clearfix">
                                    <?php echo get_avatar( $post, 60 ); ?>
                                    <div class="eventco-author-meta-data">
                                        <strong><?php echo get_the_author_meta('display_name'); ?></strong>
                                        <?php echo wpautop(get_the_author_meta('description')); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="entry-content entry-content-page  clearfix">
                                <?php
                                    wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'eventco' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                    ) ); 
                                ?>
                            </div>
                            <?php
                                if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
                                    if ( comments_open() || get_comments_number() ) {
                                        comments_template();
                                    }
                                }
                            ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <?php get_template_part( 'post-format/content', 'none' ); ?>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div> <!-- #content -->
                <?php if(get_theme_mod('blog_single_sidebar', true)) {
                    get_sidebar( );
                }  ?>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #main -->

<?php get_footer();
