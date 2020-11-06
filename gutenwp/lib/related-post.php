<?php 
    $related_post_style = get_theme_mod('related_post_style', 'style1');
    $related_post 		= get_theme_mod('related_post', 'style1');
    $text_limit 		= get_theme_mod('related_post_cat_limit', 45); ?>
    <div class="related-entries">

    	<div class="container">
    		<div class="row">
	        	<div class="addon-article intro-item-wrapper col-md-12">
	        		<h3><?php esc_html_e('Related Posts', 'gutenwp') ?></h3>
	    		</div>
    		</div>
		</div>


    	<?php if ($related_post_style == 'style1') { ?>
    	<?php if ($related_post == 'style1') { ?>
	  		<div class="default">
		<?php }else{ ?>
			<div class="container">
		<?php } ?>
			  	<div class="row">
				    <?php
				        $cats = get_the_category($post->ID);
				        if ($cats) {  
					        $first_cat = $cats[0]->term_id;
					        $args = array(
						        'category__in' 			=> array($first_cat),
						        'post__not_in' 			=> array($post->ID),
						        'posts_per_page'		=> 3,
						        'ignore_sticky_posts'	=> 1
					        );
					        $query_post = new WP_Query($args);
					        if( $query_post->have_posts() ) {
						        while ($query_post->have_posts()) : $query_post->the_post(); ?>

						        	<div class="addon-article intro-item-wrapper col-md-4">
										<div class="article-image-wrap">
											<a href="<?php get_permalink(); ?>" class="img-wrapper">
												<?php echo get_the_post_thumbnail(get_the_ID(), 'gutenwp-medium', array('class' => 'img-responsive')); ?>
											</a>
										</div>

										<?php 
										$content = get_post_field( 'post_content', get_the_ID() );
									    $word_count = str_word_count( strip_tags( $content ) );
									    $wordceil = ceil ($word_count / 200); ?>

										<div class="article-details">
											<h3 class="article-title">
												<a href="<?php get_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, $text_limit, '...'); ?></a>
											</h3>
											
								            <ul class="gutenwp-post-category">
								                <li class="meta-category"><?php echo get_the_category_list(', '); ?></li>
								                <li class="meta-read">. <?php echo $wordceil.' '.__('  min read'); ?></li>
								            </ul>       
										</div>
									</div>

						        <?php
						        endwhile;
					        }
					        wp_reset_query();
				        }
				    ?> 
			  	</div>
		  	</div>
    	<?php }elseif ($related_post_style == 'style2') { ?>
			<div class="style2-music">
				<div class="container">
					<div class="row gutenwp-music-post addon-article leading-item items-masonary">
					    <?php
					        $cats = get_the_category($post->ID);
					        if ($cats) { ?>
					        	<div class="addon-intro col-md-12">
					        		<h3><?php echo esc_html_e('Similar Content', 'gutenwp') ?></h3>
					    		</div>
						  
						        <?php 
						        $first_cat = $cats[0]->term_id;
						        $args = array(
							        'category__in' 			=> array($first_cat),
							        'post__not_in' 			=> array($post->ID),
							        'posts_per_page'		=> 5,
							        'ignore_sticky_posts'	=> 1
						        );

						        $count = 1;
						        $query_post = new WP_Query($args);
						        if( $query_post->have_posts() ) {
							        while ($query_post->have_posts()) : $query_post->the_post();

										$the_date = get_the_date();

										if ($count == 1) { ?>
											<div class="addon-article intro-item-wrapper music-video col-md-3 masonary-item">	

												<div class="article-image-wrap single-img">
													<?php 
													if ( has_post_thumbnail()) { ?>
														<a class="item-image"  href="<?php echo get_permalink(); ?>"><i class="fa fa-play"></i></a>
														<?php echo get_the_post_thumbnail(get_the_ID(), 'gutenwp-medium', array('class' => 'img-responsive')); ?>
													<?php } ?>
												</div>

												<div class="article-details">
													<h3 class="article-title">
														<a href="<?php echo get_permalink(); ?>">
															<?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?>	
														</a>
													</h3>
													
										            <ul class="gutenwp-post-category">
										                <li class="meta-read"><?php echo __(' By ', 'gutenwp-core').'  '.get_the_author_meta('display_name'); ?> /</li>
										                <li class="meta-category"><?php date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?></li>
										            </ul>
												</div>

											</div>	
										<?php }else if ($count == 2) { ?>
											<div class="addon-article intro-item-wrapper music-video col-md-6 masonary-item second">
												
												<div class="article-image-wrap">
													<?php if ( has_post_thumbnail()) { ?>
														<a class="item-image"  href="<?php echo get_permalink(); ?>">
															<i class="fa fa-play"></i></a>
														<?php echo  get_the_post_thumbnail(get_the_ID(), 'gutenwp-portfo', array('class' => 'img-responsive'));
													} ?>
												</div>

												<div class="article-details">
													<h3 class="article-title">
														<a href="<?php echo get_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 85, '...'); ?></a>
													</h3>

													<ul class="gutenwp-post-category">
										                <li class="meta-read"><?php echo __(' By ', 'gutenwp').'  '.get_the_author_meta('display_name'); ?> /</li>
										                <li class="meta-category"><?php echo date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?></li>
										            </ul>
												</div>
											</div>
										<?php }else { ?>
											<div class="addon-article intro-item-wrapper music-video col-md-3 masonary-item">
												<div class="article-image-wrap single-img">
													<?php if ( has_post_thumbnail()) { ?>
														<a class="item-image"  href="<?php echo get_permalink(); ?>"><i class="fa fa-play"></i></a>
														<?php echo get_the_post_thumbnail(get_the_ID(), 'gutenwp-medium', array('class' => 'img-responsive'));
													} ?>
												</div>

												<div class="article-details">
													<h3 class="article-title">
														<a href="<?php echo get_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 45, '...'); ?></a>
													</h3>
													
													<ul class="gutenwp-post-category">
										                <li class="meta-read"><?php echo __(' By ', 'gutenwp').'  '.get_the_author_meta('display_name'); ?> /</li>
										                <li class="meta-category"><?php date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?></li>
										            </ul>

												</div>
											</div>
										<?php }
										$count++; ?>

							        <?php
							        endwhile;
						        }
						        wp_reset_query();
					        }
					    ?> 
				  	</div>
			  	</div>
		  	</div>
    	<?php } ?>
	</div>