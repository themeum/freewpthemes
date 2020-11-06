<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if(is_single()){ ?>
        <?php get_template_part( 'post-format/entry-content' ); ?>
    <?php }  ?>
    <div class="featured-wrap">
    <?php if(function_exists('rwmb_meta')){ ?>
        <?php  if ( get_post_meta( get_the_ID(), 'themeum_audio_code',true ) ) { ?>
	        <div class="entry-audio embed-responsive embed-responsive-16by9">
	            <?php echo get_post_meta( get_the_ID(), 'themeum_audio_code',true ); ?>
	        </div> <!--/.audio-content -->
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
