<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if(is_single()){ ?>
        <?php get_template_part( 'post-format/entry-content' ); ?>
    <?php }  ?>
    <div class="featured-wrap">
        <?php if(function_exists('rwmb_meta')){ ?>
            <?php  if ( get_post_meta( get_the_ID(), 'themeum_qoute',true ) ) { ?>
                <div class="entry-quote-post-format">
                    <blockquote>
                        <p><?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute',true )); ?></p>
                        <small><?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute_author',true )); ?></small>
                    </blockquote>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="entry-blog">
      <?php if( !is_single() ){ ?>
        <?php get_template_part( 'post-format/entry-content' ); ?>
        <?php }  ?>
        <?php get_template_part( 'post-format/entry-content-blog' ); ?>
      </div> <!--  /.entry-blog -->
</article> <!--/#post -->
