<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('newskit-post newskit-single-post single-content-flat'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('newskit-post newskit-single-post newskit-index-post'); ?>>
<?php endif; ?>
    <?php if(!is_single()) : ?>
    <div class="blog-details-img">
        <?php if(function_exists('rwmb_meta')){ ?>
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
        <?php } ?>
        <?php get_template_part( 'post-format/social-buttons' ); ?>
    </div>
    <?php endif; ?>

    <div class="newskit-blog-content clearfix">
        <?php if (is_single()) { ?>
            <div class="thm-post-top"> 
                <!-- Content Single Top -->
                <?php get_template_part( 'post-format/content-single-top' ); ?>
                
                <div class="newskit-single-page-thumb">
                    <?php if(function_exists('rwmb_meta')){ ?>
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
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="entry-blog">
                        <?php
                            get_template_part( 'post-format/entry-content-blog' );
                        ?>
                    </div> <!--/.entry-meta -->
                </div>
            </div>
        <?php } ?>
        <!-- Content Single Bottom -->
        <?php get_template_part( 'post-format/content-single-bottom' ); ?>
        
        <?php if(get_theme_mod( 'blog_read_more', false )) { ?>
            <?php if(!is_single()){ ?>
            <?php if ( get_theme_mod( 'blog_continue_en', true ) ) {  ?>
             <?php   if ( get_theme_mod( 'blog_continue', 'Read More' ) ) { ?>
                  <?php  $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                    echo '<p><a class="btn btn-read-more" href="'.get_permalink().'">'. $continue .'</a></p>';?>
              <?php  } ?>
            <?php } ?>
            <?php }?>
        <?php }?>
    </div>
</article><!--/#post-->
