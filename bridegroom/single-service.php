<?php get_header(); ?>
<?php $disable_subheader = get_post_meta( get_the_ID(), 'themeum_disable_subheader', true ); ?>
<?php if (empty($disable_subheader)): ?>   
<?php get_template_part('lib/sub-header'); ?>
<?php endif ?>

<section id="main" class="clearfix">
    <div id="content" class="site-content" role="main">
		<?php while(have_posts()): the_post(); ?>
			<div class="service-content"><?php the_content();?></div>	
		<?php endwhile; wp_reset_query(); ?>
	</div>
</section>

<?php get_footer();

