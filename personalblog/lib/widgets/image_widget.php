<?php

add_action('widgets_init','register_themeum_image_widget');

function register_themeum_image_widget()
{
	register_widget('Themeum_Image_Widget');
}

class Themeum_Image_Widget extends WP_Widget{

	public function __construct() {
		parent::__construct( 'Themeum_Image_Widget', esc_html__("themeum Image Ads",'personalblog'), array('description' => esc_html__("This Image Ads Widgets",'personalblog')) );
	}

	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	public function widget( $args, $instance ) {

		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		?>

		<?php	if($instance['ads_img1']) { ?>
			<div class="single-ads">
				<?php	if($instance['ads_img1']) {
				echo '<a href="'.esc_attr($instance['ads_img_link1']).'" target="_blank"><img src="'. esc_url(get_site_url()) . $instance['ads_img1'].'" class="img-responsive" alt="'.esc_html__('Ads','personalblog').'"></a>';
				} ?>
			</div>
		<?php } ?>

		<?php	if( $instance['ads_img2'] || $instance['ads_img3'] || $instance['ads_img4'] || $instance['ads_img5'] || $instance['ads_img6'] || $instance['ads_img7'] ) { ?>
			<ul class="double-ads">
				<?php 
					if($instance['ads_img2']) {
					echo '<li><a href="'.$instance['ads_img_link2'].'" target="_blank"><img src="'. esc_url(get_site_url()) . $instance['ads_img2'].'" class="img-responsive" alt=""></a></li>';	
					}			
					if($instance['ads_img3']) {
					echo '<li><a href="'.$instance['ads_img_link3'].'" target="_blank"><img src="'. esc_url(get_site_url()) . $instance['ads_img3'].'" class="img-responsive" alt=""></a></li>';	
					}		
				?>		

				<?php 
					if($instance['ads_img4']) {
					echo '<li><a href="'.$instance['ads_img_link4'].'" target="_blank"><img src="'. esc_url(get_site_url()) . $instance['ads_img4'].'" class="img-responsive" alt=""></a></li>';	
					}	
			
					if($instance['ads_img5']) {
					echo '<li><a href="'.$instance['ads_img_link5'].'" target="_blank"><img src="'. esc_url(get_site_url()) . $instance['ads_img5'].'" class="img-responsive" alt=""></a></li>';
					}		
				?>

				<?php 
					if($instance['ads_img6']) {
					echo '<li><a href="'.$instance['ads_img_link6'].'" target="_blank"><img src="'. esc_url(get_site_url()) . $instance['ads_img6'].'" class="img-responsive" alt=""></a></li>';	
					}	
			
					if($instance['ads_img7']) {
					echo '<li><a href="'.$instance['ads_img_link7'].'" target="_blank"><img src="'. esc_url(get_site_url()) . $instance['ads_img7'].'" class="img-responsive" alt=""></a></li>';
					}		
				?>
			</ul>
		<?php } ?>


		<?php echo $after_widget;
	}


	/*-------------------------------------------------------
	 *				Sanitize data, save and retrive
	 *-------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ads_img_link1'] 		= $new_instance['ads_img_link1'];
		$instance['ads_img1'] 	= $new_instance['ads_img1'];
		$instance['ads_img_link2'] 		= $new_instance['ads_img_link2'];		
		$instance['ads_img2'] 	= $new_instance['ads_img2'];		
		$instance['ads_img_link3'] 		= $new_instance['ads_img_link3'];		
		$instance['ads_img3'] 	= $new_instance['ads_img3'];		
		$instance['ads_img_link4'] 		= $new_instance['ads_img_link4'];		
		$instance['ads_img4'] 	= $new_instance['ads_img4'];		
		$instance['ads_img_link5'] 		= $new_instance['ads_img_link5'];		
		$instance['ads_img5'] 	= $new_instance['ads_img5'];		
		$instance['ads_img_link6'] 		= $new_instance['ads_img_link6'];		
		$instance['ads_img6'] 	= $new_instance['ads_img6'];		
		$instance['ads_img_link7'] 		= $new_instance['ads_img_link7'];		
		$instance['ads_img7'] 	= $new_instance['ads_img7'];
		return $instance;
	}


	/*-------------------------------------------------------
	 *				Back-End display of widget
	 *-------------------------------------------------------*/
	
	public function form( $instance )
	{

		$defaults = array(  'title' => '',
			'ads_img_link1' => '#',
			'ads_img1' => '',
			'ads_img_link2' => '#',
			'ads_img2' => '',
			'ads_img_link3' => '#',
			'ads_img3' => '',
			'ads_img_link4' => '#',
			'ads_img4' => '',
			'ads_img_link5' => '#',
			'ads_img5' => '',			
			'ads_img_link6' => '#',
			'ads_img6' => '',			
			'ads_img_link7' => '#',
			'ads_img7' => ''
			);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title : ', 'personalblog' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
		</p>

		<!--/image ads1-->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img_link1' )); ?>"><?php esc_html_e( 'Ads Link', 'personalblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ads_img_link1'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img_link1')); ?>" value="<?php echo esc_attr($instance['ads_img_link1']); ?>">
			
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img1' )); ?>"><?php esc_html_e( 'Ads Image URL', 'personalblog' ); ?></label>
			<input type="hidden" id="<?php echo esc_attr($this->get_field_id('ads_img1'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img1'));?>" class="<?php echo esc_attr($this->get_field_id('ads_img1'));?>" value="<?php echo esc_attr($instance['ads_img1']); ?>"/>
 			<button id="<?php echo esc_attr($this->get_field_id('ads_img1'));?>" class="custom-upload button" data-url="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html__('Upload image','personalblog'); ?></button>
 			<img class="<?php echo esc_attr($this->get_field_id('ads_img1'));?>" src="<?php echo esc_url(get_site_url()) . esc_attr($instance['ads_img1']); ?> "/>
		</p>		

		<!--/image ads2-->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img_link2' )); ?>"><?php esc_html_e( 'Ads Link 2', 'personalblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ads_img_link2'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img_link2')); ?>" value="<?php echo esc_attr($instance['ads_img_link2']); ?>">

			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img2' )); ?>"><?php esc_html_e( 'Ads Image URL 2', 'personalblog' ); ?></label>
			<input type="hidden" id="<?php echo esc_attr($this->get_field_id('ads_img2'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img2'));?>" class="<?php echo esc_attr($this->get_field_id('ads_img2'));?>" value="<?php echo esc_attr($instance['ads_img2']); ?>"/>
 			<button id="<?php echo esc_attr($this->get_field_id('ads_img2'));?>" class="custom-upload button" data-url="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html__('Upload image','personalblog'); ?></button>
 			<img class="<?php echo esc_attr($this->get_field_id('ads_img2'));?>" src="<?php echo esc_url(get_site_url()) . esc_attr($instance['ads_img2']); ?> "/>
		</p>		

		<!--/image ads3-->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img_link3' )); ?>"><?php esc_html_e( 'Ads Link 3', 'personalblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ads_img_link3'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img_link3')); ?>" value="<?php echo esc_attr($instance['ads_img_link3']); ?>">

			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img3' )); ?>"><?php esc_html_e( 'Ads Image URL 3', 'personalblog' ); ?></label>
			<input type="hidden" id="<?php echo esc_attr($this->get_field_id('ads_img3'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img3'));?>" class="<?php echo esc_attr($this->get_field_id('ads_img3'));?>" value="<?php echo esc_attr($instance['ads_img3']); ?>"/>
 			<button id="<?php echo esc_attr($this->get_field_id('ads_img3'));?>" class="custom-upload button" data-url="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html__('Upload image','personalblog'); ?></button>
 			<img class="<?php echo esc_attr($this->get_field_id('ads_img3'));?>" src="<?php echo esc_url(get_site_url()) . esc_attr($instance['ads_img3']); ?> "/>
		</p>

		<!--/image ads4-->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img_link4' )); ?>"><?php esc_html_e( 'Ads Link 4', 'personalblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ads_img_link4'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img_link4')); ?>" value="<?php echo esc_attr($instance['ads_img_link4']); ?>">

			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img4' )); ?>"><?php esc_html_e( 'Ads Image URL 4', 'personalblog' ); ?></label>
			<input type="hidden" id="<?php echo esc_attr($this->get_field_id('ads_img4'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img4'));?>" class="<?php echo esc_attr($this->get_field_id('ads_img4'));?>" value="<?php echo esc_attr($instance['ads_img4']); ?>"/>
 			<button id="<?php echo esc_attr($this->get_field_id('ads_img4'));?>" class="custom-upload button" data-url="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html__('Upload image','personalblog'); ?></button>
 			<img class="<?php echo esc_attr($this->get_field_id('ads_img4'));?>" src="<?php echo esc_url(get_site_url()) . esc_attr($instance['ads_img4']); ?> "/>
		</p>

		<!--/image ads5-->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img_link5' )); ?>"><?php esc_html_e( 'Ads Link 5', 'personalblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ads_img_link5'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img_link5')); ?>" value="<?php echo esc_attr($instance['ads_img_link5']); ?>">

			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img5' )); ?>"><?php esc_html_e( 'Ads Image URL 5', 'personalblog' ); ?></label>
			<input type="hidden" id="<?php echo esc_attr($this->get_field_id('ads_img5'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img5'));?>" class="<?php echo esc_attr($this->get_field_id('ads_img5'));?>" value="<?php echo esc_attr($instance['ads_img5']); ?>"/>
 			<button id="<?php echo esc_attr($this->get_field_id('ads_img5'));?>" class="custom-upload button" data-url="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html__('Upload image','personalblog'); ?></button>
 			<img class="<?php echo esc_attr($this->get_field_id('ads_img5'));?>" src="<?php echo esc_url(get_site_url()) . esc_attr($instance['ads_img5']); ?> "/>
		</p>

		<!--/image ads6-->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img_link6' )); ?>"><?php esc_html_e( 'Ads Link 6', 'personalblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ads_img_link6'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img_link6')); ?>" value="<?php echo esc_attr($instance['ads_img_link6']); ?>">

			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img6' )); ?>"><?php esc_html_e( 'Ads Image URL 6', 'personalblog' ); ?></label>
			<input type="hidden" id="<?php echo esc_attr($this->get_field_id('ads_img6'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img6'));?>" class="<?php echo esc_attr($this->get_field_id('ads_img6'));?>" value="<?php echo esc_attr($instance['ads_img6']); ?>"/>
 			<button id="<?php echo esc_attr($this->get_field_id('ads_img6'));?>" class="custom-upload button" data-url="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html__('Upload image','personalblog'); ?></button>
 			<img class="<?php echo esc_attr($this->get_field_id('ads_img6'));?>" src="<?php echo esc_url(get_site_url()) . esc_attr($instance['ads_img6']); ?> "/>
		</p>

		<!--/image ads7-->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img_link7' )); ?>"><?php esc_html_e( 'Ads Link 7', 'personalblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ads_img_link7'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img_link7')); ?>" value="<?php echo esc_attr($instance['ads_img_link7']); ?>">

			<label for="<?php echo esc_attr($this->get_field_id( 'ads_img7' )); ?>"><?php esc_html_e( 'Ads Image URL 7', 'personalblog' ); ?></label>
			<input type="hidden" id="<?php echo esc_attr($this->get_field_id('ads_img7'));?>" name="<?php echo esc_attr($this->get_field_name('ads_img7'));?>" class="<?php echo esc_attr($this->get_field_id('ads_img7'));?>" value="<?php echo esc_attr($instance['ads_img7']); ?>"/>
 			<button id="<?php echo esc_attr($this->get_field_id('ads_img7'));?>" class="custom-upload button" data-url="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html__('Upload image','personalblog'); ?></button>
 			<img class="<?php echo esc_attr($this->get_field_id('ads_img7'));?>" src="<?php echo esc_url(get_site_url()) . esc_attr($instance['ads_img7']); ?> "/>
		</p>
	
		<?php
	}
}