<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_Gmap extends Widget_Base {
	public function get_name() {
		return 'thm-gmap';
	}

	public function get_title() {
		return __( 'Themeum GMap', 'flatpro' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
            'section_title',
            [
                'label' => __( 'GMap Content', 'flatpro' )
            ]
        );
		$this->add_control(
            'gmap_address',
            [
                'label' => __( 'Address', 'flatpro' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => 'Enter Address',
                'default' => '',
            ]
        );
        $this->add_control(
            'gmap_latitude',
            [
                'label' => __( 'Latitude', 'flatpro' ),
                'type' 	=> Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'Enter Latitude',
                'default' => '40.7324319',
            ]
        );
        $this->add_control(
            'gmap_longitude',
            [
                'label' => __( 'Longitude', 'flatpro' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'Enter Longitude',
                'default' => '-73.82480799999996',
            ]
        );
        $this->add_control(
            'gmap_height',
            [
                'label'         => __( 'MAP Height', 'flatpro' ),
                'type'          => Controls_Manager::NUMBER,
                'label_block'   => true,
                'default'       => 60,
            ]
        );
        $this->add_control(
            'gmap_type',
            [
                'label'     => __( 'Map Type', 'flatpro' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'hybrid',
                'options'   => [
                        'roadmap' 	=> __( 'Roadmap', 'flatpro' ),
                        'satellite' => __( 'Satellite', 'flatpro' ),
                        'hybrid' 	=> __( 'Hybrid', 'flatpro' ),
                        'terrain' 	=> __( 'Terrain', 'flatpro' ),
                    ],
            ]
        );
        $this->add_control(
            'gmap_styles',
            [
                'label'     => __( 'Map Type', 'flatpro' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style1',
                'options'   => [
                        'style1' 	=> __( 'Map Style 1', 'flatpro' ),
                        'style2' 	=> __( 'Map Style 2', 'flatpro' ),
                        'style3' 	=> __( 'Map Style 3', 'flatpro' ),
                        'style4'    => __( 'Map Style 4', 'flatpro' ),
                        'default' 	=> __( 'Map Style Default', 'flatpro' ),
                    ],
            ]
        );
        
        $this->add_control(
            'gmap_zoom',
            [
                'label'     => __( 'Map Zoom', 'flatpro' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size'  => 10,
                ],
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 18,
                    ],
                ],
            ]
        );

        $this->add_control(
            'gmap_controls',
            [
                'label'     => __( 'Map Controls', 'flatpro' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'false',
                'options'   => [
                        'true'      => __( 'Map Control Off', 'flatpro' ),
                        'false'     => __( 'Map Control On', 'flatpro' ),
                    ],
            ]
        );

        $this->add_control(
            'gmap_zoomcontrol',
            [
                'label'     => __( 'Map Zoom Wheel', 'flatpro' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'false',
                'options'   => [
                        'false'     => __( 'Zoom Wheel Off', 'flatpro' ),
                        'true'      => __( 'Zoom Wheel On', 'flatpro' ),
                    ],
            ]
        );

        $this->add_control(
            'gmap_icon',
            [
                'label'         => __( 'Flug Icon (Optional)', 'flatpro' ),
                'type'          => Controls_Manager::MEDIA,
                'label_block'   => true,
                'default'       => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
            ]
        );
        $this->end_controls_section();



		$this->start_controls_section(
			'section_title_style',
			[
				'label' 	=> __( 'GMap Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'		=> __( 'Title Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .thm-heading-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
            'text_padding',
            [
                'label' => __( 'Title Padding', 'flatpro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thm-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .thm-heading-title',
			]
		);
		$this->end_controls_section();
		# Title Section end 1


		# Sub Title Section 2
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' 	=> __( 'Sub Title', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'		=> __( 'Subtitle Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .sub-title-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography2',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_2,
				'selector' 	=> '{{WRAPPER}} .sub-title-content',
			]
		);
		# Subtitle part 2 end
	}
/*
disableDefaultUI: true
zoomControl: boolean,
mapTypeControl: boolean,
scaleControl: boolean,
fullscreenControl: boolean
*/
	protected function render() {

		$settings 		= $this->get_settings();
		$gmap_address 	= $settings['gmap_address'];
		$gmap_latitude 	= $settings['gmap_latitude'];
		$gmap_longitude = $settings['gmap_longitude'];
		$gmap_height 	= $settings['gmap_height'];
		$gmap_type 		= $settings['gmap_type'];
		$gmap_zoom 		= $settings['gmap_zoom']['size'];
        $gmap_styles    = $settings['gmap_styles'];
        $gmap_controls  = $settings['gmap_controls'];
		$gmap_zoomcontrol = $settings['gmap_zoomcontrol'];
		$image          = $this->get_settings( 'gmap_icon' );

        if ($image) {
            $image = wp_get_attachment_image_src( $image['id'], 'full' );
            $image = $image[0];
        }
		?>

		<div id="map" data-zoomcontrol="<?php echo $gmap_zoomcontrol; ?>" data-controls="<?php echo $gmap_controls; ?>" data-styles="<?php echo $gmap_styles; ?>" data-flugurl="<?php echo $image; ?>" data-address="<?php echo $gmap_address;  ?>"  data-latitude="<?php echo $gmap_latitude; ?>"  data-longitude="<?php echo $gmap_longitude; ?>"  data-height="<?php echo $gmap_height; ?>"  data-type="<?php echo $gmap_type; ?>"  data-zoom="<?php echo $gmap_zoom; ?>"></div>

		<?php }
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Gmap() );