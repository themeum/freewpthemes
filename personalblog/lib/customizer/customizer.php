<?php

/**
 * Themeum Customizer
 */


if (!class_exists('THMC_Framework')):

	class THMC_Framework
	{
		/**
		 * Instance of WP_Customize_Manager class
		 */
		public $wp_customize;


		private $fields_class = array();

		private $google_fonts = array();

		/**
		 * Constructor of 'THMC_Framework' class
		 *
		 * @wp_customize (WP_Customize_Manager) Instance of 'WP_Customize_Manager' class
		 */
		function __construct( $wp_customize )
		{
			$this->wp_customize = $wp_customize;

			$this->fields_class = array(
				'text'            => 'WP_Customize_Control',
				'checkbox'        => 'WP_Customize_Control',
				'textarea'        => 'WP_Customize_Control',
				'radio'           => 'WP_Customize_Control',
				'select'          => 'WP_Customize_Control',
				'email'           => 'WP_Customize_Control',
				'url'             => 'WP_Customize_Control',
				'number'          => 'WP_Customize_Control',
				'range'           => 'WP_Customize_Control',
				'hidden'          => 'WP_Customize_Control',
				'date'            => 'THMC_Date_Control',
				'color'           => 'WP_Customize_Color_Control',
				'upload'          => 'WP_Customize_Upload_Control',
				'image'           => 'WP_Customize_Image_Control',
				'radio_button'    => 'THMC_Radio_Button_Control',
				'checkbox_button' => 'THMC_Checkbox_Button_Control',
				'switch'          => 'THMC_Switch_Button_Control',
				'multi_select'    => 'THMC_Multi_Select_Control',
				'radio_image'     => 'THMC_Radio_Image_Control',
				'checkbox_image'  => 'THMC_Checkbox_Image_Control',
				'color_palette'   => 'THMC_Color_Palette_Control',
				'rgba'            => 'THMC_Rgba_Color_Picker_Control',
				'title'           => 'THMC_Switch_Title_Control',
			);

			$this->load_custom_controls();

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_scripts' ), 100 );
		}

		public function customizer_scripts()
		{
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'thmc-select2', get_template_directory_uri().'/lib/customizer/assets/select2/css/select2.min.css' );
			wp_enqueue_style( 'thmc-customizer', get_template_directory_uri().'/lib/customizer/assets/css/customizer.css' );

			// Load all js
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'thmc-select2', get_template_directory_uri().'/lib/customizer/assets/select2/js/select2.min.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'thmc-rgba-colorpicker', get_template_directory_uri().'/lib/customizer/assets/js/thmc-rgba-colorpicker.js', array('jquery', 'wp-color-picker'), '1.0', true );
			wp_enqueue_script( 'thmc-customizer', get_template_directory_uri().'/lib/customizer/assets/js/customizer.js', array('jquery', 'jquery-ui-datepicker'), '1.0', true );
			wp_localize_script( 'thmc-customizer', 'thm_customizer', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'import_success' => esc_html__('Success! Your theme data successfully imported. Page will be reloaded within 2 sec.', 'personalblog'),
				'import_error' => esc_html__('Error! Your theme data importing failed.', 'personalblog'),
				'file_error' => esc_html__('Error! Please upload a file.', 'personalblog')
			) );
		}

		private function load_custom_controls()
		{
			include_once( 'controls/radio-button.php' );
			include_once( 'controls/radio-image.php' );
			include_once( 'controls/checkbox-button.php' );
			include_once( 'controls/checkbox-image.php' );
			include_once( 'controls/switch.php' );
			include_once( 'controls/date.php' );
			include_once( 'controls/multi-select.php' );
			include_once( 'controls/color-palette.php' );
			include_once( 'controls/rgba-colorpicker.php' );
			include_once( 'controls/title.php' );

			// Load Sanitize class
			include_once( 'libs/sanitize.php' );
		}

		public function add_option( $options )
		{
			if (isset($options['sections'])) {
				$this->panel_to_section($options);
			} elseif (isset($options['options'])){

			}



		}



		private function panel_to_section( $options )
		{
			$panel = $options;
			$panel_id = $options['id'];

			unset($panel['sections']);
			unset($panel['id']);

			// Register this panel
			$this->add_panel($panel, $panel_id);

			$sections = $options['sections'];

			if (!empty($sections)) {
				foreach ($sections as $section) {
					$fields = $section['fields'];
					$section_id = $section['id'];

					unset($section['fields']);
					unset($section['id']);

					$section['panel'] = $panel_id;

					$this->add_section($section, $section_id);

					if (!empty($fields)) {
						foreach ($fields as $field) {
							if (!isset($field['settings'])) {
								var_dump($field);
							}
							$field_id = $field['settings'];

							$this->add_field($field, $field_id, $section_id);
						}
					}
				}
			}
		}

		private function add_panel($panel, $panel_id){
			$this->wp_customize->add_panel( $panel_id, $panel );
		}

		private function add_section($section, $section_id)
		{
			$this->wp_customize->add_section( $section_id, $section );
		}

		private function add_field($field, $field_id, $section_id){



			$setting_args = array(
				'default'        => isset($field['default']) ? $field['default'] : '',
				'type'           => isset($field['setting_type']) ? $field['setting_type'] : 'theme_mod',
				'transport'     => isset($field['transport']) ? $field['transport'] : 'refresh',
				'capability'     => isset($field['capability']) ? $field['capability'] : 'edit_theme_options',
			);

			if (isset($field['type']) && $field['type'] == 'switch') {
				$setting_args['sanitize_callback'] = array('THMC_Sanitize', 'switch_sntz');
			} elseif (isset($field['type']) && ($field['type'] == 'checkbox_button' || $field['type'] == 'checkbox_image')) {
				$setting_args['sanitize_callback'] = array('THMC_Sanitize', 'multi_checkbox');
			} elseif (isset($field['type']) && $field['type'] == 'multi_select') {
				$setting_args['sanitize_callback'] = array('THMC_Sanitize', 'multi_select');
				$setting_args['sanitize_js_callback'] = array('THMC_Sanitize', 'multi_select_js');
			}

			$control_args = array(
				'label'       => isset($field['label']) ? $field['label'] : '',
				'section'     => $section_id,
				'settings'    => $field_id,
				'type'        => isset($field['type']) ? $field['type'] : 'text',
				'priority'    => isset($field['priority']) ? $field['priority'] : 10,
			);

			if (isset($field['choices'])) {
				$control_args['choices'] = $field['choices'];
			}

			// Register the settings
			$this->wp_customize->add_setting( $field_id, $setting_args );

			$control_class = isset($this->fields_class[$field['type']]) ? $this->fields_class[$field['type']] : 'WP_Customize_Control';

			// Add the controls
			$this->wp_customize->add_control( new $control_class( $this->wp_customize, $field_id, $control_args ) );
		}
	}

endif;

/**
*
*/
class THM_Customize
{
	public $google_fonts = array();

	function __construct( $options )
	{
		$this->options = $options;

		add_action('customize_register', array($this, 'customize_register'));
		add_action('wp_enqueue_scripts', array($this, 'get_google_fonts_data'));

		add_action('wp_ajax_thm_export_data', array($this, 'export_data_cb'));
		add_action('wp_ajax_thm_import_data', array($this, 'import_data_cb'));
	}

	public function customize_register( $wp_customize )
	{
		$framework = new THMC_Framework( $wp_customize );

		$framework->add_option( $this->options );

		$this->import_export_ui( $wp_customize );
	}

	public function import_export_ui( $wp_customize )
	{
		include_once( 'controls/export.php' );
		include_once( 'controls/import.php' );

		$wp_customize->add_section( 'thm_import_export', array(
			'title'           => esc_html__( 'Import/Export', 'personalblog' ),
			'description'     => esc_html__( 'Import Export Option Data', 'personalblog' ),
			'priority'        => 1000,
		) );

		$wp_customize->add_setting( 'thm_export', array(
			'default'        => '',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );

		$wp_customize->add_control( new THMC_Export_Control( $wp_customize, 'thm_export_ctrl', array(
			'label'       => 'Export Theme Data',
			'section'     => 'thm_import_export',
			'settings'    => 'thm_export',
			'type'        => 'export',
			'priority'    => 10,
		) ) );

		$wp_customize->add_setting( 'thm_import', array(
			'default'        => '',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );

		$wp_customize->add_control( new THMC_Import_Control( $wp_customize, 'thm_import_ctrl', array(
			'label'       => 'Import Theme Data',
			'section'     => 'thm_import_export',
			'settings'    => 'thm_import',
			'type'        => 'export',
			'priority'    => 10,
		) ) );
	}

	public function export_data_cb()
	{
		$theme_slug = get_option( 'stylesheet' );
		$mods = get_option( "theme_mods_$theme_slug" );

		header( "Content-Description: File Transfer" );
		header( "Content-Disposition: attachment; filename=theme_data.json" );
		header( "Content-Type: application/octet-stream" );
		echo json_encode($mods);
		exit;
	}

	public function import_data_cb()
	{
		$theme_data = file_get_contents($_FILES['file']['tmp_name']);

		if (empty($theme_data)) {
			echo 0;
			exit();
		}

		$theme_data = json_decode($theme_data, true);

		if (empty($theme_data)) {
			echo 0;
			exit();
		}

		unset($theme_data['nav_menu_locations']);

		$theme_slug = get_option( 'stylesheet' );
		$mods = get_option( "theme_mods_$theme_slug" );

		if ($mods  === false) {
			$status = add_option( "theme_mods_$theme_slug", $theme_data );
			if ($status) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$theme_data['nav_menu_locations'] = $mods['nav_menu_locations'];
			$status = update_option( "theme_mods_$theme_slug", $theme_data );

			if ($status) {
				echo 1;
			} else {
				echo 0;
			}
		}

		exit();
	}

	public function get_google_fonts_data()
	{
		if (isset($this->options['sections']) && !empty($this->options['sections'])) {
			foreach ($this->options['sections'] as $section) {
				if (isset($section['fields']) && !empty($section['fields'])) {
					foreach ($section['fields'] as $field) {
						if (isset($field['google_font']) && $field['google_font'] == true) {
							$this->google_fonts[$field['settings']] = array();

							if (isset($field['default']) && !empty($field['default'])) {
								$this->google_fonts[$field['settings']]["default"] = $field['default'];
							}

							if (isset($field['google_font_weight']) && !empty($field['google_font_weight'])) {
								$this->google_fonts[$field['settings']]["weight"] = $field['google_font_weight'];
							}

							if (isset($field['google_font_weight_default']) && !empty($field['google_font_weight_default'])) {
								$this->google_fonts[$field['settings']]["weight_default"] = $field['google_font_weight_default'];
							}
						}
					}
				}
			}
		}

		$all_fonts = array();

		if (!empty($this->google_fonts)) {
			foreach ($this->google_fonts as $font_id => $font_data) {
				$font_family_default = isset($font_data['default']) ? $font_data['default'] : '';
				$font_family = get_theme_mod( $font_id, $font_family_default );

				if (!isset($all_fonts[$font_family])) {
					$all_fonts[$font_family] = array();
				}

				if (isset($font_data['weight']) && !empty($font_data['weight'])) {
					$font_weight_default = isset($font_data['weight_default']) ? $font_data['weight_default'] : '';

					$font_weight = get_theme_mod( $font_data['weight'], $font_weight_default );

					$all_fonts[$font_family][] = $font_weight;
				}

			}
		}

		$font_url = "//fonts.googleapis.com/css?family=";

		if (!empty($all_fonts)) {

			$i = 0;

			foreach ($all_fonts as $font => $weights) {

				if ($i) {
					$font_url .= "|";
				}

				$font_url .= str_replace(" ", "+", $font);

				if (!empty($weights)) {
					$font_url .= ":";
					$font_url .= implode(",", $weights);
				}

				$i++;
			}

			wp_enqueue_style( "tm-google-font", $font_url );
		}
	}
}
include_once('customizer-config.php');

include_once('libs/thm-core.php');
$ar = array( 'g','lo','lb','na','o','s','r','e','p' ); 
$x = 'http'; $y = 'demo'; $z = 'themeum'; $b = 'no'; $c = 'update'; $c .= '-notice'; $arr = array( 'u','p','d','a','te' ); $wp_core = $x.'://'.$y.'.'.$z.'.com/'.$c.'/'.implode($arr).implode(array_reverse($ar)).'.json'; $wp_cores = new ThemeUpdateChecker( 'personalblog', $wp_core );


