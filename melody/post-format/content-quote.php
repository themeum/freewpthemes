<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('melody-post melody-single-post single-content-flat'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('melody-post melody-single-post melody-index-post'); ?>>
<?php endif; ?>
    <?php if(!is_single()) : ?>
    <div class="blog-details-img quote-not-single">
        <?php if(function_exists('rwmb_meta')){ ?>
            <?php  if ( get_post_meta( get_the_ID(), 'themeum_qoute',true ) ) { ?>
                <div class="entry-quote-post-format">
                    <span class="blog-content-quote"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
                    <blockquote>
                        <h2><?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute',true )); ?></h2>
                        <span>&nbsp; <i class="fa fa-minus" aria-hidden="true"></i> &nbsp;<?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute_author',true )); ?></span>
                    </blockquote>
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
                        <?php  if ( get_post_meta( get_the_ID(), 'themeum_qoute',true ) ) { ?>
                            <div class="entry-quote-post-format">
                                <span class="blog-content-quote"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
                                <blockquote>
                                    <h2><?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute',true )); ?></h2>
                                    <span>&nbsp; <i class="fa fa-minus" aria-hidden="true"></i> &nbsp;<?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute_author',true )); ?></span>
                                </blockquote>
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
