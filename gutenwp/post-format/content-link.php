<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if (!is_single()) { ?>
	<div class="row">
		<div class="col-sm-6">
		    <?php  if ( rwmb_meta( 'thm_link' ) ) { ?>
		    <div class="featured-wrap">
		        <div class="entry-link">
		            <h4><?php echo esc_url( rwmb_meta( 'thm_link' ) ); ?></h4>
		        </div>     
		    </div>
		    <?php } ?>
		</div> 
		<div class="col-sm-6">
			<span class="post-icon"><i class="fa fa-link"></i></span>
		    <?php get_template_part( 'post-format/entry-content' ); ?> 
	    </div>
    </div>
<?php } else { ?>
    <?php  if ( rwmb_meta( 'thm_link' ) ) { ?>
    <div class="featured-wrap">
        <div class="entry-link">
            <h4><?php echo esc_url( rwmb_meta( 'thm_link' ) ); ?></h4>
        </div>     
    </div>
    <?php } ?>
    <?php if (!is_single()) { ?>
	<span class="post-icon"><i class="fa fa-link"></i></span>
	<?php }  ?>
    <?php get_template_part( 'post-format/entry-content' ); ?>     
<?php } ?>    
</article> <!--/#post -->