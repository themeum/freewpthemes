<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.

}

class Winkel_Title{

	public function get_name(){
		return 'winkel_title';
	}
	public function get_title(){
		return 'Winkel Title';
	}
	public function get_icon() {
		return 'wppb-font-text';
	}
	public function get_category_name(){
        return 'Winkel Addon';
    }

	// headline Settings Fields
	public function get_settings() {

		$settings = array(

			'title_txt' => array(
			    'type' => 'text',
			    'title' => __('Add title text','winkel'),
			    'placeholder' => __('Enter title text','winkel'),
			    'std' => 'Latest Products',
			),

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
			'title_link' => array (
			    'type' => 'link',
			    'title' => __('Add Link','winkel'),
			    'std' => '#', // 'std' => array( 'link' => '', 'window' => 0, 'nofolow' => 0 ),
			    'placeholder' => 'http://your-link.com'
			),
			'title_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Title Color',
			    'std' => '#1a0dab',
			    'selector' => '{{SELECTOR}} .thm-title-border a{ color: {{data.title_color}}; }'
			),
			'title_bg_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Title BG Color',
			    'std' => '#1a0dab',
			    'selector' => '{{SELECTOR}} .thm-title-border a{ background-color: {{data.title_bg_color}}; }'
			),
			'title_bg_border'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Title Border Color',
			    'std' => '#1a0dab',
			    'selector' => '{{SELECTOR}} .winkel-title-wrapper::before{ background-color: {{data.title_bg_border}}; }'
			),
			'title_typography' => array(
				'tab' => 'style',
				'type' => 'typography',
				'title' => __('Typography','winkel'),
				'std' => array(
					'fontFamily' 	=> 'Poppins', // Google Font name
					'fontSize' 		=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'lineHeight' 	=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'fontWeight' 	=> '200', //100 to 900
					'textTransform' => '', // none inherit capitalize lowercase uppercase
					'fontStyle' 	=> '', //normal, italic, oblique
					'letterSpacing' => [ 'md'=>'0px', 'sm'=>'0px', 'xs'=>'0px' ],  // 0 to 20
					),
				'selector' => '{{SELECTOR}} .thm-title-border'
			),
			'text_padding' => array(
				'tab' => 'style',
				'type' => 'dimension',
				'title'	=> __('Title Padding','winkel'),
				'std' => array(
					'md' => array( 'top' => '10px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'sm' => array( 'top' => '9px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'xs' => array( 'top' => '7px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					),
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .thm-title-border{ padding: {{data.text_padding}}; }'
			),
			'text_margin' => array(
				'tab' => 'style',
				'type' => 'dimension',
				'title'	=> __('Title Margin','winkel'),
				'std' => array(
					'md' => array( 'top' => '10px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'sm' => array( 'top' => '9px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'xs' => array( 'top' => '7px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					),
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .winkel-title-wrapper{ padding: {{data.text_margin}}; }'
			),
			'title_align' => array(
				'tab' => 'style',
			    'type' => 'alignment',
			    'title' => __('Alignment Field','winkel'),
			    'std' => 'center',
			    'selector' => '{{SELECTOR}} .winkel-title-wrapper{ text-align: {{data.title_align}}; }',
			)


			

		);

		return $settings;
	}
	
	// Headline Render HTML
	public function render($data = null){
		$settings 		= $data['settings'];
	
		$titlelink 		= isset($settings['title_link']) ? $settings["title_link"] : '';
		$title_headline 		= isset($settings['title_headline']) ? $settings["title_headline"] : '';
		$title_txt 		= isset($settings['title_txt']) ? $settings["title_txt"] : '';
		$data_title = '';	

	    if ( !empty( $title_txt ) ) {
	        if ( $titlelink['link'] ) {
	            $data_title = '<'.esc_attr($title_headline).' class="thm-title-border"><a href="'.esc_url($titlelink["link"]).'">';
	                $data_title .= wp_kses_post($title_txt);
	            $data_title .= '</a></'.esc_attr($title_headline).'>';
	        } else {
	            $data_title .= '<'.esc_attr($title_headline).' class="thm-title-border">';
	                $data_title .= wp_kses_post($title_txt);
	            $data_title .= '</'.esc_attr($title_headline).'>';
	        }  
	    } 
		?>
		<div class="winkel-title-wrapper">
			<?php echo $data_title;?>
		</div>

	<?php

    }
    // headline Template
	public function getTemplate(){ 
		$output = '
		<# var title_selector = data.title_headline ? data.title_headline : "h3"#>
		<div class="winkel-title-wrapper">
			<{{ title_selector }} class="thm-title-border"><a href="{{data.title_link["link"]}}">{{{ data.title_txt }}}</a></{{ title_selector }}>
	    </div>
	    ';
		return $output;
	 }
}