<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('melody-post melody-single-post single-content-flat'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('melody-post melody-single-post melody-index-post'); ?>>
<?php endif; ?>
    <?php if(!is_single()) : ?>
    <div class="blog-details-img quote-not-single">
        <?php if(function_exists('rwmb_meta')){ ?>
            <?php $slides = get_post_meta( get_the_ID(),'themeum_gallery_images',false); ?>
                <?php if(count($slides) > 0) { ?>
                    <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php $slide_no = 1; ?>
                            <?php foreach( $slides as $slide ) { ?>
                            <div class="carousel-item <?php if($slide_no == 1) echo 'active'; ?>">
                                <?php $images = wp_get_attachment_image_src( $slide, 'melody-large' ); ?>

                                <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php  esc_attr_e( 'image', 'melody' ); ?>">
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
    <?php endif; ?>

    <div class="melody-blog-content clearfix">
        <?php if (is_single()) { ?>
            <div class="thm-post-top">
                <!-- Content Single Top -->
                <?php get_template_part( 'post-format/content-single-top' ); ?>
                <div class="melody-single-page-thumb">
                    <?php if(function_exists('rwmb_meta')){ ?>
                        <?php $slides = get_post_meta( get_the_ID(),'themeum_gallery_images',false); ?>
                            <?php if(count($slides) > 0) { ?>
                                <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <?php $slide_no = 1; ?>
                                        <?php foreach( $slides as $slide ) { ?>
                                        <div class="carousel-item <?php if($slide_no == 1) echo 'active'; ?>">
                                            <?php $images = wp_get_attachment_image_src( $slide, 'melody-large' ); ?>

                                            <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php  esc_attr_e( 'image', 'melody' ); ?>">
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
