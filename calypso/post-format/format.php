<?php


$post_format = get_post_format( get_the_id() );
#audio post
if(function_exists('rwmb_meta') && $post_format == 'audio') :  ?>
    <div class="blog-details-img">
        <?php  if ( get_post_meta( get_the_ID(), 'themeum_audio_code',true ) ) { ?>
            <div class="entry-audio embed-responsive embed-responsive-16by9">
                <?php echo get_post_meta( get_the_ID(), 'themeum_audio_code',true ); ?>
            </div> <!--/.audio-content -->
        <?php } ?>
    </div>
<?php elseif(function_exists('rwmb_meta') && $post_format == 'video') : ?>
    <div class="blog-details-img">
        <?php  if ( get_post_meta( get_the_ID(), 'themeum_video',true ) ) { ?>
            <div class="entry-video embed-responsive embed-responsive-16by9">
                <?php $video_source = esc_attr(get_post_meta( get_the_ID(), 'themeum_video_source',true )); ?>
                <?php $video = get_post_meta( get_the_ID(), 'themeum_video',true ); ?>
                <?php if($video_source == 1): ?>
                    <?php echo get_post_meta( get_the_ID(), 'themeum_video',true ); ?>
                <?php elseif ($video_source == 2): ?>
                    <?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
                <?php elseif ($video_source == 3): ?>
                    <?php echo '<div class="embed-responsive embed-responsive-16by9"><iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'; ?>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>
<?php elseif(function_exists('rwmb_meta') && $post_format == 'link') : ?>
    <div class="featured-wrap-link blog-details-img" style="background-image: url(<?php echo esc_url($media_url); ?>);">
        <?php  if ( get_post_meta( get_the_ID(), 'themeum_link',true ) ) { ?>
        <div class="entry-link-post-format">
            <h4><?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?></h4>
        </div>
        <?php } ?>
    </div>
<?php elseif(function_exists('rwmb_meta') && $post_format == 'gallery'): ?>
    <div class="featured-wrap blog-details-img">
        <div class="entry-content-gallery">
            <?php $slides = get_post_meta( get_the_ID(),'themeum_gallery_images',false); ?>
                <?php if(count($slides) > 0) { ?>
                    <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php $slide_no = 1; ?>
                            <?php foreach( $slides as $slide ) { ?>
                            <div class="carousel-item <?php if($slide_no == 1) echo 'active'; ?>">
                                <?php //$images = wp_get_attachment_image_src( $slide, 'calypso-large' ); ?>

                                <?php
                                    $col = get_theme_mod( 'blog_column', 4 );
                                    if ($col == 3) {
                                        $images = wp_get_attachment_image_src( $slide, 'calypso-blog' );
                                    }elseif ($col == 4) {
                                        $images = wp_get_attachment_image_src( $slide, 'calypso-blog' );
                                    }else{
                                        $images = wp_get_attachment_image_src( $slide, 'calypso-large' );
                                    }
                                ?>
                                <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php  esc_html_e( 'image', 'calypso' ); ?>">
                            </div>
                            <?php $slide_no++; ?>
                            <?php } ?>
                        </div>
                        <!-- Controls -->
                        <a class="carousel-control-prev" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                        <a class="carousel-control-next" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next"><i class="fa fa-angle-right"></i></a>
                    </div>
            <?php } ?>
        </div><!--/.entry-content-gallery-->
    </div>
<?php elseif(function_exists('rwmb_meta') && $post_format == 'quote'): ?>
    <div class="blog-details-img">
        <div class="featured-wrap-quite">
            <?php  if ( get_post_meta( get_the_ID(), 'themeum_qoute',true ) ) { ?>
                <div class="entry-quote-post-format">
                    <span class="blog-content-quote"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
                    <blockquote>
                        <h2><?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute',true )); ?></h2>
                        <span>&nbsp; <i class="fa fa-minus" aria-hidden="true"></i> &nbsp;<?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute_author',true )); ?></span>
                    </blockquote>
                </div>
            <?php } ?>
        </div>
    </div>
<?php else: ?>
    <?php if ( has_post_thumbnail() ){ ?>
        <div class="blog-details-img">
            <?php
                $col = get_theme_mod( 'blog_column', 4 );

                if(is_single()){
                    the_post_thumbnail('calypso-large', array('class' => 'img-fluid')); 
                }elseif($col > 6){ ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('calypso-large', array('class' => 'img-fluid')); ?>
                    </a>
                <?php }else{ ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('calypso-blog', array('class' => 'img-fluid')); ?>
                    </a>
                <?php

                }
            ?>
        </div>
    <?php } 
endif;

?>