<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ){ ?>
        <div class="featured-wrap"><a href="<?php the_permalink(); ?>" rel="bookmark">
            <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
        </a>
        </div>
	<?php }
	get_template_part( 'post-format/entry-content' ); ?> 
</article> <!--/#post-->