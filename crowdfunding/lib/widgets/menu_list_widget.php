<?php

add_action('widgets_init','menu_list_widget');

function menu_list_widget()
{
	register_widget('Menu_List_Widget');
}

class Menu_List_Widget extends WP_Widget{

	public function __construct()
	{
		parent::__construct( 'Menu_List_Widget','Menu List Widgets',array('description' => 'This Menu List Widgets'));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

 function widget( $args, $instance ) {
	 // Get menu
	 $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

	 if ( !$nav_menu )
		 return;

	 /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
	 $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

	 echo $args['before_widget'];

	 if ( !empty($instance['title']) )
		 echo $args['before_title'] . $instance['title'] . $args['after_title'];

	 $nav_menu_args = array(
		 'fallback_cb' => '',
		 'menu'        => $nav_menu
	 );
	 wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

	 echo $args['after_widget'];
	}


	/*-------------------------------------------------------
	 *				Sanitize data, save and retrive
	 *-------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}


	/*-------------------------------------------------------
	 *				Back-End display of widget
	 *-------------------------------------------------------*/
	
	function form( $instance )
	{

		$title = isset($instance['title']) ? $instance['title'] : '';
		$nav_menu = isset($instance['nav_menu']) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if (!empty($menus)) {
			echo ' style="display:none" ';
		} ?>>
			<?php
			if (isset($GLOBALS['wp_customize']) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url('nav-menus.php');
			}
			?>
			<?php echo sprintf(__('No menus have been created yet. <a href="%s">Create some</a>.'), esc_attr($url)); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if (empty($menus)) {
			echo ' style="display:none" ';
		} ?>>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','crowdfunding') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
					   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:','crowdfunding'); ?></label>
				<select id="<?php echo $this->get_field_id('nav_menu'); ?>"
						name="<?php echo $this->get_field_name('nav_menu'); ?>">
					<option value="0"><?php _e('&mdash; Select &mdash;','crowdfunding'); ?></option>
					<?php foreach ($menus as $menu) : ?>
						<option
							value="<?php echo esc_attr($menu->term_id); ?>" <?php selected($nav_menu, $menu->term_id); ?>>
							<?php echo esc_html($menu->name); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}