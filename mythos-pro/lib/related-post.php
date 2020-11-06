<!-- Related Post -->
<div class="related-entries">
	<div class="row">
		<?php 
		global $post;
		$categories = get_the_category($post->ID);
		if ($categories) { ?>
			<!-- Title -->
			<div class="col-md-12">
				<h3 class="related-post-title"><?php esc_html_e('Related Posts', 'mythos-pro') ?></h3>
			</div>

			<?php 
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
			$args=array(
				'category__in' 		=> $category_ids,
				'post__not_in' 		=> array($post->ID),
				'posts_per_page'	=> 3,
				'ignore_sticky_posts'	=>1
			);
			$thequery = new wp_query( $args );
			if( $thequery->have_posts() ) { ?>

				<?php while( $thequery->have_posts() ) {
					$thequery->the_post();?>

					<div class="col-md-4">
						<div class="relatedthumb">
							<a href="<?php get_permalink(); ?>" class="img-wrapper">
								<?php echo get_the_post_thumbnail(get_the_ID(), 'mythos-medium', array('class' => 'img-responsive')); ?>
							</a>
						</div>
						<div class="relatedcontent">
							<span class="datetime"><?php the_time('M j, Y'); ?></span>
							<h3><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						</div>
					</div>
				<?php } ?>

			<?php } }
			wp_reset_query();  
		?>
	</div> <!-- Row end -->

	<!-- Call to to action -->
	<?php 
    $action_title = get_theme_mod('blog_calltoaction_title');
    $action_subtitle = get_theme_mod('blog_calltoaction_subtitle');
    $enable = get_theme_mod('enable_call_to_action', true);

    $button_one = get_theme_mod('blog_button_one');
    $button_two = get_theme_mod('blog_button_two');

    $btn_url1 = get_theme_mod('blog_button_url1');
    $btn_url2 = get_theme_mod('blog_button_url2'); ?>

    <?php if (get_theme_mod('enable_call_to_action', true) == 'true'): ?>
        <div class="row call-to-action">
            <div class="col-md-7"> 
                <h3 class="support-title"><?php echo esc_html($action_title); ?></h3>
                <h2 class="title-self"><?php echo esc_html($action_subtitle); ?></h2>
            </div>
            <div class="col-md-5 text-right">
                <?php if ($btn_url1): ?>
                    <a href="<?php echo esc_url($btn_url1); ?>" class="btn"><?php echo esc_html($button_one); ?></a> 
                <?php endif ?>
                <?php if ($btn_url2): ?>
                    <a href="<?php echo esc_url($btn_url2); ?>" class="btn btn2"><?php echo esc_html($button_two); ?></a>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>
</div>

