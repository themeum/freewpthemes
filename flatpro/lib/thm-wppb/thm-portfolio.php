<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.

}

class Flatpro_Portfolio{

	public function get_name(){
		return 'flatpro_portfolio';
	}
	public function get_title(){
		return 'Portfolio';
	}
	public function get_icon() {
		return 'wppb-font-grid-view';
	}
	public function get_category_name(){
        return 'Flatpro Addon';
    }

	// headline Settings Fields
	public function get_settings() {

		$settings = array(
			'portfolio_layout' => array(
				'type' => 'select',
				'title' => __('Select Layout','flatpro'),
				'placeholder' => __('Number of Column','flatpro'),
				'values' => array(
                    'layout_1' 		=> __( 'Layout 1', 'flatpro' ),
                    'layout_2' 		=> __( 'Layout 2', 'flatpro' ),
                    'layout_3' 		=> __( 'Layout 3', 'flatpro' ),
                ),
                'std' => 'layout_1'
			),
			'portfolio_number' => array(
			    'type' => 'text',
			    'title' => __('Number of Products','flatpro'),
			    'std' => '6',
			),
			'portfolio_column' => array(
				'type' => 'select',
				'responsive' => true,
				'title' => __('Portfolio Column','flatpro'),
				'placeholder' => __('Number of Column','flatpro'),
				'values' => array(
                    '6' 	=> __( 'Two Column', 'flatpro' ),
                    '4' 	=> __( 'Three Column', 'flatpro' ),
                    '3' 	=> __( 'Four Column', 'flatpro' ),
                ),
                'std' => '4'
			),
			'portfolio_order_by' => array(
			    'type' 	 => 'select',
			    'title'  => __('Order By','flatpro'),
			    'values' => array(
			        	'DESC' 		=> __( 'Descending', 'flatpro' ),
                        'ASC' 		=> __( 'Ascending', 'flatpro' ),
			    ),
			    'std' => 'DESC',
			),
			'portfolio_show_filter' => array(
			    'type' => 'switch',
			    'title' => __('Show Filter','flatpro'),
			    'std' => 0
			),
			'filter_align' => array(
			    'type' => 'alignment',
			    'title' => __('Filter Alignment','flatpro'),
			    'std' => 'center',
			    'depends'   => array(array('portfolio_show_filter', '!=', '0')),
			    'selector' => '{{SELECTOR}} .portfolioFilter{ text-align: {{data.filter_align}}; }',
			),
			'portfolio_show_title' => array(
			    'type' => 'switch',
			    'title' => __('Show Title','flatpro'),
			    'std' => 1
			),
			'portfolio_show_category' => array(
			    'type' => 'switch',
			    'title' => __('Show Category','flatpro'),
			    'std' => 1
			),
			'post_pagination' => array(
			    'type' => 'switch',
			    'title' => __('Show Pagination','flatpro'),
			    'std' => 0
			),
			'post_spacing' => array(
			    'type' => 'slider',
			    'tab' => 'style',
			    'title' => __('Post Spacing','flatpro'),
			    'range' => array(
			                'min' => 0,
			                'max' => 50,
			                'step' => 1,
			            ),
			    'std' => '10px',
			    'unit' => array('px'),
			    'selector' => '{{SELECTOR}} .portfolio-items{ padding: {{data.post_spacing}}; }'
			),
			'post_content_align' => array(
			    'type' => 'alignment',
			    'tab' => 'style',
			    'title' => __('Content Alignment','flatpro'),
			    'std' => 'center',
			    'depends'   => array(array('portfolio_show_filter', '!=', '0')),
			    'selector' => '{{SELECTOR}} .portfolioContainer .portfolio-item-content{ text-align: {{data.post_content_align}}; }',
			),
			'post_title_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Post Title Color',
			    'std' => '#293340',
			    'selector' => '{{SELECTOR}} .portfolio-single-items .portfolio-title a{ color: {{data.post_title_color}}; }'
			),
			'post_title_hover' => array(
			    'type' => 'switch',
			    'tab' => 'style',
			    'title' => __('Post Title Hover Color','flatpro'),
			    'std' => 0
			),
			'post_title_hover_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Post Title Hover Color',
			    'depends'   => array(array('post_title_hover', '!=', '0')),
			    'std' => '#293340',
			    'selector' => '{{SELECTOR}} .portfolio-single-items .portfolio-title:hover a{ color: {{data.post_title_hover_color}}; }'
			),
			'cat_title_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Category Color',
			    'std' => '#6D7784',
			    'selector' => '{{SELECTOR}} .portfolio-single-items span.portfolio-category{ color: {{data.cat_title_color}}; }'
			),
			'post_title_typography' => array(
				'tab' => 'style',
				'type' => 'typography',
				'title' => __('Title Typography','winkel'),
				'std' => array(
					'fontFamily' 	=> 'Roboto', // Google Font name
					'fontSize' 		=> [ 'md'=>'24px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'lineHeight' 	=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'fontWeight' 	=> '400', //100 to 900
					'textTransform' => '', // none inherit capitalize lowercase uppercase
					'fontStyle' 	=> '', //normal, italic, oblique
					'letterSpacing' => [ 'md'=>'0px', 'sm'=>'0px', 'xs'=>'0px' ],  // 0 to 20
					),
				'selector' => '{{SELECTOR}} .portfolio-single-items .portfolio-title a'
			),
			'cat_title_typography' => array(
				'tab' => 'style',
				'type' => 'typography',
				'title' => __('Category Typography','winkel'),
				'std' => array(
					'fontFamily' 	=> 'Roboto', // Google Font name
					'fontSize' 		=> [ 'md'=>'16px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'lineHeight' 	=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'fontWeight' 	=> '300', //100 to 900
					'textTransform' => '', // none inherit capitalize lowercase uppercase
					'fontStyle' 	=> '', //normal, italic, oblique
					'letterSpacing' => [ 'md'=>'0px', 'sm'=>'0px', 'xs'=>'0px' ],  // 0 to 20
					),
				'selector' => '{{SELECTOR}} .portfolio-single-items span.portfolio-category'
			),

		);

		return $settings;
	}
	
	// Headline Render HTML
	public function render($data = null){
		$settings 		= $data['settings'];
		ob_start();
		$page_numb 			= max( 1, get_query_var('paged') );
		$args = array(
			'post_type'		 	=> 'portfolio',
			'posts_per_page'	=> $settings['portfolio_number'],
			'order'				=> $settings['portfolio_order_by']
		);
		if( $page_numb ){
			$args['paged'] = $page_numb;
		}

		$data = new \WP_Query( $args );
		global $post;
	
		//$titlelink 		= isset($settings['title_link']) ? $settings["title_link"] : ''; 
		?>
		<div class="filterable-portfolio wppb-portfolio-custom <?php echo $settings['portfolio_layout']; ?>">
			<?php
			// filter of portfolio
			if ( $settings['portfolio_show_filter'] == '1' ) {
				$filters = get_terms('portfolio-cat');
				if ( $filters && !is_wp_error( $filters ) ) { ?>
					<div class="portfolioFilter">
						<a class="current" href="#" data-filter="*"><?php esc_html_e('Show All','flatpro'); ?></a>
					<?php foreach ( $filters as $filter ){ ?>
						<a href="#" data-filter=".<?php echo esc_attr($filter->slug); ?>"><?php echo esc_html($filter->name); ?></a>
					<?php } ?>
					</div>
				<?php }
			} ?>  

			<div class="row portfolioContainer">
			
			<?php
			if ( $data->have_posts() ) :
		        while ( $data->have_posts() ) : $data->the_post();

				$external_link	= esc_attr(get_post_meta( get_the_ID(),'external_link',true));
				# Filter List Item
				$terms	  = get_the_terms(  get_the_ID(), 'portfolio-cat' );
				$term_name  = '';
				if (is_array( $terms )) {
					foreach ( $terms as $term ) {
						$term_name .= ' '.$term->slug;
					}
				}
				# category list
				$terms2 = get_the_terms(  get_the_ID(), 'portfolio-cat' );
				$term_name2 = '';
				if (is_array( $terms2 )){
					foreach ( $terms2 as $term2 )
					{
						$term_name2 .= $term2->slug.', ';
					}
				}
				$term_name2 = substr($term_name2, 0, -2);
				?>

	
				<div class="portfolio-items col-<?php echo $settings['portfolio_column']['md'];?> <?php echo $term_name; ?>">
					<div class="portfolio-single-items">

						<div class="portfolio-thumb">
							<?php if(has_post_thumbnail( get_the_ID())) {
								$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'flatpro-portfo'); ?>
								<img class="img-responsive" src="<?php echo esc_url($thumb[0]); ?>"  alt="">
							<?php } else { ?>
								<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>'/images/recipes.jpg" alt="<?php _e('image','flatpro'); ?>">
							<?php } ?>
							<?php if( $settings['portfolio_layout'] == 'layout_1' ){ ?>
								<div class="caption-full-width">
									<div class="overlay-cont">
										<?php if ( $settings['portfolio_show_title'] == '1' ) { ?>
											<a class="overlay-btn" href="<?php the_permalink(  get_the_ID() ); ?>"><?php _e( 'View Case Study','flatpro'); ?></a>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>

						<?php if( $settings['portfolio_layout'] == 'layout_1' ){ ?>
							<div class="portfolio-item-content">
								<div class="portfolio-item-content-in">
									<div>
										<?php if ( $settings['portfolio_show_title'] == '1' ) { ?>
											<h3 class="portfolio-title"><a href="<?php the_permalink(  get_the_ID() ); ?>"><?php echo get_the_title( get_the_ID()) ?></a></h3>
										<?php } ?>
										<?php if ( $settings['portfolio_show_category'] == '1' ) {
											if($term_name != '') { ?>
											   	<span class="portfolio-category"><?php echo $term_name2; ?></span>
											<?php }
										} ?>
									</div>
								</div>
							</div>

						<?php } ?>



						<?php if( $settings['portfolio_layout'] == 'layout_2' ){ ?>
							<div class="portfolio-layout2">
								<?php if(has_post_thumbnail( get_the_ID() )) { 
									$photo = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'full' ); ?>
                                    <a class="plus-icon cloud-zooms" href="<?php echo esc_url($photo[0]); ?>"><i class="fa fa-eye"></i></a>  
                                <?php } ?>
								<div class="overlay-cont2">		
									<a href="<?php echo get_permalink(); ?>" class="plus-icon"><i class="sl-eye"></i></a>
									<?php if ( $settings['portfolio_show_title'] == '1' ) { ?>
										<h3 class="portfolio-title"><a href="<?php the_permalink(  get_the_ID() ); ?>"><?php echo get_the_title( get_the_ID()) ?></a></h3>
									<?php } ?>
									<?php if ( $settings['portfolio_show_category'] == '1' ) {
										if($term_name != '') { ?>
										   	<span class="portfolio-category"><?php echo $term_name2; ?></span>
										<?php }
									} ?>	
								</div>
							</div>
						<?php } ?>

						
						<?php if( $settings['portfolio_layout'] == 'layout_3' ){ ?>
							<div class="portfolio-item-content">
							   <div class="portfolio-item-content-in">
							      <div>
							        <?php if ( $settings['portfolio_show_category'] == '1' ) {
										if($term_name != '') { ?>
										   	<span class="portfolio-category"><?php echo $term_name2; ?></span>
										<?php }
									} ?>
									<?php if ( $settings['portfolio_show_title'] == '1' ) { ?>
							        	<h3 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							        <?php } ?>
							        <a class="overlay-btn" href="<?php the_permalink(  get_the_ID() ); ?>"><?php _e( 'View Case Study','flatpro'); ?></a>
							      </div>
							   </div>
							</div>
						<?php } ?>

					</div>
				</div>
			<?php endwhile; ?>
				<div class="col-md-12">	
					<?php 
					if( $settings['post_pagination'] == '1' ){ 
							$max_page = $data->max_num_pages; 
							echo flatpro_pagination( $page_numb, $max_page );  
						} 
					?>
				</div>
			</div>
		</div>
<?php $output = ob_get_contents();
        ob_end_clean(); 
       wp_reset_postdata();
        return $output; endif; ?>
	<?php

    }
    // headline Template
	// public function getTemplate(){ 
	// 	$output = '
	// 	<# var title_selector = data.title_headline ? data.title_headline : "h3"#>
	// 	<div class="winkel-title-wrapper">
	// 		<{{ title_selector }} class="thm-title-border"><a href="{{data.title_link["link"]}}">{{{ data.title_txt }}}</a></{{ title_selector }}>
	//     </div>
	//     ';
	// 	return $output;
	//  }
}