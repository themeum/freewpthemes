<article id="post-<?php the_ID(); ?>" <?php post_class('blog-list'); ?>> 

    <div class="entry-header text-center">
        <span class="post-icon"><i class="fa fa-video-camera"></i></span>
        <?php if ( is_single() ) { ?>
            <h1 class="entry-title blog-entry-title">
                <?php the_title(); ?>
                <?php if ( is_sticky() && is_home() && ! is_paged()) { ?>
                <span class="featured-post"><i class="fa fa-star"></i></span>
                <?php } ?>                
            </h1> <!-- //.entry-title --> 
        <?php } else { ?>
            <h2 class="entry-title blog-entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                <?php if ( is_sticky() && is_home() && ! is_paged()) { ?>
                <span class="featured-post"><i class="fa fa-star"></i></span>
                <?php } ?>
            </h2>
        <?php }?>
        <ul class="blog-post-meta">     
            <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
                <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></li>
            <?php } else { ?>
                <li><?php the_author_posts_link() ?> </li>
            <?php }?>
            <li><a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('j F Y') ?>"><?php echo get_the_date('j F Y'); ?></time></a></li>
            <li><?php echo get_the_category_list(' '); ?></li>
        </ul>     
    </div>
    
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

    <?php get_template_part( 'post-format/entry-content-blog' ); ?>

</article> <!--/#post -->
