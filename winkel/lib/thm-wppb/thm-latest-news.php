<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.

}

class Winkel_Latest_News{

	public function get_name(){
		return 'winkel_latest_news';
	}
	public function get_title(){
		return 'Winkel Post';
	}
	public function get_icon() {
		return 'wppb-font-interface';
	}
	public function get_category_name(){
        return 'Winkel Addon';
    }

	// headline Settings Fields
	public function get_settings() {

		$settings = array(
			
			'post_number' => array(
			    'type' => 'text',
			    'title' => __('Number of Post','winkel'),
			    'std' => '3',
			),
			'post_column' => array(
				'type' => 'select',
				'responsive' => true,
				'title' => __('Post Column','winkel'),
				'placeholder' => __('Number of Column','winkel'),
				'values' => array(
                    '12' =>  __( 'One Column', 'winkel' ),
                    '6' =>  __( 'Two Column', 'winkel' ),
                    '4' =>  __( 'Three Column', 'winkel' ),
                    '3' =>  __( 'Four Column', 'winkel' )
                ),
                'std' => '3'
			),
			'post_cat' => array(
			    'type' 	 => 'select',
			    'title'  => __('Product Category','winkel'),
			    'values' => winkel_all_category_list( 'category' ),
			    
			),
			'post_order_by' => array(
			    'type' 	 => 'select',
			    'title'  => __('Post Order','winkel'),
			    'values' => array(
			        	'DESC' 		=> __( 'Descending', 'winkel' ),
                        'ASC' 		=> __( 'Ascending', 'winkel' ),
			    ),
			    'std' => 'DESC',
			),
			'title_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Title Color',
			    'std' => '#222222',
			    'selector' => '{{SELECTOR}} .post-box .inner a h6{ color: {{data.title_color}}; }'
			),
			'title_hover_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Title Hover Color',
			    'std' => '#fd5238',
			    'selector' => '{{SELECTOR}} .post-box .inner a h6:hover{ color: {{data.title_hover_color}}; }'
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
				'selector' => '{{SELECTOR}} .post-box .inner a h6'
			),
		);

		return $settings;
	}
	
	// Headline Render HTML
	public function render($data = null){
		$settings 			= $data['settings'];
		$post_number 		= isset($settings['post_number']) ? $settings["post_number"] : '';
		$post_column 		= isset($settings['post_column']) ? $settings["post_column"] : '';
		$post_cat 			= isset($settings['post_cat']) ? $settings["post_cat"] : '';
		$post_order_by 		= isset($settings['post_order_by']) ? $settings["post_order_by"] : '';
		$page_numb 			= max( 1, get_query_var('paged') );

		ob_start();

		//Query Build
		$arg = array(
				'post_type'   =>  'post',
				'post_status' => 'publish',
			);
		if( $post_order_by ){
			$arg['order'] = $post_order_by;
		}
		if( $page_numb ){
			$arg['paged'] = $page_numb;
		}
		if( $post_number ){
			$arg['posts_per_page'] = $post_number;
		}
		if( $post_cat ){
			if( $post_cat != 'allpost' ){
				$cat_data = array();
				$cat_data['relation'] = 'AND';
				$cat_data[] = array(
						'taxonomy' 	=> 'category',
			          	'field' 	=> 'slug',
			          	'terms' 	=> $post_cat
					);
				$arg['tax_query'] = $cat_data;
			}
		}

		$data = new \WP_Query( $arg );
	?>
		

		<div class="row">
			<?php if ( $data->have_posts() ) : ?>
		        <?php while ( $data->have_posts() ) : $data->the_post();
			        $permalink 	= get_permalink();
					$title 		= get_the_title();
					$media_url 	= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "winkel-large" );
					$media_url  = ( isset( $media_url[0] ) ) ? $media_url[0] : '';
		        ?>	
				<div class="post-box col-md-<?php echo $post_column['md']; ?>">
					<div class="inner">

						<?php if ( has_post_thumbnail() ){ ?>
					        <div class="post-img">
					            <a href="<?php echo esc_url($permalink); ?>">
					            	<?php the_post_thumbnail('winkel-large', array('class' => 'img-fluid')); ?>
					            </a>
					        </div>
				        <?php } ?>

				        <div class="post-meta">
				         	<?php $the_date = get_the_date(); ?>
			                <a href="<?php echo esc_url($permalink); ?>" class="date"><span><?php echo date_i18n("d", strtotime($the_date)); ?></span> <?php echo date_i18n("F", strtotime($the_date)) ?></a>
			                
			            </div>

			            <div class="post-content">
			                <a href="<?php echo esc_url($permalink); ?>"><h6><?php the_title(); ?></h6></a>
			            </div>
				    </div>
				</div>
		        <?php endwhile; ?>
		        <?php wp_reset_query(); ?>
		    <?php endif; ?>
		</div>

	<?php
	$output = ob_get_contents();
        ob_end_clean(); 
       wp_reset_postdata();
        return $output;

    }
}