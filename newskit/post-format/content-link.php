<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('newskit-post newskit-single-post single-content-flat'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('newskit-post newskit-single-post newskit-index-post'); ?>>
<?php endif; ?>
    <?php if(!is_single()) : ?>
    <div class="blog-details-img">
        <?php if(function_exists('rwmb_meta')){ ?>
            <?php  if ( get_post_meta( get_the_ID(), 'themeum_link',true ) ) { ?>
            <div class="entry-link-post-format">
                <h4><?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?></h4>
            </div>
            <?php } ?>
        <?php } ?>
        <?php get_template_part( 'post-format/social-buttons' ); ?>
    </div>
    <?php endif; ?>

    <div class="newskit-blog-content clearfix">
        <?php if (is_single()) { ?>
            <div class="thm-post-top"> 
                <!-- Content Single Top -->
                <?php get_template_part( 'post-format/content-single-top' ); ?>
                
                <div class="newskit-single-page-thumb">
                    <?php if(function_exists('rwmb_meta')){ ?>
                        <?php  if ( get_post_meta( get_the_ID(), 'themeum_link',true ) ) { ?>
                        <div class="entry-link-post-format">
                            <h4><?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?></h4>
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
