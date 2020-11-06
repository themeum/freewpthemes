<article id="post-<?php the_ID(); ?>" <?php post_class('blog-list'); ?>> 

    <div class="entry-header text-center">
        <span class="post-icon"><i class="fa fa-picture-o"></i></span>
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


    <div class="featured-wrap">
        <div class="entry-content-gallery">
            <?php if(function_exists('rwmb_meta')){ ?>
                <?php $slides = get_post_meta( get_the_ID(),'themeum_gallery_images',false); ?>
                    <?php if(count($slides) > 0) { ?>
                        <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php $slide_no = 1; ?>
                                <?php foreach( $slides as $slide ) { ?>
                                <div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                                    <?php $images = wp_get_attachment_image_src( $slide, 'large' ); ?>
                                    <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php  esc_html_e( 'image', 'personalblog' ); ?>">
                                </div>
                                <?php $slide_no++; ?>
                                <?php } ?>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-left" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right carousel-right" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                <?php } ?>
            <?php } ?>
        </div><!--/.entry-content-gallery-->
    </div>

    <?php get_template_part( 'post-format/entry-content-blog' ); ?>

</article> <!--/#post -->
