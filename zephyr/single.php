<?php get_header(); ?>
    <section id="main">
    <?php get_template_part('lib/sub-header'); ?>
        <div class="container single-wrapper-content">
            <div class="row">
                
                <div id="content" class="site-content col-md-12 blog-content-wrapper" role="main">
                    <?php if ( have_posts() ) :  ?> 
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>   
                        <?php endwhile; ?>    
                    <?php else: ?>
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div> <!-- #content -->

                <!-- Blog next/pre post -->
                <div class="col-md-12">
                    <div class="blog-change-arrow-section">
                        <div class="row">
                            <div class="blog-post-review-pre col-md-6">
                                <?php $prev_posts = get_previous_post(); ?>
                                <?php if (!empty( $prev_posts )): ?>
                                    <a href="<?php echo get_permalink( $prev_posts->ID ); ?>">
                                        <span class="arrow-button-left1">
                                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i> 
                                        </span>

                                        <span class="arrow-button-left">
                                            <p class="prev"><?php esc_html_e('Prev', 'zephyr') ?></p>
                                            <p><?php echo $prev_posts->post_title ?></p>
                                        </span>
                                    </a>
                                <?php endif ?>
                            </div>

                            <div class="blog-post-review-next col-md-6">
                                <?php $next_post = get_next_post();
                                if (!empty( $next_post )): ?>
                                <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                    <span class="arrow-button-right1">
                                        <p class="next"><?php esc_html_e('Next', 'zephyr') ?></p>
                                        <p><?php echo $next_post->post_title; ?></p>
                                    </span>
                                    <span class="arrow-button-right">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    </span>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #main -->
<?php get_footer();