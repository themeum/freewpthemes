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

		public function customizer_scripts(){
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'thmc-select2', MYTHOS_URI.'lib/customizer/assets/select2/css/select2.min.css' );
			wp_enqueue_style( 'thmc-customizer', MYTHOS_URI.'lib/customizer/assets/css/customizer.css' );

			// JS
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'thmc-select2', MYTHOS_URI.'lib/customizer/assets/select2/js/select2.min.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'thmc-rgba-colorpicker', MYTHOS_URI.'lib/customizer/assets/js/thmc-rgba-colorpicker.js', array('jquery', 'wp-color-picker'), '1.0', true );
			wp_enqueue_script( 'thmc-customizer', MYTHOS_URI.'lib/customizer/assets/js/customizer.js', array('jquery', 'jquery-ui-datepicker'), '1.0', true );


			wp_localize_script( 'thmc-customizer', 'thm_customizer', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'import_success' => esc_html__('Success! Your theme data successfully imported. Page will be reloaded within 2 sec.', 'mythos-pro'),
				'import_error' => esc_html__('Error! Your theme data importing failed.', 'mythos-pro'),
				'file_error' => esc_html__('Error! Please upload a file.', 'mythos-pro')
			) );
		}

		private function load_custom_controls(){
			get_template_part('lib/customizer/controls/radio-button');
            get_template_part('lib/customizer/controls/radio-image');
            get_template_part('lib/customizer/controls/checkbox-button');
            get_template_part('lib/customizer/controls/checkbox-image');
            get_template_part('lib/customizer/controls/switch');
            get_template_part('lib/customizer/controls/date');
            get_template_part('lib/customizer/controls/multi-select');
            get_template_part('lib/customizer/controls/color-palette');
            get_template_part('lib/customizer/controls/rgba-colorpicker');
            get_template_part('lib/customizer/controls/title');

            // Load Sanitize class
            get_template_part('lib/customizer/libs/sanitize');
		}

		public function add_option( $options ){
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

		get_template_part( 'lib/customizer/controls/export' );
        get_template_part( 'lib/customizer/controls/import' );

		$wp_customize->add_section( 'thm_import_export', array(
			'title'           => esc_html__( 'Import/Export', 'mythos-pro' ),
			'description'     => esc_html__( 'Import Export Option Data', 'mythos-pro' ),
			'priority'        => 1000,
		) );

		$wp_customize->add_setting( 'thm_export', array(
			'default'        => '',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr',
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
			'sanitize_callback' => 'esc_attr',
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
		$theme_data = WP_Filesystem($_FILES['file']['tmp_name']);

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
					$font_url .= "%7C";
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



// Customizer Section
$panel_to_section = array(
	'id'           => 'mythos_pro_panel_options',
	'title'        => esc_html( 'Mythos Pro Options', 'mythos-pro' ),
	'description'  => esc_html__( 'Mythos Pro Theme Options', 'mythos-pro' ),
	'priority'     => 10,
	
	'sections'     => array(
		array(
			'id'              => 'topbar_setting',
			'title'           => esc_html__( 'Topbar Settings', 'mythos-pro' ),
			'description'     => esc_html__( 'Topbar Settings', 'mythos-pro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'topbar_en',
					'label'    => esc_html__( 'Topbar Enable/Disable', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),				
				array(
					'settings' => 'topbar_email',
					'label'    => esc_html__( 'Topbar Email', 'mythos-pro' ),
					'type'     => 'email',
					'priority' => 10,
					'default'  => 'support@themeum.com',
				
				),
				array(
					'settings' => 'topbar_phone',
					'label'    => esc_html__( 'Topbar Phone Number', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '+00 44 123 456 78910',
				
				),
				// Woocart.
				array(
					'settings' => 'woocart_en',
					'label'    => esc_html__( 'Woocart Enable/Disable', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'topbar_social',
					'label'    => esc_html__( 'Topbar Social', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),				
				array(
					'settings' => 'topbar_text_color',
					'label'    => esc_html__( 'Topbar Text/Link Color', 'mythos-pro' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => 'rgba(255, 255, 255, 0.6)',
				),

				array(
					'settings' => 'topbar_link_hover_color',
					'label'    => esc_html__( 'Topbar Link Hover color', 'mythos-pro' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#fff',
				),
			)//fields
		),//topbar_setting



		

		array(
			'id'              => 'header_setting',
			'title'           => esc_html__( 'Header Settings', 'mythos-pro' ),
			'description'     => esc_html__( 'Header Settings', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'menu_border_color',
					'label'    => esc_html__( 'Menu Border Color', 'mythos-pro' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#eaeaea',
				),
				array(
					'settings' => 'header_fixed',
					'label'    => esc_html__( 'Sticky Header', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'sticky_header_color',
					'label'    => esc_html__( 'Sticky background Color', 'mythos-pro' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#151416',
				),
		
				
			) # Fields
		), # Header_setting


		array(
			'id'              => 'logo_setting',
			'title'           => esc_html__( 'All Logo', 'mythos-pro' ),
			'description'     => esc_html__( 'All Logo', 'mythos-pro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'logo_style',
					'label'    => esc_html__( 'Select Header Style', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'logoimg',
					'choices'  => array(
						'logoimg' => esc_html( 'Logo image', 'mythos-pro' ),
						'logotext' => esc_html( 'Logo text', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'logo',
					'label'    => esc_html__( 'Upload Logo', 'mythos-pro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' 	=> get_template_directory_uri().'/images/logo.png',
				),
				array(
					'settings' => 'logo_width',
					'label'    => esc_html__( 'Logo Width', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 100,
				),
				array(
					'settings' => 'logo_height',
					'label'    => esc_html__( 'Logo Height', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
				),
				array(
					'settings' => 'logo_text',
					'label'    => esc_html__( 'Custom Logo Text', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'mythos-pro',
				),
				array(
					'settings' => 'logo-404',
					'label'    => esc_html__( 'Coming Soon Logo', 'mythos-pro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default'  => get_template_directory_uri().'/images/logo-404.png',
				),		
			) # Fields
		), #logo_setting
		
		array(
			'id'              => 'sub_header_banner',
			'title'           => esc_html__( 'Sub Header Banner', 'mythos-pro' ),
			'description'     => esc_html__( 'sub header banner', 'mythos-pro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'sub_header_padding_top',
					'label'    => esc_html__( 'Sub-Header Padding Top', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 130,
				),
				array(
					'settings' => 'sub_header_padding_bottom',
					'label'    => esc_html__( 'Sub-Header Padding Bottom', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 50,
				),
				array(
					'settings' => 'sub_header_banner_img',
					'label'    => esc_html__( 'Sub-Header Background Image', 'mythos-pro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' 	=> get_template_directory_uri().'/images/sub-header.jpg',
				),
				array(
					'settings' => 'sub_header_banner_color',
					'label'    => esc_html__( 'Sub-Header Background Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_title',
					'label'    => esc_html__( 'Title Settings', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_title_size',
					'label'    => esc_html__( 'Header Title Font Size', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => '13',
				),
				array(
					'settings' => 'sub_header_title_color',
					'label'    => esc_html__( 'Header Title Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#7e879a',
				),
			)//fields
		),//sub_header_banner


		array(
			'id'              => 'typo_setting',
			'title'           => esc_html__( 'Typography Setting', 'mythos-pro' ),
			'description'     => esc_html__( 'Typography Setting', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(

				array(
					'settings' => 'font_title_body',
					'label'    => esc_html__( 'Body Font Options', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//body font
				array(
					'settings' => 'body_google_font',
					'label'    => esc_html__( 'Select Google Font', 'mythos-pro' ),
					'type'     => 'select',
					'default'  => 'Open Sans',
					'choices'  => get_google_fonts(),
					'google_font' 					=> true,
					'google_font_weight' 			=> 'body_font_weight',
					'google_font_weight_default' 	=> '400'
				),
				array(
					'settings' => 'body_font_size',
					'label'    => esc_html__( 'Body Font Size', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'body_font_height',
					'label'    => esc_html__( 'Body Font Line Height', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'body_font_weight',
					'label'    => esc_html__( 'Body Font Weight', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '400',
					'choices'  => array(
						'' => esc_html( 'Select', 'mythos-pro' ),
						'100' => esc_html( '100', 'mythos-pro' ),
						'200' => esc_html( '200', 'mythos-pro' ),
						'300' => esc_html( '300', 'mythos-pro' ),
						'400' => esc_html( '400', 'mythos-pro' ),
						'500' => esc_html( '500', 'mythos-pro' ),
						'600' => esc_html( '600', 'mythos-pro' ),
						'700' => esc_html( '700', 'mythos-pro' ),
						'800' => esc_html( '800', 'mythos-pro' ),
						'900' => esc_html( '900', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'body_font_color',
					'label'    => esc_html__( 'Body Font Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#7e879a',
				),
				array(
					'settings' => 'font_title_menu',
					'label'    => esc_html__( 'Menu Font Options', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Menu font
				array(
					'settings' => 'menu_google_font',
					'label'    => esc_html__( 'Select Google Font', 'mythos-pro' ),
					'type'     => 'select',
					'default'  => 'Open Sans',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'menu_font_size',
					'label'    => esc_html__( 'Menu Font Size', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'menu_font_height',
					'label'    => esc_html__( 'Menu Font Line Height', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '54',
				),
				array(
					'settings' => 'menu_font_weight',
					'label'    => esc_html__( 'Menu Font Weight', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'mythos-pro' ),
						'100' => esc_html( '100', 'mythos-pro' ),
						'200' => esc_html( '200', 'mythos-pro' ),
						'300' => esc_html( '300', 'mythos-pro' ),
						'400' => esc_html( '400', 'mythos-pro' ),
						'500' => esc_html( '500', 'mythos-pro' ),
						'600' => esc_html( '600', 'mythos-pro' ),
						'700' => esc_html( '700', 'mythos-pro' ),
						'800' => esc_html( '800', 'mythos-pro' ),
						'900' => esc_html( '900', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'menu_font_color',
					'label'    => esc_html__( 'Menu Font Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

				array(
					'settings' => 'font_title_h1',
					'label'    => esc_html__( 'Heading 1 Font Options', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 1
				array(
					'settings' => 'h1_google_font',
					'label'    => esc_html__( 'Google Font', 'mythos-pro' ),
					'type'     => 'select',
					'default'  => 'Open Sans',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h1_font_size',
					'label'    => esc_html__( 'Font Size', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '44',
				),
				array(
					'settings' => 'h1_font_height',
					'label'    => esc_html__( 'Font Line Height', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '48',
				),
				array(
					'settings' => 'h1_font_weight',
					'label'    => esc_html__( 'Font Weight', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'mythos-pro' ),
						'100' => esc_html( '100', 'mythos-pro' ),
						'200' => esc_html( '200', 'mythos-pro' ),
						'300' => esc_html( '300', 'mythos-pro' ),
						'400' => esc_html( '400', 'mythos-pro' ),
						'500' => esc_html( '500', 'mythos-pro' ),
						'600' => esc_html( '600', 'mythos-pro' ),
						'700' => esc_html( '700', 'mythos-pro' ),
						'800' => esc_html( '800', 'mythos-pro' ),
						'900' => esc_html( '900', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'h1_font_color',
					'label'    => esc_html__( 'Font Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#151416',
				),

				array(
					'settings' => 'font_title_h2',
					'label'    => esc_html__( 'Heading 2 Font Options', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 2
				array(
					'settings' => 'h2_google_font',
					'label'    => esc_html__( 'Google Font', 'mythos-pro' ),
					'type'     => 'select',
					'default'  => 'Open Sans',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '600'
				),
				array(
					'settings' => 'h2_font_size',
					'label'    => esc_html__( 'Font Size', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '30',
				),
				array(
					'settings' => 'h2_font_height',
					'label'    => esc_html__( 'Font Line Height', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_weight',
					'label'    => esc_html__( 'Font Weight', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '600',
					'choices'  => array(
						'' => esc_html( 'Select', 'mythos-pro' ),
						'100' => esc_html( '100', 'mythos-pro' ),
						'200' => esc_html( '200', 'mythos-pro' ),
						'300' => esc_html( '300', 'mythos-pro' ),
						'400' => esc_html( '400', 'mythos-pro' ),
						'500' => esc_html( '500', 'mythos-pro' ),
						'600' => esc_html( '600', 'mythos-pro' ),
						'700' => esc_html( '700', 'mythos-pro' ),
						'800' => esc_html( '800', 'mythos-pro' ),
						'900' => esc_html( '900', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'h2_font_color',
					'label'    => esc_html__( 'Font Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#151416',
				),

				array(
					'settings' => 'font_title_h3',
					'label'    => esc_html__( 'Heading 3 Font Options', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 3
				array(
					'settings' => 'h3_google_font',
					'label'    => esc_html__( 'Google Font', 'mythos-pro' ),
					'type'     => 'select',
					'default'  => 'Open Sans',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '600'
				),
				array(
					'settings' => 'h3_font_size',
					'label'    => esc_html__( 'Font Size', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '22',
				),
				array(
					'settings' => 'h3_font_height',
					'label'    => esc_html__( 'Font Line Height', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '28',
				),
				array(
					'settings' => 'h3_font_weight',
					'label'    => esc_html__( 'Font Weight', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '600',
					'choices'  => array(
						'' => esc_html( 'Select', 'mythos-pro' ),
						'100' => esc_html( '100', 'mythos-pro' ),
						'200' => esc_html( '200', 'mythos-pro' ),
						'300' => esc_html( '300', 'mythos-pro' ),
						'400' => esc_html( '400', 'mythos-pro' ),
						'500' => esc_html( '500', 'mythos-pro' ),
						'600' => esc_html( '600', 'mythos-pro' ),
						'700' => esc_html( '700', 'mythos-pro' ),
						'800' => esc_html( '800', 'mythos-pro' ),
						'900' => esc_html( '900', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'h3_font_color',
					'label'    => esc_html__( 'Font Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#151416',
				),

				array(
					'settings' => 'font_title_h4',
					'label'    => esc_html__( 'Heading 4 Font Options', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 4
				array(
					'settings' => 'h4_google_font',
					'label'    => esc_html__( 'Heading4 Google Font', 'mythos-pro' ),
					'type'     => 'select',
					'default'  => 'Open Sans',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '600'
				),
				array(
					'settings' => 'h4_font_size',
					'label'    => esc_html__( 'Heading4 Font Size', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '17',
				),
				array(
					'settings' => 'h4_font_height',
					'label'    => esc_html__( 'Heading4 Font Line Height', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '22',
				),
				array(
					'settings' => 'h4_font_weight',
					'label'    => esc_html__( 'Heading4 Font Weight', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '600',
					'choices'  => array(
						'' => esc_html( 'Select', 'mythos-pro' ),
						'100' => esc_html( '100', 'mythos-pro' ),
						'200' => esc_html( '200', 'mythos-pro' ),
						'300' => esc_html( '300', 'mythos-pro' ),
						'400' => esc_html( '400', 'mythos-pro' ),
						'500' => esc_html( '500', 'mythos-pro' ),
						'600' => esc_html( '600', 'mythos-pro' ),
						'700' => esc_html( '700', 'mythos-pro' ),
						'800' => esc_html( '800', 'mythos-pro' ),
						'900' => esc_html( '900', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'h4_font_color',
					'label'    => esc_html__( 'Heading4 Font Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#151416',
				),

				array(
					'settings' => 'font_title_h5',
					'label'    => esc_html__( 'Heading 5 Font Options', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),

				//Heading 5
				array(
					'settings' => 'h5_google_font',
					'label'    => esc_html__( 'Heading5 Google Font', 'mythos-pro' ),
					'type'     => 'select',
					'default'  => 'Open Sans',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '600'
				),
				array(
					'settings' => 'h5_font_size',
					'label'    => esc_html__( 'Heading5 Font Size', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'h5_font_height',
					'label'    => esc_html__( 'Heading5 Font Line Height', 'mythos-pro' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'h5_font_weight',
					'label'    => esc_html__( 'Heading5 Font Weight', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '600',
					'choices'  => array(
						'' => esc_html( 'Select', 'mythos-pro' ),
						'100' => esc_html( '100', 'mythos-pro' ),
						'200' => esc_html( '200', 'mythos-pro' ),
						'300' => esc_html( '300', 'mythos-pro' ),
						'400' => esc_html( '400', 'mythos-pro' ),
						'500' => esc_html( '500', 'mythos-pro' ),
						'600' => esc_html( '600', 'mythos-pro' ),
						'700' => esc_html( '700', 'mythos-pro' ),
						'800' => esc_html( '800', 'mythos-pro' ),
						'900' => esc_html( '900', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'h5_font_color',
					'label'    => esc_html__( 'Heading5 Font Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#151416',
				),

			)//fields
		),//typo_setting

		array(
			'id'              => 'layout_styling',
			'title'           => esc_html__( 'Layout & Styling', 'mythos-pro' ),
			'description'     => esc_html__( 'Layout & Styling', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'boxfull_en',
					'label'    => esc_html__( 'Select BoxWidth of FullWidth', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'fullwidth',
					'choices'  => array(
						'boxwidth' => esc_html__( 'BoxWidth', 'mythos-pro' ),
						'fullwidth' => esc_html__( 'FullWidth', 'mythos-pro' ),
					)
				),

				array(
					'settings' => 'body_bg_color',
					'label'    => esc_html__( 'Body Background Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'body_bg_img',
					'label'    => esc_html__( 'Body Background Image', 'mythos-pro' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'body_bg_attachment',
					'label'    => esc_html__( 'Body Background Attachment', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'fixed',
					'choices'  => array(
						'scroll' => esc_html__( 'Scroll', 'mythos-pro' ),
						'fixed' => esc_html__( 'Fixed', 'mythos-pro' ),
						'inherit' => esc_html__( 'Inherit', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'body_bg_repeat',
					'label'    => esc_html__( 'Body Background Repeat', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'no-repeat',
					'choices'  => array(
						'repeat' => esc_html__( 'Repeat', 'mythos-pro' ),
						'repeat-x' => esc_html__( 'Repeat Horizontally', 'mythos-pro' ),
						'repeat-y' => esc_html__( 'Repeat Vertically', 'mythos-pro' ),
						'no-repeat' => esc_html__( 'No Repeat', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'body_bg_size',
					'label'    => esc_html__( 'Body Background Size', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'cover',
					'choices'  => array(
						'cover' => esc_html__( 'Cover', 'mythos-pro' ),
						'contain' => esc_html__( 'Contain', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'body_bg_position',
					'label'    => esc_html__( 'Body Background Position', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'left top',
					'choices'  => array(
						'left top' => esc_html__('left top', 'mythos-pro'),
						'left center' => esc_html__('left center', 'mythos-pro'),
						'left bottom' => esc_html__('left bottom', 'mythos-pro'),
						'right top' => esc_html__('right top', 'mythos-pro'),
						'right center' => esc_html__('right center', 'mythos-pro'),
						'right bottom' => esc_html__('right bottom', 'mythos-pro'),
						'center top' => esc_html__('center top', 'mythos-pro'),
						'center center' => esc_html__('center center', 'mythos-pro'),
						'center bottom' => esc_html__('center bottom', 'mythos-pro'),
					)
				),
				array(
					'settings' => 'custom_preset_en',
					'label'    => esc_html__( 'Set Custom Color', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'major_color',
					'label'    => esc_html__( 'Major Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#01c3ca',
				),
				array(
					'settings' => 'major_color2',
					'label'    => esc_html__( 'For Gradient Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#00d3a7',
				),
				array(
					'settings' => 'hover_color',
					'label'    => esc_html__( 'Hover Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#333',
				),
			
				# navbar color section start.
				array(
					'settings' => 'menu_color_title',
					'label'    => esc_html__( 'Menu Color Settings', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'navbar_text_color',
					'label'    => esc_html__( 'Text Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

				array(
					'settings' => 'navbar_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#02c0d0',
				),

				array(
					'settings' => 'navbar_active_text_color',
					'label'    => esc_html__( 'Active Text Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#02c0d0',
				),

				array(
					'settings' => 'sub_menu_color_title',
					'label'    => esc_html__( 'Sub-Menu Color Settings', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_menu_bg',
					'label'    => esc_html__( 'Background Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),
				array(
					'settings' => 'sub_menu_text_color',
					'label'    => esc_html__( 'Text Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#7e879a',
				),
				array(
					'settings' => 'sub_menu_text_color_hover',
					'label'    => esc_html__( 'Hover Text Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#02c0d0',
				),
				#End of the navbar color section
			)//fields
		),//Layout & Styling


		array(
			'id'              => 'social_media_settings',
			'title'           => esc_html__( 'Social Media', 'mythos-pro' ),
			'description'     => esc_html__( 'Social Media', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'wp_facebook',
					'label'    => esc_html__( 'Add Facebook URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_twitter',
					'label'    => esc_html__( 'Add Twitter URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				// array(
				// 	'settings' => 'wp_google_plus',
				// 	'label'    => esc_html__( 'Add Goole Plus URL', 'mythos-pro' ),
				// 	'type'     => 'text',
				// 	'priority' => 10,
				// 	'default'  => '#',
				// ),
				array(
					'settings' => 'wp_pinterest',
					'label'    => esc_html__( 'Add Pinterest URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_youtube',
					'label'    => esc_html__( 'Add Youtube URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_linkedin',
					'label'    => esc_html__( 'Add Linkedin URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_linkedin_user',
					'label'    => esc_html__( 'Linkedin Username( For Share )', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),

				array(
					'settings' => 'wp_instagram',
					'label'    => esc_html__( 'Add Instagram URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_dribbble',
					'label'    => esc_html__( 'Add Dribbble URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_behance',
					'label'    => esc_html__( 'Add Behance URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_flickr',
					'label'    => esc_html__( 'Add Flickr URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_vk',
					'label'    => esc_html__( 'Add Vk URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_skype',
					'label'    => esc_html__( 'Add Skype URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//social_media

		array(
			'id'              => 'coming_soon',
			'title'           => esc_html__( 'Coming Soon', 'mythos-pro' ),
			'description'     => esc_html__( 'Coming Soon', 'mythos-pro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'coming_soon_bg',
					'label'    => esc_html__( 'Coming Background Image', 'mythos-pro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default'  => get_template_directory_uri().'/images/coming-soon-bg.jpg',
				),

				array(
					'settings' => 'comingsoon_en',
					'label'    => esc_html__( 'Enable Coming Soon', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),

				array(
					'settings' => 'comingsoontitle',
					'label'    => esc_html__( 'Add Coming Soon Title', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__( 'Coming Soon', 'mythos-pro' ),
				),

				array(
					'settings' => 'countdown_en',
					'label'    => esc_html__( 'Enable Countdown', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'comingsoon_date',
					'label'    => esc_html__( 'Coming Soon date', 'mythos-pro' ),
					'type'     => 'date',
					'priority' => 10,
					'default'  => '2020-08-09',
				),
				array(
					'settings' => 'newsletter',
					'label'    => esc_html__( 'Add mailchimp Form Shortcode Here', 'mythos-pro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'coming_description',
					'label'    => esc_html__( 'Coming Soon Description', 'mythos-pro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__('We are come back soon', 'mythos-pro'),
				),
				array(
					'settings' => 'comingsoon_twitter',
					'label'    => esc_html__( 'Add Twitter URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_pinterest',
					'label'    => esc_html__( 'Add Pinterest URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_youtube',
					'label'    => esc_html__( 'Add Youtube URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_linkedin',
					'label'    => esc_html__( 'Add Linkedin URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_dribbble',
					'label'    => esc_html__( 'Add Dribbble URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_instagram',
					'label'    => esc_html__( 'Add Instagram URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
			) # Fields
		), # coming_soon

		# 404 Page.
		array(
			'id'              => '404_settings',
			'title'           => esc_html__( '404 Page', 'mythos-pro' ),
			'description'     => esc_html__( '404 page background and text settings', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(

				array(
					'settings' => 'error_404',
					'label'    => esc_html__( 'Background Image', 'mythos-pro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default'  => get_template_directory_uri().'/images/404.png',
				),
				array(
					'settings' => 'logo_404',
					'label'    => esc_html__( 'Upload Logo', 'mythos-pro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default'  => get_template_directory_uri().'/images/logo.png',
				),
				array(
					'settings' => '404_title',
					'label'    => esc_html__( '404 Page Title', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Oops, This Page Could Not Be Found!', 'mythos-pro')
				),
				array(
					'settings' => '404_description',
					'label'    => esc_html__( '404 Page Description', 'mythos-pro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => 'The page you are looking for might have been removed, had its name  changed, or is temporarily unavailable.'
				),
				array(
					'settings' => '404_btn_text',
					'label'    => esc_html__( 'Button Text', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Go Home',
				),
			)
		),


		// Shop Setting.
		array(
			'id'              => 'shop_setting',
			'title'           => esc_html__( 'Shop Setting', 'mythos-pro' ),
			'description'     => esc_html__( 'Shop Setting', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(

				array(
					'settings' => 'enable_sidebar',
					'label'    => esc_html__( 'Sidebar Enable', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'shop_post_count',
					'label'    => esc_html__( 'Number of Product', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '9',
				),
			)
		), // End Shop



		// Portfolio Setting.
		array(
			'id'              => 'portfolio_setting',
			'title'           => esc_html__( 'Portfolio Setting', 'mythos-pro' ),
			'description'     => esc_html__( 'Portfolio Setting', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'portfolio_style',
					'label'    => esc_html__( 'Select Style', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'layout1',
					'choices'  => array(
						'layout1' => esc_html( 'Style One', 'mythos-pro' ),
						'layout2' => esc_html( 'Style Two', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'portfolio_column',
					'label'    => esc_html__( 'Select Column', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '3',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'mythos-pro' ),
						'6' => esc_html( 'Column 2', 'mythos-pro' ),
						'4' => esc_html( 'Column 3', 'mythos-pro' ),
						'3' => esc_html( 'Column 4', 'mythos-pro' ),
					)
				),
			)
		), // End POrtfolio

		# Blog Settings.
		array(
			'id'              => 'blog_setting',
			'title'           => esc_html__( 'Blog Setting', 'mythos-pro' ),
			'description'     => esc_html__( 'Blog Setting', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'blog_column',
					'label'    => esc_html__( 'Select Blog Column', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '6',
					'choices'  => array(
						'12' 	=> esc_html( 'Column 1', 'mythos-pro' ),
						'6' 	=> esc_html( 'Column 2', 'mythos-pro' ),
						'4' 	=> esc_html( 'Column 3', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'blog_date',
					'label'    => esc_html__( 'Enable Blog Date', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'blog_author',
					'label'    => esc_html__( 'Enable Blog Author', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'blog_category',
					'label'    => esc_html__( 'Enable Blog Category', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_comment',
					'label'    => esc_html__( 'Enable Comment', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),

				array(
					'settings' => 'blog_intro_en',
					'label'    => esc_html__( 'Enable Blog Content', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),



				// Blog Call to action.
				array(
					'settings' => 'blog_call_header_title',
					'label'    => esc_html__( 'Blog Call to action Settings', 'mythos-pro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'enable_call_to_action',
					'label'    => esc_html__( 'Enable Call to action', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_calltoaction_title',
					'label'    => esc_html__( 'Title', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('OUR PURPOSE', 'mythos-pro')
				),
				array(
					'settings' => 'blog_calltoaction_subtitle',
					'label'    => esc_html__( 'Sub Title', 'mythos-pro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__('A Starter Guide To Self Improvement', 'mythos-pro')
				),

				array(
					'settings' => 'blog_button_one', 
					'label'    => esc_html__( 'Button One', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Get Start', 'mythos-pro')
				),
				array(
					'settings' => 'blog_button_url', 
					'label'    => esc_html__( 'Button One URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#'
				),
				array(
					'settings' => 'blog_button_two',
					'label'    => esc_html__( 'Button Two', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Work With us', 'mythos-pro')
				),
				array(
					'settings' => 'blog_button_url2', 
					'label'    => esc_html__( 'Button two URL', 'mythos-pro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#'
				),


				

			)//fields
		),//blog_setting

		array(
			'id'              => 'blog_single_setting',
			'title'           => esc_html__( 'Blog Single Page Setting', 'mythos-pro' ),
			'description'     => esc_html__( 'Blog Single Page Setting', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(
				
				array(
					'settings' => 'blog_date_single',
					'label'    => esc_html__( 'Enable Blog Date', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_author_single',
					'label'    => esc_html__( 'Enable Blog Author', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_category_single',
					'label'    => esc_html__( 'Enable Blog Category', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_comment_single',
					'label'    => esc_html__( 'Enable Comment', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'single_blog_social_share',
					'label'    => esc_html__( 'Social Share', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
							
			) #fields
		), 
		#blog_single_page_setting



		array(
			'id'              => 'bottom_setting',
			'title'           => esc_html__( 'Bottom Setting', 'mythos-pro' ),
			'description'     => esc_html__( 'Bottom Setting', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'bottom_en',
					'label'    => esc_html__( 'Enable Bottom Area', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'bottom_column',
					'label'    => esc_html__( 'Select Bottom Column', 'mythos-pro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '4',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'mythos-pro' ),
						'6' => esc_html( 'Column 2', 'mythos-pro' ),
						'4' => esc_html( 'Column 3', 'mythos-pro' ),
						'3' => esc_html( 'Column 4', 'mythos-pro' ),
					)
				),
				array(
					'settings' => 'bottom_color',
					'label'    => esc_html__( 'Bottom background Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#21223f',
				),
				array(
					'settings' => 'bottom_title_color',
					'label'    => esc_html__( 'Bottom Title Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),	
				array(
					'settings' => 'bottom_link_color',
					'label'    => esc_html__( 'Bottom Link Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#a8a9c4',
				),				
				array(
					'settings' => 'bottom_hover_color',
					'label'    => esc_html__( 'Bottom link hover color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'bottom_text_color',
					'label'    => esc_html__( 'Bottom Text color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#a8a9c4',
				),
				array(
					'settings' => 'bottom_padding_top',
					'label'    => esc_html__( 'Bottom Top Padding', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 80,
				),	
				array(
					'settings' => 'bottom_padding_bottom',
					'label'    => esc_html__( 'Bottom Padding Bottom', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 45,
				),					
			)//fields
		),//bottom_setting		
		array(
			'id'              => 'footer_setting',
			'title'           => esc_html__( 'Footer Setting', 'mythos-pro' ),
			'description'     => esc_html__( 'Footer Setting', 'mythos-pro' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'footer_en',
					'label'    => esc_html__( 'Disable Copyright Area', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'footer_logo',
					'label'    => esc_html__( 'Upload Logo', 'mythos-pro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/footer-logo.png',
				),
				array(
					'settings' => 'copyright_en',
					'label'    => esc_html__( 'Disable copyright text', 'mythos-pro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'copyright_text',
					'label'    => esc_html__( 'Copyright Text', 'mythos-pro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__( '2019 Mythos Pro. All Rights Reserved.', 'mythos-pro' ),
				),
				array(
					'settings' => 'theme_design',
					'label'    => esc_html__( 'Intro Text', 'mythos-pro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__( 'Design & Development by JoomShaper.', 'mythos-pro' ),
				),
				array(
					'settings' => 'copyright_text_color',
					'label'    => esc_html__( 'Footer Text Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#6c6d8b',
				),				
				array(
					'settings' => 'copyright_link_color',
					'label'    => esc_html__( 'Footer Link Color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#6c6d8b',
				),				
				array(
					'settings' => 'copyright_hover_color',
					'label'    => esc_html__( 'Footer link hover color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'copyright_bg_color',
					'label'    => esc_html__( 'Footer background color', 'mythos-pro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#21223f',
				),
				array(
					'settings' => 'copyright_padding_top',
					'label'    => esc_html__( 'Footer Top Padding', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 25,
				),	
				array(
					'settings' => 'copyright_padding_bottom',
					'label'    => esc_html__( 'Footer Bottom Padding', 'mythos-pro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 25,
				),					
			)//fields
		),//footer_setting
		
	),
);//wpestate-core_panel_options

$framework = new THM_Customize( $panel_to_section );

