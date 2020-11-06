
<?php global $themeum_options; ?>

<?php  $output = '';

if ( has_post_thumbnail() && ! post_password_required() ) 
{ 

    if (is_page_template('blog-masonry-col3.php')) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'sm-blog-thumb' );
    }
    else if (is_page_template('blog-full-width.php')) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-full' );
    }
    else if (is_page_template('blog-left-sidebar.php')) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-thumb' );
    }            
    else if (is_page_template('blog-right-sidebar.php')) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-thumb' );
    }
     else {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-full' );
    }

    $output .='style="background: url('.esc_url($image[0]).') no-repeat;background-size: cover;"'; 

} else {

    $output .='style="background: url('.get_template_directory_uri().'/images/blog.jpg) no-repeat;background-size: cover;"';

}?>
 

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php echo $output; ?>>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="entry-content-wrap">
                    <?php get_template_part( 'post-format/entry-content' ); ?> 
                </div>
            </div>    
        </div>    
    </div>    
</article> <!--/#post-->

<?php if ( is_single() ) { ?>
    <?php  if ( rwmb_meta( 'thm_video' ) ) { ?>
    <div class="all-postformats">
        <div class="container">    
            <div class="entry-video embed-responsive embed-responsive-16by9">
                <?php $video_source = esc_attr(rwmb_meta( 'thm_video_source' )); ?>
                <?php $video = rwmb_meta( 'thm_video' ); ?>
                <?php if($video_source == 1): ?>
                    <?php echo esc_url(rwmb_meta( 'thm_video' )); ?>
                <?php elseif ($video_source == 2): ?>
                    <?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
                <?php elseif ($video_source == 3): ?>
                    <?php echo '<iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="350" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php } 
} ?>   
