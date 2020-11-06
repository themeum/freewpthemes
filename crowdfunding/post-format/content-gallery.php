
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
    <?php  if ( rwmb_meta('thm_gallery_images','type=image_advanced') ) { ?>
    <div class="all-postformats">
        <div class="container">
            
                <div class="entry-content-gallery">
                    <?php $slides = rwmb_meta('thm_gallery_images','type=image_advanced'); ?>
                    <?php if(count($slides) > 0) { ?>
                    <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php $slide_no = 1; ?>
                            <?php foreach( $slides as $slide ) { ?>
                            <div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                                <?php $images = wp_get_attachment_image_src( $slide['ID'], 'blog-full' ); ?>
                                <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="">
                            </div>
                            <?php $slide_no++ ?>
                            <?php } ?>
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <?php } ?>
                </div><!--/.entry-content-gallery-->
            
        </div>
    </div> 
    <?php } ?>
<?php } ?> 

