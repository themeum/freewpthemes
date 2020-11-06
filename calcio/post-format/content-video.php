<?php 
    global $count; 
    $blog_style = get_theme_mod( 'blog_style', 6 );
    $video_icon = get_parent_theme_file_uri( 'images/video-icon.png' );
    $post_type  = get_post_format( $post->ID );
    $output     = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix row'); ?>>
    <?php 
    if( is_single() ){
        get_template_part( 'post-format/entry-content' );
    }
    
    if(function_exists('rwmb_meta')){
        if ( get_post_meta( get_the_ID(), 'themeum_video',true ) ) {
            if(is_single() || $count == 2 || $blog_style == 6) { ?>
                <div class="entry-video entry-post-icon embed-responsive embed-responsive-16by9">
            <?php } else { ?>
                <div class="entry-video embed-responsive embed-responsive-16by9 col-xs-3 post-video-small">
            <?php } ?>
                <?php
                    $video_source = esc_attr(get_post_meta( get_the_ID(), 'themeum_video_source',true ));
                    $video = get_post_meta( get_the_ID(), 'themeum_video',true );
                    if($video_source == 1): 
                        echo get_post_meta( get_the_ID(), 'themeum_video',true );
                    elseif ($video_source == 2):
                        echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; 
                    elseif ($video_source == 3): 
                        echo '<div class="embed-responsive embed-responsive-16by9"><iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'; 
                    endif;
                
                    if($post_type == 'gallery'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-picture-o"></i></a></span>';
                    }elseif($post_type == 'audio'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-volume-up"></i></a></span>';
                    }elseif($post_type == 'video'){
                        print $output .='<div class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-file-text-o"></i></a></div>';
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
        <?php }
    } ?>
    <!-- image Thumbnail -->

    <?php if(is_single() || $count == 2 ) { ?>
        <div class="entry-blog post-style-top">
        <?php } else{ ?>
        <?php if($blog_style == 6) { ?>
            <div class="entry-blog">
            <?php }else{ ?>
            <div class="entry-blog col-xs-9">
            <?php }
            }
            if( !is_single() ){
                get_template_part( 'post-format/entry-content' );
            } 
            if(is_single() || $count == 2 || $blog_style == 6) {
                get_template_part( 'post-format/entry-content-blog' );
            } ?>
        </div>
</article><!--/#post-->
