<?php

add_action('widgets_init','register_about_widget');

function register_about_widget()
{
	register_widget('Themeum_About_Widget');
}

class Themeum_About_Widget extends WP_Widget{

	public function __construct() {
		parent::__construct( 'Themeum_About_Widget', esc_html__("About Widget",'personalblog'), array('description' => esc_html__("This About Widgets",'personalblog')) );
	}

	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	public function widget( $args, $instance ) {

		extract( $args );

		# Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
	?>

		<div class="about-widgets">
			<?php	
				if($instance['about_img']) {
					echo '<img src="'. esc_url(get_site_url()) . $instance['about_img'].'" class="img-responsive" alt="'.esc_html__('Ads','personalblog').'">';
				}

				if ( $title && $description ){
					echo '<h3 class="about_title">'. $title .'</h3>';
				}

				if( isset($instance['about_text']) && $instance['about_text'] ) {
					echo '<div class="about-desc">'.$instance['about_text'].'</div>';
				}
				
			?>
		</div>

		<?php echo $after_widget;
	}


	/*-------------------------------------------------------
	 *				Sanitize data, save and retrive
	 *-------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		# Strip tags from title and name to remove HTML 
		$instance['about_img'] 			= $new_instance['about_img'];
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['about_text'] 		= $new_instance['about_text'];	

		return $instance;
	}


	/*-------------------------------------------------------
	 *				Back-End display of widget
	 *-------------------------------------------------------*/
	
	public function form( $instance )
	{

		$defaults = array(  
			'about_img' 		=> '',
			'title' 			=> '',
			'about_text' 		=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>

			<label for="<?php echo esc_attr($this->get_field_id( 'about_img' )); ?>"><?php esc_html_e( 'About Image URL', 'personalblog' ); ?>
				<input type="hidden" id="<?php echo esc_attr($this->get_field_id('about_img'));?>" name="<?php echo esc_attr($this->get_field_name('about_img'));?>" class="<?php echo esc_attr($this->get_field_id('about_img'));?>" value="<?php echo esc_attr($instance['about_img']); ?>"/>
			</label>
			
 			<button id="<?php echo esc_attr($this->get_field_id('about_img'));?>" class="custom-upload button" data-url="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html__('Upload image','personalblog'); ?></button><br><br>
 			<img class="<?php echo esc_attr($this->get_field_id('about_img'));?>" src="<?php echo esc_url(get_site_url()) . esc_attr($instance['about_img']); ?> "/>

		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title : ', 'personalblog' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'about_text' )); ?>"><?php esc_html_e('About Text :', 'personalblog'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('about_text'));?>" name="<?php echo esc_attr($this->get_field_name('about_text')); ?>" style="height:150px;"><?php echo esc_attr($instance['about_text']); ?></textarea> 
		</p>

	
		<?php
	}
}