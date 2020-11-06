<?php

add_action('widgets_init','register_crowdfunding_blog_posts_widget');

function register_crowdfunding_blog_posts_widget()
{
	register_widget('crowdfunding_blog_posts_widget');
}

class crowdfunding_blog_posts_widget extends WP_Widget{

	public function __construct()
	{
		parent::__construct( 'crowdfunding_blog_posts_widget','Crowdfunding blog Posts',array('description' => 'Crowdfunding post widget to display blog posts'));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget($args, $instance)
	{
		extract($args);

		$title 			= apply_filters('widget_title', $instance['title'] );
		$count 			= $instance['count'];
		$order_by 		= $instance['order_by'];
		
		echo $before_widget;

		$output = '';

		if ( $title )
			echo $before_title . $title . $after_title;

		global $post;

		if ( $order_by == 'latest' ) {

			$args = array( 
				'posts_per_page' => $count,
				'order' => 'DESC'
				);

		} else if ( $order_by == 'popular' ) {

			$args = array( 
				'orderby' => 'meta_value_num',
				'meta_key' => 'post_views_count',
				'posts_per_page' => $count,
				'order' => 'DESC'
				);

		} else {

			$args = array( 
				'orderby' => 'comment_count',
				'order' => 'DESC',
				'posts_per_page' => $count
				);

		}


		$posts = get_posts( $args );

		if(count($posts)>0){
			$output .='<div class="widget-blog-posts ' . $order_by . '">';

			foreach ($posts as $post): setup_postdata($post);
				$output .='<div class="media">';

					if(has_post_thumbnail()):
						$output .='<div class="pull-left">';
						$output .='<a href="'.get_permalink().'">'.get_the_post_thumbnail( get_the_ID(), 'xs-thumb', array('class' => 'img-responsive')).'</a>';
						$output .='</div>';
					endif;

					$output .='<div class="media-body">';
					$output .= '<div class="latest-entry-meta"><span class="entry-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="entry-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date('l, M d, Y') ) . '</time></a></span></div>';
					$output .= '<h4 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h4>';
					$output .='</div>';

				$output .='</div>';
			endforeach;

			wp_reset_postdata();

			$output .='</div>';
		}


		echo $output;

		echo $after_widget;
	}


	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['order_by'] 		= strip_tags( $new_instance['order_by'] );
		$instance['count'] 			= strip_tags( $new_instance['count'] );

		return $instance;
	}


	function form($instance)
	{
		$defaults = array( 
			'title' 	=> 'Popular Posts',
			'order_by' 	=> 'popular',
			'count' 	=> 5
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Widget Title', 'crowdfunding'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>"><?php _e('Ordered By', 'crowdfunding'); ?></label>
			<?php 
				$options = array(
					'popular' 	=> 'Popular',
					'latest' 	=> 'Latest', 
					'comments'	=> 'Most Commented'
					);
				if(isset($instance['order_by'])) $order_by = esc_attr($instance['order_by']);
			?>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'order_by' )); ?>">
				<?php
				$op = '<option value="%s"%s>%s</option>';

				foreach ($options as $key=>$value ) {

					if ($order_by === $key) {
			            printf($op, $key, ' selected="selected"', $value);
			        } else {
			            printf($op, $key, '', $value);
			        }
			    }
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e('Count', 'crowdfunding'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($instance['count']); ?>" style="width:100%;" />
		</p>

	<?php
	}
}