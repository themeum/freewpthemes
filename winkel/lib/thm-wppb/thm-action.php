<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.

}

class Winkel_Action{

	public function get_name(){
		return 'winkel_action';
	}
	public function get_title(){
		return 'Winkel Action';
	}
	public function get_icon() {
		return 'wppb-font-Page-grid';
	}
	public function get_category_name(){
        return 'Winkel Addon';
    }

	// headline Settings Fields
	public function get_settings() {

		$settings = array(

			'title_headline' => array(
			    'type' 	 => 'select',
			    'title'  => __('Select title element','winkel'),
			    'values' => array(
			        	'h1'  	=> 'H1',
						'h2'  	=> 'H2',
						'h3'  	=> 'H3',
						'h4'  	=> 'H4',
						'h5'  	=> 'H5',
						'h6'  	=> 'H6',
						'div'  	=> 'div',
						'span'  => 'Span',
						'p'  	=> 'P'
			    ),
			    'std' => 'h3',
			),
			'title_text' => array(
			    'type' => 'text',
			    'title' => __('Add title text','winkel'),
			    'placeholder' => __('Enter title text','winkel'),
			    'std' => 'Combo Offer',
			),

			'subtitle_headline' => array(
			    'type' 	 => 'select',
			    'title'  => __('Select Sub title element','winkel'),
			    'values' => array(
			        	'h1'  	=> 'H1',
						'h2'  	=> 'H2',
						'h3'  	=> 'H3',
						'h4'  	=> 'H4',
						'h5'  	=> 'H5',
						'h6'  	=> 'H6',
						'div'  	=> 'div',
						'span'  => 'Span',
						'p'  	=> 'P'
			    ),
			    'std' => 'h3',
			),
			'text_subtitle' => array(
			    'type' => 'text',
			    'title' => __('Add Sub title text','winkel'),
			    'placeholder' => __('Enter Sub title text','winkel'),
			    'std' => 'Combo Offer',
			),
			'short_desc' => array(
			    'type' => 'textarea',
			    'title' => __('Description','winkel'),
			    'placeholder' => __('Enter Description','winkel'),
			    'std' => 'Buy one gift one free'
			),
			'title_link' => array (
			    'type' => 'link',
			    'title' => __('Add Link','winkel'),
			    'std' => '#', // 'std' => array( 'link' => '', 'window' => 0, 'nofolow' => 0 ),
			    'placeholder' => 'http://your-link.com'
			),
			'bg_image' => array(
			    'type' => 'background',
			    'title' => __('Background Image','winkel'),
			    'selector' => '{{SELECTOR}} .themeum-action-wrap',
			    'std' => array(
				'bgType' => 'color',
				'bgColor' => '',
				'bgImage' => array(),
				'bgimgPosition' => '',
				'bgimgAttachment' => '',
				'bgimgRepeat' => '',
				'bgimgSize' => '',
				'bgDefaultColor' => '',
				'bgGradient' => array(),
				'videoType' => 'local',
				'bgVideo' => array(),
				'bgExternalVideo' => '',
				'bgVideoFallback' =>array(),
				'bgHoverType' => 'color',
				'bgHoverColor' => '',
				'bgHoverImage' => array(),
				'bgHoverimgPosition' => '',
				'bgHoverimgAttachment' => '',
				'bgimgHoverRepeat' => '',
				'bgimgHoverSize' => '',
				'bgHoverDefaultColor' => '',
				'bgHoverGradient' => array(),
			    )
			),

			'title_color'=> array(
				'section' => 'Title',
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Title Color',
			    'std' => '#1a0dab',
			    'selector' => '{{SELECTOR}} .thm-action-title{ color: {{data.title_color}}; }'
			),
			'title_padding' => array(
				'tab' => 'style',
				'section' => 'Title',
				'type' => 'dimension',
				'title'	=> __('Title Padding','winkel'),
				'std' => array(
					'md' => array( 'top' => '10px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'sm' => array( 'top' => '9px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'xs' => array( 'top' => '7px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					),
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .thm-action-title{ padding: {{data.title_padding}}; }'
			),
			'title_typography' => array(
				'tab' => 'style',
				'section' => 'Title',
				'type' => 'typography',
				'title' => __('Title Typography','winkel'),
				'std' => array(
					'fontFamily' 	=> 'Poppins', // Google Font name
					'fontSize' 		=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'lineHeight' 	=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'fontWeight' 	=> '200', //100 to 900
					'textTransform' => '', // none inherit capitalize lowercase uppercase
					'fontStyle' 	=> '', //normal, italic, oblique
					'letterSpacing' => [ 'md'=>'0px', 'sm'=>'0px', 'xs'=>'0px' ],  // 0 to 20
					),
				'selector' => '{{SELECTOR}} .thm-action-title'
			),
			'subtitle_color'=> array(
				'tab' => 'style',
				'section' => 'Sub Title',
			    'type' => 'color',
			    'title' => 'Sub Title Color',
			    'std' => '#1a0dab',
			    'selector' => '{{SELECTOR}} .thm-action-subtitle a{ color: {{data.subtitle_color}}; }'
			),
			'subtitle_hover_color'=> array(
				'tab' => 'style',
				'section' => 'Sub Title',
			    'type' => 'color',
			    'title' => 'Sub Title Hover Color',
			    'std' => '#1a0dab',
			    'selector' => '{{SELECTOR}} .thm-action-subtitle a:hover{ color: {{data.subtitle_hover_color}}; }'
			),
			'subtitle_padding' => array(
				'tab' => 'style',
				'section' => 'Sub Title',
				'type' => 'dimension',
				'title'	=> __('Sub Title Padding','winkel'),
				'std' => array(
					'md' => array( 'top' => '10px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'sm' => array( 'top' => '9px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'xs' => array( 'top' => '7px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					),
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .thm-action-subtitle{ padding: {{data.subtitle_padding}}; }'
			),
			'subtitle_typography' => array(
				'tab' => 'style',
				'section' => 'Sub Title',
				'type' => 'typography',
				'title' => __('Sub Title Typography','winkel'),
				'std' => array(
					'fontFamily' 	=> 'Poppins', // Google Font name
					'fontSize' 		=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'lineHeight' 	=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'fontWeight' 	=> '200', //100 to 900
					'textTransform' => '', // none inherit capitalize lowercase uppercase
					'fontStyle' 	=> '', //normal, italic, oblique
					'letterSpacing' => [ 'md'=>'0px', 'sm'=>'0px', 'xs'=>'0px' ],  // 0 to 20
					),
				'selector' => '{{SELECTOR}} .thm-action-subtitle'
			),
			'description_color'=> array(
				'section' => 'Description',
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Description Color',
			    'std' => '#1a0dab',
			    'selector' => '{{SELECTOR}} .thm-action-desc{ color: {{data.description_color}}; }'
			),
			'description_padding' => array(
				'tab' => 'style',
				'section' => 'Description',
				'type' => 'dimension',
				'title'	=> __('Description Padding','winkel'),
				'std' => array(
					'md' => array( 'top' => '10px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'sm' => array( 'top' => '9px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'xs' => array( 'top' => '7px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					),
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .thm-action-desc{ padding: {{data.description_padding}}; }'
			),
			'description_typography' => array(
				'tab' => 'style',
				'section' => 'Description',
				'type' => 'typography',
				'title' => __('Description Typography','winkel'),
				'std' => array(
					'fontFamily' 	=> 'Poppins', // Google Font name
					'fontSize' 		=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'lineHeight' 	=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'fontWeight' 	=> '200', //100 to 900
					'textTransform' => '', // none inherit capitalize lowercase uppercase
					'fontStyle' 	=> '', //normal, italic, oblique
					'letterSpacing' => [ 'md'=>'0px', 'sm'=>'0px', 'xs'=>'0px' ],  // 0 to 20
					),
				'selector' => '{{SELECTOR}} .thm-action-desc'
			),
			'wrap_padding' => array(
				'tab' => 'style',
				'type' => 'dimension',
				'title'	=> __('Wrap Padding','winkel'),
				'std' => array(
					'md' => array( 'top' => '10px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'sm' => array( 'top' => '9px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'xs' => array( 'top' => '7px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					),
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .themeum-action-wrap{ padding: {{data.wrap_padding}}; }'
			),


			

		);

		return $settings;
	}
	
	// Headline Render HTML
	public function render($data = null){


		$settings 		= $data['settings'];
	
		$title_headline 		= isset($settings['title_headline']) ? $settings["title_headline"] : '';
		$subtitle_headline 		= isset($settings['subtitle_headline']) ? $settings["subtitle_headline"] : '';
		$title_text 		= isset($settings['title_text']) ? $settings["title_text"] : '';
		$titlelink 		= isset($settings['title_link']) ? $settings["title_link"] : '';
		$subtitle 		= isset($settings['text_subtitle']) ? $settings["text_subtitle"] : '';
		$desc 		= isset($settings['short_desc']) ? $settings["short_desc"] : '';

		//Default Value

		$data_title = $data_subtitle = $data_img = '';

		if( empty( $title_headline ) ) {
	        $title_headline = 'h3';
	    }

	    //title
	    if ( !empty( $title_text ) ) {
            $data_title .= '<'.esc_attr($title_headline).' class="thm-action-title">';
                $data_title .= $title_text;
            $data_title .= '</'.esc_attr($title_headline).'>'; 
	    }    

	    if ( !empty( $subtitle ) ) {
	        if ( ! empty($titlelink['link']) ) {
	            $data_subtitle = '<'.esc_attr($subtitle_headline).' class="thm-action-subtitle"><a href="'.esc_url($titlelink['link']).'">';
	                $data_subtitle .= $subtitle;
	            $data_subtitle .= '</a></'.esc_attr($subtitle_headline).'>';
	        } else {
	            $data_subtitle .= '<'.esc_attr($subtitle_headline).' class="thm-action-subtitle">';
	                $data_subtitle .= $subtitle;
	            $data_subtitle .= '</'.esc_attr($subtitle_headline).'>';
	        }  
	    }

	?>
		<div class="shortcode-themeum-action-wrap">
			<div class="themeum-action-wrap">
				<div class="themeum-action-box">
					<?php 
					echo $data_title;
					echo $data_subtitle;
					?>
					<?php if( $desc ){ ?>
						<p class="thm-action-desc"><?php echo $desc; ?></p>
					<?php } ?>
			    </div>
		    </div>
	    </div>

	<?php

    }
    // headline Template
	public function getTemplate(){ 
		$output = '
		<# var title_selector = data.title_headline ? data.title_headline : "div" 
		 sub_title_selector = data.subtitle_headline ? data.subtitle_headline : "h1" 
		#>
		<div class="shortcode-themeum-action-wrap">
			<div class="themeum-action-wrap">
				<div class="themeum-action-box">
					<{{ title_selector }} class="thm-action-title">{{{ data.title_text }}}</{{ title_selector }}>
					<{{ sub_title_selector }} class="thm-action-subtitle"><a href="{{data.title_link["link"]}}">{{{ data.text_subtitle }}}</a></{{ sub_title_selector }}>
					<p class="thm-action-desc">{{{data.short_desc}}}</p>
			    </div>
		    </div>
	    </div>
	    ';
		return $output;
	 }
}