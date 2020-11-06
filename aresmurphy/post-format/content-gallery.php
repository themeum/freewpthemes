<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-item blog-index-post'); ?>>
<?php endif; ?>
        
    <header class="entry-header clearfix">
        <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
            <div class="category-name">
                <?php echo get_the_category_list(', '); ?>
            </div>
        <?php endif; ?>
        <?php
            if (is_single()) {
                the_title( '<h2 class="content-item-title">', '</h2>' );
            } else {
                the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' );
            }
        ?>

        <?php if ( get_theme_mod( 'blog_author', true ) || get_theme_mod( 'blog_category', true ) || get_theme_mod( 'blog_comment', true ) ): ?>
            <ul class="blog-post-meta">
                <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
                    <li class="blog-date-wrapper">
                        <time datetime="<?php echo get_the_date() ?>"><?php echo get_the_date(); ?></time>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_author', true ) ): ?>
                    <li class="meta-author">
                        <?php esc_html_e('BY', 'aresmurphy') ?>
                        <strong><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php echo get_the_author_meta('display_name');?></a></strong>
                    </li>
                <?php endif; ?>
                
            </ul>
        <?php endif; ?>
    </header>

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
                                    <?php $images = wp_get_attachment_image_src( $slide, 'aresmurphy-large' ); ?>
                                    <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="<?php  esc_html_e( 'image', 'aresmurphy' ); ?>">
                                </div>
                                <?php $slide_no++; ?>
                                <?php } ?>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-left" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                                <i class="icon-left"></i>
                            </a>
                            <a class="right carousel-right" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                                <i class="icon-right"></i>
                            </a>
                        </div>
                <?php } ?>
            <?php } ?>
        </div><!--/.entry-content-gallery-->
    </div>
    
    <div class="entry-blog">
        <?php
            get_template_part( 'post-format/entry-content-blog' );
        ?> 
    </div> <!--/.entry-meta -->
</article><!--/#post-->
