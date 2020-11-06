<?php if (is_single()) { ?>

<?php 
# Meta Data Call.
$custom_link    = get_post_meta( get_the_ID(), 'themeum_link',true );
$quote          = get_post_meta( get_the_ID(), 'themeum_qoute',true );
$video_id       = get_post_meta( get_the_ID(), 'themeum_video',true );
$audio_link     = get_post_meta( get_the_ID(), 'themeum_audio_code',true );
$slides         = get_post_meta( get_the_ID(),'themeum_gallery_images',false);

?>

    <h2 class="entry-title blog-entry-title"><?php the_title(); ?></h2>
    <div class="thm-post-meta">
        <ul>
            <?php if (get_theme_mod('blog_single_author', true)) { ?>
                <li class="author-by">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ) , 35 );?>
                    <span class="author">By <?php the_author_posts_link() ?></span> 
                </li>
            <?php } ?>
            <?php if (get_theme_mod('blog_single_date', true)) { ?>
                <li class="date-by">
                    <?php $the_date = get_the_date(); ?>
                    <?php echo date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?>
                </li>
            <?php } ?>
            <?php if (get_theme_mod('blog_single_comment', true)) { ?>
            <li class="comments">
                <i class="fa fa-comments"></i>
                <?php comments_number( '0', '1', '%' ); ?>
            </li>
            <?php } ?>
            <?php if (get_theme_mod('blog_single_category', true)) { ?>
            <li class="cat-list">
                <?php if(get_the_category_list()) : ?>
                    <i class="fa fa-folder-open-o"></i>
                <?php endif; ?>
                <?php printf(esc_html__('%s', 'bridegroom'), get_the_category_list(', ')); ?>
            </li> 
            <?php } ?>
            <?php if (get_theme_mod('blog_single_tag', true)) { ?>
            <li class="tag-list">
                <?php if(get_the_tag_list()) : ?>
                    <i class="fa fa-tags"></i>
                <?php endif; ?>
                <?php echo get_the_tag_list('',', ',''); ?>
            </li>
            <?php } ?>
        </ul>
    </div>


    <?php if($custom_link == true) { ?>
        <div class="bridegroom-thumb">
            <div class="bridegroom-blog-wrap-link">
                <?php if(function_exists('rwmb_meta') && get_post_meta( get_the_ID(), 'themeum_link',true )){ ?>
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="blog-details-img">
                    <?php the_post_thumbnail('bridegroom-large', array('class' => 'img-fluid')); ?>
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
    <?php } elseif ($quote  == true) { ?>
            <div class="bridegroom-blog-wrap-quite">
                <?php if(function_exists('rwmb_meta')){ ?>
                    <blockquote>
                        "
                        <?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute',true )); ?> "
                        <span class="author">--<?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute_author',true )); ?></span>
                    </blockquote>
                <?php } ?>
            </div>
    <?php }elseif ($video_id == true) { ?>
        <div class="bridegroom-thumb">
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
    <?php }elseif ($slides == true) { ?>
        <div class="bridegroom-blog-wrap blog-details-img ">
            <div class="entry-content-gallery">
                <?php if(function_exists('rwmb_meta')){ ?>
                <?php $slides = get_post_meta( get_the_ID(),'themeum_gallery_images',false); ?>
                <?php if(count($slides) > 0) { ?>
                <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php $slide_no = 1; ?>
                        <?php foreach( $slides as $slide ) { ?>
                        <div class="carousel-item <?php if($slide_no == 1) echo 'active'; ?>">
                            <?php $images = wp_get_attachment_image_src( $slide, 'bridegroom-large' ); ?>
                            <img class="AA img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php  esc_html_e( 'image', 'bridegroom' ); ?>">
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
        </div>
    <?php }else{ ?>
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="bridegroom-blog-wrap">
                <?php the_post_thumbnail('bridegroom-large', array('class' => 'img-responsive')); ?>
            </div>
        <?php } ?>
    <?php } ?>

    <!-- BLog Title -->
    
    
<?php } ?>


<div class="entry-summary clearfix">
    <?php 
        if ( ! is_single() ) {
            if ( get_theme_mod( 'blog_intro_en', true ) ) { 
                if ( get_theme_mod( 'blog_post_text_limit', 280 ) ) {
                    $textlimit = get_theme_mod( 'blog_post_text_limit', 280 );
                    echo bridegroom_excerpt_max_charlength($textlimit);
                } else {
                    the_content();
                }
                
            }
        }else{
            the_content();
        }
    ?>
    <?php if(is_single()) { ?>
        <div class="bridegroom-intro-cat">
            <div class="row">
                <div class="col-md-6">
                    <div class="bridegroom-cat">
                        <?php _e('Category: ', 'bridegroom'); ?>
                        <?php echo get_the_category_list(', '); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bridegroom-social">
                        <?php get_template_part( 'post-format/social-buttons' ); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div> <!-- Entry Summary -->



