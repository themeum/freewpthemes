<?php global $themeum_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('eventco-post themeum-grid-post'); ?>>
    <?php if (!is_single()) { ?>
        <div class="row">
            <?php 
                if ( has_post_thumbnail() ){
                    $col = 'col-sm-7';
                }else {
                    $col = 'col-sm-12';
                } 
            ?>
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="eventco-blog-wrap col-sm-5">

                    <div class="eventco-blog-wrap blog-details-img ">
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
                                        <?php $images = wp_get_attachment_image_src( $slide, 'eventco-blog' ); ?>
                                        <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php  esc_html_e( 'image', 'eventco' ); ?>">
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
                </div>
            <?php } ?>

            <div class="content-wrap-section <?php echo $col;?>">
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
                </div>
                
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
    <?php } else { ?>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    <?php }  ?>
</article> <!--/#post-->

