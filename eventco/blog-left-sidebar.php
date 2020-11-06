<?php 
/**
* Template Name: Blog Grid Leftsidebar 
*/
get_header();?>

<?php get_template_part('lib/sub-header'); ?>

<section id="main" class="page-content">
    <div class="container">
        <div class="row"> 

            <?php get_sidebar(); ?>

            <div id="content" class="site-content col-md-8" role="main">
                <?php
                # Query for FontPage and default template. 
                if (is_front_page()) {
                    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                }else{
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                }
                
                $args = array('post_type' => 'post','paged' => $paged);
                $thequery = new WP_Query($args); 
                $column = get_theme_mod('blog_grid_column', true); ?>

                <div class="row">

                <?php if ( $thequery->have_posts() ) :
                    while ( $thequery->have_posts() ) : $thequery->the_post(); 

                    $audio_link = get_post_meta( get_the_ID(), 'themeum_audio_code',true );
                    $video_id = get_post_meta( get_the_ID(), 'themeum_video',true );
                    $custom_link = get_post_meta( get_the_ID(), 'themeum_link',true ); ?>

                    <div class="content-wrap-section col-sm-6">
                        <div class="eventco-grid-post">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <div class="eventco-thumb">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('eventco-blog', array('class' => 'img-responsive')); ?></a>
                                </div>
                            <?php }elseif ($audio_link == true) { ?>
                                <div class="entry-audio embed-responsive embed-responsive-16by9">
                                    <?php echo get_post_meta( get_the_ID(), 'themeum_audio_code',true ); ?>
                                </div>
                            <?php } elseif ($video_id == true) { ?>
                                <div class="eventco-thumb">
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
                            <?php }elseif ($custom_link == true) { ?>
                                 <div class="eventco-thumb">
                                    <div class="eventco-blog-wrap-link">
                                        <?php if(function_exists('rwmb_meta') && get_post_meta( get_the_ID(), 'themeum_link',true )){ ?>
                                        <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="blog-details-img">
                                            <?php the_post_thumbnail('eventco-large', array('class' => 'img-fluid')); ?>
                                            <div class="thm-format-link d-flex align-items-center justify-content-center">
                                                <span><?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?></span>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="entry-link-post-format d-flex align-items-center justify-content-center">
                                            <h4>
                                                <?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?>
                                            </h4>
                                        </div>
                                        <?php endif; ?>

                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="entry-headder">
                                <?php if (get_theme_mod('blog_date', true)): ?>
                                    <!-- Date Time -->
                                    <div class="date">
                                        <i class="fa fa-clock-o"></i>
                                        <?php $the_date = get_the_date(); ?>
                                        <?php echo date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?>
                                    </div>   
                                <?php endif ?>
                                
                                <!-- BLog Title -->
                                <h2 class="entry-title blog-entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </h2>

                                <!-- Post Content -->
                                <?php get_template_part( 'post-format/entry-content' ); ?> 

                                <div class="thm-post-meta">
                                    <ul>
                                        <?php if (get_theme_mod('blog_author', true)): ?>
                                            <li class="author-by">
                                                <i class="fa fa-user"></i>
                                                <span class="author"> <?php the_author_posts_link() ?></span> 
                                            </li>
                                        <?php endif ?>
                                        
                                        <?php if(get_theme_mod('blog_comments', true)) : ?>
                                            <li class="comments">
                                                <i class="fa fa-comments"></i>
                                                <?php comments_number( '0', '1', '%' ); ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(get_theme_mod('blog_category', true)) : ?>
                                            <li class="cat-list">
                                                <?php if(get_the_category_list()) : ?>
                                                    <i class="fa fa-folder-open-o"></i>
                                                <?php endif; ?>
                                                <?php printf(esc_html__('%s', 'eventco'), get_the_category_list(', ')); ?>
                                            </li> 
                                        <?php endif; ?>      
                                        <?php if(get_theme_mod('blog_tag', true)) : ?>
                                            <li class="tag-list">
                                                <?php if(get_the_tag_list()) : ?>
                                                    <i class="fa fa-tags"></i>
                                                <?php endif; ?>
                                                <?php echo get_the_tag_list('',', ',''); ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                                
                                <?php 
                                    if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                                        if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                                            $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                                            echo '<p class="wrap-btn-style"><a class="thm-btn" href="'.get_permalink().'">'. $continue .'<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>';

                                        } 
                                    }
                                ?>

                            </div>
                            
                        </div>
                    </div>
                    
                <?php endwhile;
                else:
                    get_template_part( 'post-format/content', 'none' );
                endif; ?>
                </div>

                <?php 
                    $page_numb = max( 1, get_query_var('paged') );
                    $max_page = $thequery->max_num_pages;
                    eventco_pagination($page_numb, $max_page); 
                ?>
            </div>

        </div>
    </div><!-- .container -->
</section> 

<?php get_footer();