<?php global $themeum_options; ?>

<?php 

$output = '';

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



