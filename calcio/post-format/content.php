<?php 
    global $count; 

    $blog_style = get_theme_mod( 'blog_style', 6 );

    $post_type = get_post_format( $post->ID );
    $output     = '';

 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix row'); ?>>
 
    <?php if( is_single() ){ ?>
        <?php get_template_part( 'post-format/entry-content' ); ?>
    <?php }  ?>

    <?php if ( has_post_thumbnail() ){ ?>
        <?php if(is_single() || $count == 2) { ?>
            <div class="blog-details-img post-style-top">
        <?php } else{ ?>
            <?php if($blog_style == 6) { ?>
            <div class="blog-details-img">
            <?php }else{?>
            <div class="blog-details-img col-xs-3">
        
            <?php }?>
        <?php } ?>

    
            <?php if( is_single()  || $count == 2 || $blog_style == 6){ ?>
                <div class="post_style_two_icon">
                <?php the_post_thumbnail('calcio-large', array('class' => 'img-responsive')); 
                    if($post_type == 'gallery'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-picture-o"></i></a></span>';
                    }elseif($post_type == 'audio'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-volume-up"></i></a></span>';
                    }elseif($post_type == 'video'){
                        print $output .='<div class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-video-camera"></i></a></div>';
                    }elseif($post_type == 'quote'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-quote-left"></i></a></span>';
                    }elseif($post_type == 'link'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-link"></i></a></span>';
                    }elseif($post_type == 'image'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-file-image-o"></i></a></span>';
                    }else{
                        print $output .='<span class="post-icon"><i class="fa fa-file-text-o"></i></span>';
                    }

                ?>

                </div>
            
            <?php } else { ?>
            <div class="entry-post-icon">
                <a href="<?php the_permalink(); ?>">
                    <?php 
                    the_post_thumbnail('calcio-post-small', array('class' => 'img-responsive'));
                    if($post_type == 'gallery'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-picture-o"></i></a></span>';
                    }elseif($post_type == 'audio'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-volume-up"></i></a></span>';
                    }elseif($post_type == 'video'){
                        print $output .='<div class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-video-camera"></i></a></div>';
                    }elseif($post_type == 'quote'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-quote-left"></i></a></span>';
                    }elseif($post_type == 'link'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-link"></i></a></span>';
                    }elseif($post_type == 'image'){
                        print $output .='<span class="post-icon"><a href="'.get_permalink().'"><i class="fa fa-file-image-o"></i></a></span>';
                    }else{
                        print $output .='<span class="post-icon"><i class="fa fa-file-text-o"></i></span>';
                    }

                    ?>
                </a>
            </div>
            <?php } ?>

        </div>
    <?php }  ?>
    <!-- image Thumbnail -->

    <?php if(is_single() || $count == 2 ) { ?>
        <div class="entry-blog post-style-top">
        <?php } else{ ?>
       
            <?php if($blog_style == 6) { ?>
            <div class="entry-blog">
            <?php }else{?>
            <div class="entry-blog col-xs-9">
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
