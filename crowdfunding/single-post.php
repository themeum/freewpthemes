<?php get_header(); 
global $themeum_options;
?>

<?php if( isset($themeum_options['blog-single-style']) &&  ($themeum_options['blog-single-style']=='classic') ): ?>

    <?php get_template_part( 'lib/sub-header' ); ?>
    <!-- Classic Design Single Post -->
    <div id="content" class="site-content classic-design" role="main">
        <?php if ( have_posts() ) :  ?> 
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="container">
                    <?php
                        if ( has_post_thumbnail() && ! post_password_required() ){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
                            echo '<div class="image">';
                                echo '<img src="'.$image[0].'" class="img-responsive">';
                            echo '</div>';
                        }
                        echo '<div class="single-post-date">'.get_the_date("d F Y").'</div>';
                        echo '<h1 class="single-post-title">'.get_the_title().'</h1>';
                            
                        echo '<div class="single-post-meta-content">';
                        if (isset($themeum_options['blog-author']) && $themeum_options['blog-author'] ) {
                            echo '<p>'._e("# ", "crowdfunding").' <strong>'.the_author_posts_link().'</strong></p>';
                        }
                    ?>
                    <?php get_template_part( 'post-format/template/single-meta-data' ); ?>
                    <?php  echo '</div>'; ?>
                    <div class="entry-summary">
                        <?php if ( is_single() ) {
                            the_content();
                        }
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'crowdfunding' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) ); ?>
                    </div> <!-- //.entry-summary -->

                    <?php  
                        if (isset($themeum_options['blog-social']) && $themeum_options['blog-social'] ){
                            if(is_single()) {
                                get_template_part( 'post-format/social-buttons' );
                            }
                        } 
                    ?>
                    <?php get_template_part( 'post-format/user-profile' ); ?>
                    <?php
                        if ( comments_open() || get_comments_number() ) {
                            if ( isset($themeum_options['blog-single-comment-en']) && $themeum_options['blog-single-comment-en'] ) {
                               comments_template();
                            }
                        }
                    ?>
                </div>
            <?php endwhile; ?>    
        <?php else: ?>
            <?php get_template_part( 'post-format/content', 'none' ); ?>
        <?php endif; ?>
    </div>
<?php else: ?>
    <!-- Classic Design Single Post -->
    <div id="content" class="site-content modern-design" role="main">
        <?php if ( have_posts() ) :  ?> 
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                <div class="container">
                    <div class="entry-summary">
                        <?php if ( is_single() ) {
                            the_content();
                        }
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'crowdfunding' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) ); ?>
                    </div> <!-- //.entry-summary -->
                    <?php get_template_part( 'post-format/user-profile' ); ?>
                    <?php
                        if ( comments_open() || get_comments_number() ) {
                            if ( isset($themeum_options['blog-single-comment-en']) && $themeum_options['blog-single-comment-en'] ) {
                               comments_template();
                            }
                        }
                    ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <?php get_template_part( 'post-format/content', 'none' ); ?>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
<?php endif; ?>
       
<?php get_footer();