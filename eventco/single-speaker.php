<?php get_header(); ?>
<?php get_template_part('lib/sub-header'); ?>

<section id="main" class="clearfix speaker-single-wrapper">
	<div class="container">
		<?php while(have_posts()): the_post(); ?>
			<?php
				$designation 	= get_post_meta(get_the_ID(), 'themeum_designation', true );
				$company 		= get_post_meta(get_the_ID(), 'themeum_company', true );
				$facebook 		= get_post_meta(get_the_ID(), 'themeum_facebook_url', true );
				$soundcloud 	= get_post_meta(get_the_ID(), 'themeum_soundcloud_url', true );
				$twitter 		= get_post_meta(get_the_ID(), 'themeum_twitter_url', true );
				$dribbble 		= get_post_meta(get_the_ID(), 'themeum_dribbble_url', true );
				$flickr 		= get_post_meta(get_the_ID(), 'themeum_flickr_url', true );
				$google 		= get_post_meta(get_the_ID(), 'themeum_google_url', true );
				$pinterest 		= get_post_meta(get_the_ID(), 'themeum_pinterest_url', true );
				$youtube 		= get_post_meta(get_the_ID(), 'themeum_youtube_url', true );
				$linkedin 		= get_post_meta(get_the_ID(), 'themeum_linkedin_url', true );
				$behance 		= get_post_meta(get_the_ID(), 'themeum_behance_url', true );
				$vk 			= get_post_meta(get_the_ID(), 'themeum_vk_url', true );
				$skype 			= get_post_meta(get_the_ID(), 'themeum_skype_url', true );
				$instagram 		= get_post_meta(get_the_ID(), 'themeum_instagram_url', true );
				$session_info_group = get_post_meta(get_the_ID(), 'session_info_group', true );
			?>

			<div class="row">
				<div class="col-sm-7">
					
					<?php if ($designation): ?>		
						<p class="lead speaker-designation"><?php echo esc_attr($designation); ?></p>
					<?php endif ?>
					<h2 class="speaker-title"><?php the_title(); ?></h2>
					<div class="speaker-description"><?php the_content(); ?></div>
					<div class="speaker-social-icons">
						<ul>
							<?php if( $facebook != '' ){ ?>
								<li>
									<a target="_blank" class="social-facebook" href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a>
								</li>
							<?php } ?>
							<?php if( $soundcloud != '' ){ ?>
								<li>
									<a target="_blank" class="social-soundcloud" href="<?php echo esc_url($soundcloud); ?>"><i class="fa fa-soundcloud"></i></a>
								</li>
							<?php } ?>
							<?php if( $twitter != '' ){ ?>
								<li>
									<a target="_blank" class="social-twitter" href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a>
								</li>
							<?php } ?>
							<?php if( $dribbble != '' ){ ?>
								<li>
									<a target="_blank" class="social-dribbble" href="<?php echo esc_url($dribbble); ?>"><i class="fa fa-dribbble"></i></a>
								</li>
							<?php } ?>
							<?php if( $flickr != '' ){ ?>
								<li>
									<a target="_blank" class="social-flickr" href="<?php echo esc_url($flickr); ?>"><i class="fa fa-flickr"></i></a>
								</li>
							<?php } ?>
							<?php if( $google != '' ){ ?>
								<li>
									<a target="_blank" class="social-google-plus" href="<?php echo esc_url($google); ?>"><i class="fa fa-google-plus"></i></a>
								</li>
							<?php } ?>
							<?php if( $pinterest != '' ){ ?>
								<li>
									<a target="_blank" class="social-pinterest" href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest"></i></a>
								</li>
							<?php } ?>
							<?php if( $youtube != '' ){ ?>
								<li>
									<a target="_blank" class="social-youtube" href="<?php echo esc_url($youtube); ?>"><i class="fa fa-youtube"></i></a>
								</li>
							<?php } ?>
							<?php if( $linkedin != '' ){ ?>
								<li>
									<a target="_blank" class="social-linkedin" href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a>
								</li>
							<?php } ?>
							<?php if( $behance != '' ){ ?>
								<li>
									<a target="_blank" class="social-behance" href="<?php echo esc_url($behance); ?>"><i class="fa fa-behance"></i></a>
								</li>
							<?php } ?>
							<?php if( $vk != '' ){ ?>
								<li>
									<a target="_blank" class="social-vk" href="<?php echo esc_url($vk); ?>"><i class="fa fa-vk"></i></a>
								</li>
							<?php } ?>
							<?php if( $skype != '' ){ ?>
								<li>
									<a target="_blank" class="social-skype" href="skype:<?php echo esc_url($skype); ?>?chat"><i class="fa fa-skype"></i></a>
								</li>
							<?php } ?>
							<?php if( $instagram != '' ){ ?>
								<li>
									<a target="_blank" class="social-instagram" href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>

				<div class="col-sm-5">
					<?php
						if (has_post_thumbnail( $post->ID ) ): 
						  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'speaker-thumb' );
						  echo '<img class="img-responsive" src="'.esc_url($image[0]).'" alt="'.get_the_title().'">';
						endif;
					?>
				</div>
			</div>

			<div class="row">
				
				<div class="col-sm-12">
					<h3 class="intro-text"><?php esc_html_e('Know What You Will Learn', 'eventco'); ?></h3>
					<h2 class="session-title"><?php esc_html_e('All Sessions', 'eventco'); ?></h2>
				</div>

				<div class="col-sm-12">

			    	<div class="session-details-information">
						<?php foreach( $session_info_group as $value ){ ?>
								<div class="session-list">
									<?php if (isset($value["themeum_session_nbr"])) { ?>
										<div class="session-nbr">
											<span><?php echo esc_html_e('Session', 'eventco'); ?></span>
											<h2><?php echo $value["themeum_session_nbr"]; ?></h2>
										</div>
									<?php } ?>
									<div class="session-daytime">
										<?php if (isset($value["themeum_session_day"])): ?>
											<span><?php echo $value["themeum_session_day"]; ?></span>
										<?php endif ?>

										<?php if (isset($value["themeum_start_datetime"])): ?>
											<span>(<?php echo date_i18n( get_option( 'date_format' ), strtotime($value["themeum_start_datetime"])) ?>)</span>
										<?php endif ?>

										<?php if (isset($value["themeum_start_datetime"])): ?>
											<h2><?php echo date_i18n( get_option( 'time_format' ), strtotime($value["themeum_start_datetime"])); ?></h2>
										<?php endif ?>
									</div>

									<?php if (isset($value["themeum_session_topic"])): ?>
										<div class="session-topic">
											<span><?php echo esc_html_e('Topic', 'eventco'); ?></span>
											<h2><?php echo $value["themeum_session_topic"]; ?></h2>
										</div>
									<?php endif ?>

									<?php if ($value["themeum_session_venue"]): ?>
										<div class="session-venue">
											<span><?php echo esc_html_e('Venue', 'eventco'); ?></span>
											<h2><?php echo $value["themeum_session_venue"]; ?></h2>
										</div>
									<?php endif ?>

								</div>
		                <?php } ?>
					</div>
				</div>	    	
			</div>
		<?php endwhile; ?>
	</div><!--/.container-->
</section>
<?php get_footer();





