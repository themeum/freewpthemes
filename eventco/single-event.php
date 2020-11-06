<?php 
get_header();
get_template_part('lib/sub-header'); 

$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
?>

<section id="main" class="clearfix page-event-details">
	<div id="page" class="container event-page">
		<div class="row event-content">
			<?php 

			$i = '0';
			$j = '0';
			$x = '0';

			while(have_posts()): the_post(); 

				$event_organizer 	= get_post_meta(get_the_ID(),'themeum_event_organizer',true);
				$start_datetime 	= get_post_meta(get_the_ID(),'themeum_event_start_datetime',true);
				$end_datetime 		= get_post_meta(get_the_ID(),'themeum_event_end_datetime',true);
				$event_location 	= get_post_meta(get_the_ID(),'themeum_event_location',true);
				$event_gallery 		= get_post_meta(get_the_ID(),'themeum_event_glallery_list');
				$sponsor_list 		= get_post_meta(get_the_ID(),'event_sponsor_group', true); ?>
				

			<!-- Event Information -->
			<div class="col-sm-12">
				<?php
				if (has_post_thumbnail( $post->ID ) ): 
				  	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eventco-large' );
				 	echo '<img class="cover-img img-responsive" src="'.esc_url($image[0]).'" alt="'.get_the_title().'">';
				endif;
				?>

				<div class="event-title-wrap">
					<div class="event-title-50">
						<h2 class="event-title"><?php the_title(); ?></h2>
					</div>
					<div class="event-title-50">
						<?php get_template_part( 'post-format/social-buttons', 'none' ); ?>
					</div>
				</div>


				<div class="event-content">
					<?php the_content();?>
				</div>
				<div class="event-information">
					<h2><?php esc_html_e('Event Information', 'eventco') ?></h2>
					<ul>
						<li>
							<span><?php esc_html_e('Organizer', 'eventco') ?></span>
							<span class="event-info"><?php echo $event_organizer; ?></span>
						</li>
						<li>
							<span><?php esc_html_e('Start Date', 'eventco') ?></span>
							<span class="event-info">
								<?php echo date_i18n( $date_format.' - '.$time_format, strtotime($start_datetime)); ?>
							</span>
						</li>
						<li>
							<span><?php esc_html_e('End Date', 'eventco') ?></span>
							<span class="event-info">
								<?php echo date_i18n( $date_format.' - '.$time_format, strtotime($end_datetime)); ?>	
							</span>
						</li>
						<li>
							<span><?php esc_html_e('Address', 'eventco') ?></span>
							<span class="event-info"><?php echo $event_location; ?></span>
						</li>
					</ul>
					
				</div>
			</div>

			<!-- Single Event Schedule -->
			<div class="col-sm-12">
				<h2 class="event-schedules"><?php esc_html_e('Event Schedules', 'eventco') ?></h2>
				<?php $event_sections 	= get_post_meta(get_the_ID(), 'event_section', true); ?>
				<div class="event-schedule-tab-view" style="display: block;">
					<ul class="nav nav-tabs" role="tablist">
						<?php foreach ($event_sections as $event) { 
							if ($i == 0) { ?>

								<li role="presentation" class="active col">
									<a href="#scehdule-<?php echo $i; ?>" data-toggle="tab">
										
										<?php if (isset($event['themeum_date_of_event'])){ ?>
										<span><?php echo $event['themeum_date_of_event']; ?></span>
										<?php }else { ?>
											<span ><?php echo __('Day ', 'eventco').' '. $i; ?></span>
										<?php } ?>

										<p class="schedule-date-tab">
											<?php 
												if (isset($event["themeum_event_date"]) && !empty($event["themeum_event_date"])) {
													echo date_i18n($date_format, strtotime($event["themeum_event_date"])); 
												}
											?>
											<span class="datetime">
												<?php
													foreach ($event['event_info_group'] as $value) {
													  	if ($value === reset($event['event_info_group'])) {
															if (isset($value["themeum_start_datetime"]) && !empty($value["themeum_start_datetime"])) {
																echo ' ('. date_i18n( $time_format , strtotime($value["themeum_start_datetime"]));
															}

													    }
													    if ($value === end($event['event_info_group'])) {
													    	if (isset($value["themeum_end_time"]) && !empty($value["themeum_end_time"])) {
													        	echo ' - '. date_i18n( $time_format , strtotime($value["themeum_end_time"])).')';
															}
													    }
													}
												?>
											</span>
										</p>
									</a>
								</li>

							<?php }else { ?>

								<?php if (isset($event['themeum_date_of_event'])) { ?>
									<li role="presentation" class="col">
										<a href="#scehdule-<?php echo $i; ?>" data-toggle="tab">
											<span><?php echo $event['themeum_date_of_event']; ?></span>
											<?php if (isset($event['themeum_event_date'])): ?>
												<p class="schedule-date-tab">
													<?php echo date_i18n("d M, Y", strtotime($event["themeum_event_date"])); ?>

													<span class="datetime">
														<?php
															foreach ($event['event_info_group'] as $value) {
															  	if ($value === reset($event['event_info_group'])) {
																	if (isset($value["themeum_start_datetime"]) && !empty($value["themeum_start_datetime"])) {
																		echo ' ('. date_i18n( $time_format, strtotime($value["themeum_start_datetime"]));
																	}

															    }
															    if ($value === end($event['event_info_group'])) {
															    	if (isset($value["themeum_end_time"]) && !empty($value["themeum_end_time"])) {
															        	echo ' - '. date_i18n( $time_format , strtotime($value["themeum_end_time"])).')';
																	}
															    }
															}
														?>
													</span>

												</p>
											<?php endif ?>
										</a>
									</li>
								<?php } ?>
								
							<?php } $i++; ?>
						<?php } ?>
					</ul>
				</div>
				<div class="tab-content">
					<?php foreach ($event_sections as $event_section) { 
						if ($j == 0) { ?>
							<div class="tab-pane active" id="scehdule-<?php echo $j; ?>">
						<?php }else { ?>
							<div class="tab-pane" id="scehdule-<?php echo $j; ?>">
						<?php } $j++; ?>
							<?php foreach ($event_section['event_info_group'] as $event_detals) { 

								if (array_key_exists('speaker_name', $event_detals)){
							    	$team1data = themeum_speaker_list($event_detals['speaker_name']); # Speaker ID pass
							  	} else {
							    	$team1data = themeum_speaker_list(0);  # Speakers
							  	} ?>
					
					        	<div class="row event-container">

									<div class="col-sm-2 event-time">
										<?php if (isset($event_detals["themeum_start_datetime"]) && !empty($event_detals["themeum_start_datetime"])): ?>
											<?php echo date_i18n("H: i", strtotime($event_detals["themeum_start_datetime"])); ?>
											<span><?php echo date_i18n("A", strtotime($event_detals["themeum_start_datetime"])); ?></span>
										<?php endif ?>
									</div>

									<div class="col-sm-8 speaker-content">
										<h3 class="event-session" data-toggle="collapse" data-target="#eventid-<?php echo $x; ?>" aria-expanded="false" aria-controls="eventid-<?php echo $x; ?>">
											<?php echo $event_detals["themeum_session"]; ?>
										</h3>
										<?php if (isset($team1data) && !empty($team1data)): ?>
											<div class="speaker-name-wrap">	
												<a href="<?php echo $team1data[0]["url"]; ?>">
					        						<span class="speaker-name"><?php echo esc_attr($team1data[0]['name']); ?></span>
					        					</a>
					        					<span class="speaker-designation"><?php echo esc_attr($team1data[0]['designation']); ?></span>
				        					</div>
			        					<?php endif ?>
			        					<div class="intro-text collapse" id="eventid-<?php echo $x; ?>">
									    	<p><?php echo $event_detals['themeum_intro_text']; ?></p>
									    	<?php if (isset($event_detals['themeum_venue']) && !empty($event_detals['themeum_venue'])): ?>
												<p class="locaion"><i class="fa fa-map-marker"></i><?php echo $event_detals['themeum_venue']; ?></p>
									    	<?php endif ?>
										</div>
									</div>

									<div class="col-sm-2 event-img-wrap">
										<?php if (isset($team1data) && !empty($team1data)): ?>
											<div class="event-img">
												<a href="<?php echo $team1data[0]["url"]; ?>"><?php echo $team1data[0]['image']; ?></a>
											</div>
										<?php endif; ?>
									</div>
								</div>

								<?php $x++; ?>
							<?php } ?>
						</div>
					<?php }  ?>
				</div>
			</div>
			<!-- End Event Schedule -->

			<!-- Event Gallery -->
			<div class="event-gallery col-sm-12">
				<h2 class="event-schedules"><?php esc_html_e('A Glimpse from our last event', 'eventco') ?></h2>
		        <div class="photo-gallery-item row">
		            <?php 
		            	if (is_array($event_gallery)) {
			            	if(!empty($event_gallery)) {
				            	$limitw  = 20;
				            	$photo_slices = (count($event_gallery) > $limitw) ? array_slice($event_gallery, 0, $limitw , true ) : $event_gallery;
			                    foreach ($photo_slices as $key=>$photos) {
				                    $gallery_photo 	= wp_get_attachment_image_src( $photos, 'full' ); ?>

				                    <div class="photo-gallery-items col-sm-6 col-md-4">
				                        <div class="gallery-items-img">
				                           <a href="<?php echo esc_url($gallery_photo[0]); ?>" class="cloud-zoom">
				                           		<img src="<?php echo esc_url($gallery_photo[0]); ?>" class="img-responsive" alt="<?php esc_html_e('gallery_photo : ','eventco');?>" />
				                           	</a>
				                        </div> <!--/.gallery-items-img-->
				                    </div> <!--/.col-md-3-->
			                    <?php }
							} 
						} 
					?> 
				</div> <!--.row-->
		  	</div> <!--Event Gallery-->
			<!-- Event Gallery End -->
			<?php endwhile; wp_reset_query(); ?>
		</div>
	</div>
</section>

<section class="sponsor">
	<div class="container">
		<div class="row">
			<!-- Sponsor list -->
			<div class="col-sm-12">
				<span class="event-sponsor-subtitle"><?php esc_html_e('Check Who Makes The Event Possible', 'eventco') ?></span>
				<h2 class="event-sponsor-title"><?php esc_html_e('Event Sponsors', 'eventco') ?></h2>
		        <div class="sponsor-photo row">

				    <?php 

				    foreach ($sponsor_list as $sponsor) { ?>
				    	<?php if (isset($sponsor['themeum_sponsor_title']) && !empty($sponsor['themeum_sponsor_title'])) { ?>
							<div class="photo-gallery-items col-sm-12">
					        	<h3 class="sponsor-title"><?php echo $sponsor['themeum_sponsor_title'] ?></h3>
					        </div>
						<?php  } ?>

				        <?php if (isset($sponsor['themeum_sponsor_list']) && is_array($sponsor['themeum_sponsor_list'])) { ?>
				            <?php foreach ($sponsor['themeum_sponsor_list'] as $key=>$photo) {
				                $photo_thumb 		= wp_get_attachment_image_src( $photo, 'eventco-medium' ); ?>

				                <div class="col">
				                	<div class="sponsor-img sponsor-col-<?php echo count($sponsor['themeum_sponsor_list']); ?>">
				                   		<img src="<?php echo esc_url($photo_thumb[0]);?>" class="img-responsive" alt="<?php esc_html_e('photo : ','eventco');?>" />
				                	</div>
				                </div>
				            <?php } ?>
				           
						<?php } ?>
					<?php }  ?> 
					
				</div> <!--.row-->
			</div> <!-- End Sponor -->
		</div>
	</div>
</section>

<?php get_footer();

