<?php 
get_header();

$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' ); ?>

<section id="main" class="clearfix page-event-details">
	<div id="page" class="container event-page">
		<div class="row event-content">
			<?php 

			$i = '0';
			$j = '0';
			$x = '0';

			while(have_posts()): the_post(); 

				$start_datetime 	= get_post_meta(get_the_ID(),'themeum_event_start_datetime',true);
				$end_datetime 		= get_post_meta(get_the_ID(),'themeum_event_end_datetime',true);
				$event_location 	= get_post_meta(get_the_ID(),'themeum_event_location',true);
				$event_form 		= get_post_meta(get_the_ID(),'themeum_event_form', true);
				$intro_text 		= get_post_meta(get_the_ID(),'themeum_intro_text', true);
    			$map = rwmb_meta('themeum_eventmap'); 

    			$thumb_id = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
				$thumb_url = $thumb_url_array[0]; ?>
				

			<!-- Event Information -->
			<div class="col-sm-12 event-banner-img">
				<div class="cover-img" style="background-image: url('<?php echo $thumb_url; ?>'); background-repeat: no-repeat; background-size: cover;">
					<div class="event-title-wrap">
						<?php if ($intro_text): ?>
							<span><?php echo $intro_text; ?></span>
						<?php endif ?>
						<h2 class="event-title"><?php the_title(); ?></h2>
					</div>	
				</div>
			</div>

			<div class="col-sm-10">
				<div class="event-information">
					<h2><?php esc_html_e('Event Information', 'bridegroom') ?></h2>
					<ul>
						<li>
							<span class="event-location"><i class="fa fa-clock-o"></i></span>
							<span class="event-info">
								<?php echo date_i18n( $date_format.' , '.$time_format, strtotime($start_datetime)); ?>
								<?php echo date_i18n( $time_format , strtotime($end_datetime)); ?>
							</span>
						</li>
						<li>
							<span class="event-location"><i class="fa fa-map-marker"></i></span>
							<span class="event-info"><?php echo $event_location; ?></span>
						</li>
					</ul>		
				</div>

				<div class="event-content">
					<?php the_content();?>
				</div>	

				<div class="event-map">
	                <?php print $map; ?>
	            </div>
			</div>


			<div class="col-sm-12 event-banner-img">
				<div class="cover-img contact-form">
					<!-- Event RSVP Form  -->
		            <div class="event-contact-from">
			            <div class="container">
				            <div class="row">
								<div class="col-sm-9">

									<div class="contact-from-wrap">
										<span>
											<?php esc_html_e('Please fillup before ', 'bridegroom'); ?>
											<?php echo date_i18n( $date_format, strtotime($start_datetime)); ?>
										</span>
										<h2><?php esc_html_e('Are You Attending?', 'bridegroom'); ?></h2>
									</div>

									<?php 
										if ($event_form) {
							                echo do_shortcode( '[contact-form-7 id="'.$event_form.'"]' );
							            }
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Event Gallery End -->
			<?php 
			endwhile; 
			wp_reset_query(); ?>
		</div>
	</div>
</section>


<?php get_footer();

