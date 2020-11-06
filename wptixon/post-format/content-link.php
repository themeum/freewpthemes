<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if(is_single()){ ?>
        <?php get_template_part( 'post-format/entry-content' ); ?>
    <?php }  ?>
    <div class="featured-wrap">
    	<?php if(function_exists('rwmb_meta')){ ?>
	    	<?php  if ( get_post_meta( get_the_ID(), 'themeum_link',true ) ) { ?>
	        <div class="entry-link-post-format">
	            <h4><?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?></h4>
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
