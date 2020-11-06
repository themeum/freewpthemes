<?php $post_type  = get_post_format( $post->ID ); ?>
   
<div class="thm-default-postbox">
    <div class="row">
        <div class="col-md-4 blog-default-img">
            <?php if($post_type == 'quote') { ?>

               <?php if(function_exists('rwmb_meta')){ ?>
                    <?php  if ( get_post_meta( get_the_ID(), 'themeum_qoute',true ) ) { ?>
                        <div class="entry-quote-post-format default-quote-format">
                            <span class="blog-content-quote"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
                            <blockquote>
                                <h2><?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute',true )); ?></h2>
                                <span>&nbsp; <i class="fa fa-minus" aria-hidden="true"></i> &nbsp;<?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute_author',true )); ?></span>
                            </blockquote>
                        </div>
                    <?php } ?>
                <?php } ?>

            <?php }elseif($post_type == 'video'){ ?>
            <div class="default-video-post">
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

            <?php }elseif($post_type == 'link'){ ?>
            <div class="default-link-post">
                <?php if(function_exists('rwmb_meta')){ ?>
                    <?php  if ( get_post_meta( get_the_ID(), 'themeum_link',true ) ) { ?>
                    <div class="entry-link-post-format">
                        <h4><?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?></h4>
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>

            <?php } elseif($post_type == 'audio') {?>
                
                <div class="default-audio-post">
                    <?php if(function_exists('rwmb_meta')){ ?>
                        <?php  if ( get_post_meta( get_the_ID(), 'themeum_audio_code',true ) ) { ?>
                            <div class="entry-audio embed-responsive embed-responsive-16by9">
                                <?php echo get_post_meta( get_the_ID(), 'themeum_audio_code',true ); ?>
                            </div> <!--/.audio-content -->
                        <?php } ?>
                    <?php } ?>
                </div>

            <?php } elseif($post_type == 'gallery'){?>
                <div class="default-gallery-post">
                    <?php if(function_exists('rwmb_meta')){ ?>
                        <?php $slides = get_post_meta( get_the_ID(),'themeum_gallery_images',false); ?>
                            <?php if(count($slides) > 0) { ?>
                                <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <?php $slide_no = 1; ?>
                                        <?php foreach( $slides as $slide ) { ?>
                                        <div class="carousel-item <?php if($slide_no == 1) echo 'active'; ?>">
                                            <?php $images = wp_get_attachment_image_src( $slide, 'newskit-large' ); ?>

                                            <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php  esc_attr_e( 'image', 'newskit' ); ?>">
                                        </div>
                                        <?php $slide_no++; ?>
                                        <?php } ?>
                                    </div>
                                    <!-- Controls -->
                                    <a class="carousel-control-prev" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                    <a class="carousel-control-next" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php }else{?>
            <a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url('newskit-large'); ?>); ">
                </a>
            <?php }?>
            
        </div>

        <div class="col-md-8 blog-default-content">
            <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                <ul class="blog-post-meta clearfix secondary-font">
                    <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                        <li class="meta-category"><?php printf(esc_html__('%s', 'newskit'), get_the_category_list(' ')); ?></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
            <h2 class="blog-default-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <?php if ( get_theme_mod( 'blog_comment', true ) || get_theme_mod( 'blog_hit', true ) || get_theme_mod( 'blog_tags', true )): ?>
                <ul class="blog-post-meta-bottom clearfix secondary-font">
                    <?php if ( get_theme_mod( 'blog_author', true ) ) { ?>
                    <li>
                        <div class="blog-author">
                            <a href="<?php the_permalink(); ?>"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></a>
                        </div>
                    </li>
                <?php } ?>
                    <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
                        <li>
                            <div class="blog-date-wrapper">
                                <a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('Y-m-d') ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></time></a>
                            </div>
                        </li>
                    <?php } ?>
                    <?php if ( get_theme_mod( 'blog_hit', true ) ) { ?>
                        <li>   <span>
                            <?php
                                # blog Count Down
                                $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                                if( $visitor_count == '' ){ $visitor_count = 0; }
                                if( $visitor_count >= 1000 ){
                                    $visitor_count = round( ($visitor_count/1000), 2 );
                                    $visitor_count = $visitor_count.'k';
                                }
                                echo '<i class="fa fa-eye" aria-hidden="true"></i>'; ?>
                                <?php echo esc_attr( $visitor_count );
                            ?></span>
                        </li>
                    <?php } ?>
                    <?php if ( get_theme_mod( 'blog_tags', true ) && get_the_tag_list() ) { ?>
                        <li><span><i class="fa fa-tags"></i></span><?php echo get_the_tag_list(' ',', ',''); ?></li>
                    <?php } ?>
                    <?php if ( get_theme_mod( 'blog_comment', true ) ) { ?>
                            <li><span>  <i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_attr_e(' Comments', 'newskit') ?></span></li>
                    <?php } ?>
                </ul>
            <?php endif; ?>

            <?php
                if ( get_theme_mod( 'blog_post_text_limit', 150 ) ) {
                    $textlimit = get_theme_mod( 'blog_post_text_limit', 150 );
                    if (get_theme_mod( 'blog_intro_text_en', true )) {
                        echo newskit_excerpt_max_charlength($textlimit);
                    }
                } else {
                    the_content();
                }
            ?>
        </div>
    </div>
</div>
