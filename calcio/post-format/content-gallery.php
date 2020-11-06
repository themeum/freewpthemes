

<?php global $count; 
$blog_style = get_theme_mod( 'blog_style', 6 );
$video_icon     = get_parent_theme_file_uri( 'images/video-icon.png' );
    $post_type = get_post_format( $post->ID );
    $output     = '';
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix row'); ?>>

    <?php if( is_single() ){ ?>
        <?php get_template_part( 'post-format/entry-content' ); ?>
    <?php }  ?>
    
    <?php if(is_single() || $count == 2 || $blog_style == 6) {?>
    <div class="featured-wrap col-xs-12">
    <?php } else{ ?>
    <div class="featured-wrap col-md-5 post-quote-small">
    <?php }?>
        <?php if(function_exists('rwmb_meta')){ ?>

                <?php $slides = get_post_meta( get_the_ID(),'themeum_gallery_images',false); ?>
                    <?php if(count($slides) > 0) { ?>
                        <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider entry-post-icon">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php $slide_no = 1; ?>
                                <?php foreach( $slides as $slide ) { ?>
                                <div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                                    <?php $images = wp_get_attachment_image_src( $slide, 'calcio-large' ); ?>
                                    <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php esc_attr_e( 'image', 'calcio' ); ?>">
                                </div>
                                <?php $slide_no++; ?>
                                <?php } ?>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-left" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right carousel-right" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                            
                            <?php 

                                if($post_type == 'gallery'){
                                    print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-picture-o"></i></a></span>';
                                }elseif($post_type == 'audio'){
                                    print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-volume-up"></i></a></span>';
                                }elseif($post_type == 'video'){
                                    print $output .='<div class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-file-text-o"></i></div>';
                                }elseif($post_type == 'quote'){
                                    print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-quote-left"></i></a></span>';
                                }elseif($post_type == 'link'){
                                    print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-link"></i></a></span>';
                                }elseif($post_type == 'image'){
                                    print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-file-image-o"></i></a></span>';
                                }else{
                                    print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-file-text-o"></i></a></span>';
                                }
                            ?>

                        </div>
                <?php } ?>
            <?php } ?>
    </div>
    <!-- image Thumbnail -->

    <?php if(is_single() || $count == 2 ) { ?>
        <div class="entry-blog post-style-top">
        <?php } else{ ?>
        <?php if($blog_style == 6) { ?>
            <div class="entry-blog">
            <?php }else{?>
            <div class="entry-blog col-xs-7">
            <?php }?>
            
            <?php } ?>
            <?php if( !is_single() ){ ?>
                <?php get_template_part( 'post-format/entry-content' ); ?>
            <?php }  ?>
            <?php if(is_single() || $count == 2 || $blog_style == 6) { ?>
            <?php get_template_part( 'post-format/entry-content-blog' ); ?>
            <?php } ?>

        </div>

</article><!--/#post-->


