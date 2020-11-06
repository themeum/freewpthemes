<?php global $themeum_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bridegroom-post themeum-grid-post'); ?>>
    <?php if (!is_single()) { ?>
        <div class="row">
            
            <div class="content-wrap-section col-sm-10">
                <div class="bridegroom-thumb">
                    <?php if(function_exists('rwmb_meta')){ ?>
                        <?php  if ( get_post_meta( get_the_ID(), 'themeum_video',true ) ) { ?>
                        <div class="entry-video embed-responsive embed-responsive-16by9">
                            <?php $video_source = esc_attr(get_post_meta( get_the_ID(), 'themeum_video_source',true )); ?>
                            <?php $video = get_post_meta( get_the_ID(), 'themeum_video',true ); ?>
                            <?php if($video_source == 1): ?>
                            <?php echo get_post_meta( get_the_ID(), 'themeum_video',true ); ?>
                            <?php elseif ($video_source == 2): ?>
                            <?php echo '<iframe width="100%" height="350" src="https://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
                            <?php elseif ($video_source == 3): ?>
                            <?php echo '<div class="embed-responsive embed-responsive-16by9"><iframe src="https://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'; ?>
                            <?php endif; ?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="entry-headder">
                    <?php if (get_theme_mod('blog_date', true)): ?>
                        <!-- Date Time -->
                        <div class="date">
                            <?php $the_date = get_the_date(); ?>
                            <?php echo date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?>
                        </div>   
                    <?php endif ?>

                     <div class="thm-post-meta">
                        <ul>

                            <?php if (get_theme_mod('blog_author', false)): ?>
                                <li class="author-by">
                                    <i class="fa fa-user"></i>
                                    <span class="author"> <?php the_author_posts_link() ?></span> 
                                </li>
                            <?php endif ?>
                            
                            <?php if(get_theme_mod('blog_comments', false)) : ?>
                                <li class="comments">
                                    <i class="fa fa-comments"></i>
                                    <?php comments_number( '0', '1', '%' ); ?>
                                </li>
                            <?php endif; ?>
                            <?php if(get_theme_mod('blog_category', false)) : ?>
                                <li class="cat-list">
                                    <?php if(get_the_category_list()) : ?>
                                        <i class="fa fa-folder-open-o"></i>
                                    <?php endif; ?>
                                    <?php printf(esc_html__('%s', 'bridegroom'), get_the_category_list(', ')); ?>
                                </li> 
                            <?php endif; ?>      
                            <?php if(get_theme_mod('blog_tag', false)) : ?>
                                <li class="tag-list">
                                    <?php if(get_the_tag_list()) : ?>
                                        <i class="fa fa-tags"></i>
                                    <?php endif; ?>
                                    <?php echo get_the_tag_list('',', ',''); ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    
                    <!-- BLog Title -->
                    <h2 class="entry-title blog-entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>
                </div>
                
                <!-- Post Content -->
                <?php get_template_part( 'post-format/entry-content' ); ?> 
                
                <?php 
                    if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                        if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                            $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                            echo '<p class="wrap-btn-style"><a class="thm-btn" href="'.get_permalink().'">'. $continue .'<i class="fa fa-angle-right" aria-hidden="true"></i></a></p>';

                        } 
                    }
                ?>

            </div>
        </div>
    <?php } else { ?>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    <?php }  ?>
</article> <!--/#post-->
