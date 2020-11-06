<?php
/**
* Template Name: Page With Left Sidebar
*/
get_header(); ?>
<div class="container">
    <div class="row">
        <div id="sidebar" class="col-sm-4" role="complementary">
            <aside class="widget-area">
                <?php get_sidebar( );?> 
            </aside>
        </div> <!-- #sidebar -->
        <div class="col-sm-8">
            <div class="content-grid">
                <?php get_template_part('lib/header-content'); ?>
                <div class="site-content" role="main">
                    <?php while ( have_posts() ): the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php endif; ?>
                            <?php
                                the_content();
                                wp_link_pages(); 
                            ?>
                        </div>
                    <?php endwhile; ?>
                </div> <!--/#content-->
            </div> <!-- .content-grid -->
        </div> <!-- .col-sm-8 -->
    </div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer();