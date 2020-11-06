<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_markup extends Widget_Base {
	public function get_name() {
		return 'thm-markup';
	}

	public function get_title() {
		return __( 'Themeum mrkup', 'winkel' );
	}

	public function get_icon() {
		return 'eicon-menu wts-eae-pe';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
            'section_title',
            [
                'label' 		=> __( 'markup Element', 'winkel' )
            ]
        );

        $this->add_control(
            'title_txt',
            [
                'label' 		=> __( 'Title', 'winkel' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter title', 'winkel' ),
                'default' 		=> __( 'This is heading', 'winkel' ),
            ]
        );
        $this->add_control(
            'subtitle_content',
            [
                'label' 		=> __( 'Sub Title Content', 'winkel' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter Sub Title', 'winkel' ),
                'default' 		=> __( 'Write your sub title content of this section.', 'winkel' ),
            ]
        );         
        $this->add_control(
            'title_link',
            [
                'label' 		=> __( 'Link', 'winkel' ),
                'type'			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'default' 		=> '',
            ]
        );

        $this->add_responsive_control(
			'align',
			[
				'label' 	=> __( 'Alignment', 'winkel' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 		=> [
						'title' => __( 'Left', 'winkel' ),
						'icon' 	=> 'fa fa-align-left',
					],
					'center' 	=> [
						'title' => __( 'Center', 'winkel' ),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' 	=> [
						'title' => __( 'Right', 'winkel' ),
						'icon' 	=> 'fa fa-align-right',
					],
					'justify' 	=> [
						'title' => __( 'Justified', 'winkel' ),
						'icon' 	=> 'fa fa-align-justify',
					],
				],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
            'total_id',
            [
                'label' 		=> __( 'Add ID', 'winkel' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'default' 		=> '',
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> __( 'Title', 'winkel' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_border',
			[
				'label' 		=> __( 'Background Border', 'winkel' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
				'label_on' 		=> __( 'Yes', 'winkel' ),
				'label_off' 	=> __( 'No', 'winkel' ),
				'selectors' 	=> [
					'{{WRAPPER}} h2.bordered:before' => 'width: 100%;',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label'			=> __( 'Background Color', 'winkel' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_1,
				],
				'selectors' 	=> [ '{{WRAPPER}} h2.bordered span' => 'background: {{VALUE}};' ],
				'condition' 	=> [ 'title_border' => 'yes' ],
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' 			=> 'image_border',
                'label' 		=> __( 'Background Border', 'winkel' ),
                'selector' 		=> '{{WRAPPER}} h2.bordered:before',
                'condition' 	=> [ 'title_border' => 'yes' ],
            ]
        );

		$this->add_control(
			'title_color',
			[
				'label'			=> __( 'Text Color', 'winkel' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_1,
				],
				'selectors' 	=> [ '{{WRAPPER}} .thm-heading-title' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control(
            'text_padding',
            [
                'label' 		=> __( 'Title Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .thm-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );
        $this->add_responsive_control(
            'text_margin',
            [
                'label' 		=> __( 'Title Margin', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .thm-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 		=> '{{WRAPPER}} .thm-heading-title',
			]
		);

		$this->end_controls_section();
		# Title Section end 1


		# Sub Title Section 2
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' 		=> __( 'Sub Title', 'winkel' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'			=> __( 'Subtitle Color', 'winkel' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_1,
				],
				'selectors' 	=> [ '{{WRAPPER}} .sub-title-content' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control(
            'sub_text_padding',
            [
                'label' 		=> __( 'Sub Title Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .sub-title-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography2',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_2,
				'selector' 		=> '{{WRAPPER}} .sub-title-content',
			]
		);
		$this->end_controls_section();
		# Subtitle part 2 end




		# Total Style Section 2
		$this->start_controls_section(
			'section_total_style',
			[
				'label' 		=> __( 'Total Style', 'winkel' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'label' 		=> __( 'Border', 'winkel' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .winkel-title-content-wrapper',
				'separator' 	=> 'before',
			]
		);
		$this->add_responsive_control(
            'total_padding',
            [
                'label' 		=> __( 'Total Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .winkel-title-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );
		$this->add_responsive_control(
            'total_margin',
            [
                'label' 		=> __( 'Total Margin', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .winkel-title-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );
		$this->add_control(
			'border_radius',
			[
				'label' 		=> __( 'Border Radius', 'winkel' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .winkel-title-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		# Subtitle part 2 end
	}

	protected function render( ) {
		$id_ = '';
		$settings = $this->get_settings();
		$lin = $settings['title_link'];
		if( $settings['total_id'] ){ $id_ = ' id="'.$settings["total_id"].'"'; }
		?>

    <div>
    
    <script src="<?php echo get_template_directory_uri(); ?>/js/sticky-kit.js"></script>


        <div class="row">
            <div class="col-6">
                <div class="thm-product-thumbs">
                    <div class="thm-single-thumb">
                        <img src="http://s.pictub.club/2017/08/18/7WvDGF.png" alt="t-shirt">
                    </div>
                    <div class="thm-single-thumb">
                        <img src="http://s.pictub.club/2017/08/18/7WvDGF.png" alt="t-shirt">
                    </div>
                    <div class="thm-single-thumb">
                        <img src="http://s.pictub.club/2017/08/18/7WvDGF.png" alt="t-shirt">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="inner thm-single-desc">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Men</a></li>
                        <li>Shirt & Tshirt</li>
                    </ol>
                    <p class="stock in-stock">49 in stock</p>
                    <h1 class="product-title">Sleeve Polo Shirt</h1>
                    <div class="price-box">
                        <span class="product-price">
                            <span class="woocs_price_code" data-product-id="1498">
                                <ins>
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span> 20.00
                                    </span>
                                </ins>
                                <del>
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span> 50.00
                                    </span>
                                </del>
                            </span>
                        </span>
                    </div>
                    <!-- <form action="#"> -->
                        <div class="color-variation">
                            <p>color</p>
                            <input type="radio" value="color-1" name="single-product-color" id="color-1">
                            <label style="background-color: #6EB2FB" for="color-1"></label>
                            
                            <input type="radio" value="color-2" name="single-product-color" id="color-2">
                            <label style="background-color: #00D3CA" for="color-2"></label>
                            
                            <input type="radio" value="color-3" name="single-product-color" id="color-3">
                            <label style="background-color: #F62F5E" for="color-3"></label>
                            
                            <input type="radio" value="color-4" name="single-product-color" id="color-4">
                            <label style="background-color: #FE5C07" for="color-4"></label>
                            
                            <input type="radio" value="color-5" name="single-product-color" id="color-5">
                            <label style="background-color: #6EB2FB" for="color-5"></label>
                        </div>
                        <div class="single-product-size">
                            <p>Size <span>Size guide</span></p>
                            <input type="radio" value="size-xs" name="single-product-size" id="size-xs">
                            <label for="size-xs">xs</label>

                            <input type="radio" value="s" name="single-product-size" id="size-s">
                            <label for="size-s">s</label>

                            <input type="radio" value="size-m" name="single-product-size" id="size-m">
                            <label for="size-m">m</label>

                            <input type="radio" value="size-xl" name="single-product-size" id="size-xl">
                            <label for="size-xl">xl</label>

                            <input type="radio" value="size-xxl" name="single-product-size" id="size-xxl">
                            <label for="size-xxl">xxl</label>
                        </div>
                           
                        <div class="product-quantity">
                            <p>quantity</p>
                            <div class="inner">
                                <a href="#" class="minus">
                                    <i class="winkel winkel-substract-1"></i>
                                </a>
                                <input name="" type="text" value="1" placeholder="0">
                                <a href="#" class="plus">
                                    <i class="winkel winkel-add"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="single-product-btns">
                            <a href="#" class="button round-btn"><i class="fa fa-shopping-cart"></i> add to cart</a>
                            <a href="#" class="button bordered-btn"><i class="fa fa-heart-o"></i> Add To Wishlist</a>
                        </div>
                        <div class="widget_themeum_social_share_widget">
                            <ul class="themeum-social-share">
                                <li><span class="share-title">Share</span></li>
                                <li><a class="facebook" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="instagram" href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <li><a class="twitter" href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                        </div>
                        
                    <!-- </form> -->
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="thm-product-accordion">
                    <div class="single-item active">
                        <h3 class="accordion-title">short description</h3>
                        <a href="#" class="accordion-icon">+</a>
                        <div class="accordion-content">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                    </div>
                    <div class="single-item">
                        <h3 class="accordion-title">product Details</h3>
                        <a href="#" class="accordion-icon">+</a>
                        <div class="accordion-content">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                    </div>
                    <div class="single-item">
                        <h3 class="accordion-title">SHIPPING Information</h3>
                        <a href="#" class="accordion-icon">+</a>
                        <div class="accordion-content">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                    </div>
                    <div class="single-item">
                        <h3 class="accordion-title">REVIEWS</h3>
                        <a href="#" class="accordion-icon">+</a>
                        <div class="accordion-content">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            jQuery(document).ready(function($) {
                var thmProductAccordion = $('.thm-product-accordion');
                thmProductAccordion.each(function() {
                    var thmProAccSingle = $(this).find('.single-item'),
                        thmProAccTitle = $(this).find('.accordion-title'),
                        thmProAccContent = $(this).find('.accordion-content'),
                        thmProAccIcon = $(this).find('.accordion-icon'),
                        thmNextCollapse = $(this).find('.collapse-next'),
                        thmPrevCollapse = $(this).find('.collapse-prev');
                        thmProAccSingle.each(function() {
                            if($(this).hasClass('active')){
                                $(this).children('.accordion-content').slideDown();
                            }
                        });
                    thmProAccTitle.add(thmProAccIcon).on('click', function(e) {
                        e.preventDefault();
                        if($(this).closest('.single-item').hasClass('active')){
                            return false();
                        }
                        thmProAccSingle.removeClass('active');
                        $(this).closest('.single-item').addClass('active');
                        thmProAccContent.slideUp();
                        $(this).siblings('.accordion-content').slideToggle();
                    });
                    
                    thmNextCollapse.on('click', function(e) {
                        e.preventDefault();
                        var parentItem = $(this).parents('.single-item'),
                            currentContent = parentItem.find('.accordion-content'),
                            nextContent = parentItem.next('.single-item').find('.accordion-content');
                        if(nextContent.length){
                            parentItem.removeClass('active');
                            parentItem.next('.single-item').addClass('active');
                            currentContent.slideUp();
                            nextContent.slideDown();
                        }
                    });
                    
                    thmPrevCollapse.on('click', function(e) {
                        e.preventDefault();
                        var parentItem = $(this).parents('.single-item'),
                            currentContent = parentItem.find('.accordion-content'),
                            prevContent = parentItem.prev('.single-item').find('.accordion-content');
                        if(prevContent.length){
                            parentItem.removeClass('active');
                            parentItem.prev('.single-item').addClass('active');
                            currentContent.slideUp();
                            prevContent.slideDown();
                        }
                    });
                    
                });
                
            });
        </script>

        <!--cart-page-markup-->
        <br>
        <br>
        <br>
        <br> 
        <br>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="thm-product-accordion style-2">
                    <div class="single-item active">
                        <h3 class="accordion-title">Cart Details</h3>
                        <a href="#" class="accordion-icon">+</a>
                        <div class="accordion-content">
                            
                            <form action="#" class="thm-cart-form"> <!-- start cart markup -->
                                <div class="product-list list-head">
                                    <ul>
                                        <li class="product-remove">&nbsp;</li>
                                        <li class="product-thumbnail">image</li>
                                        <li class="product-name">items</li>
                                        <li class="product-quantity">quantity</li>
                                        <li class="product-size">size</li>
                                        <li class="product-color">color</li>
                                        <li class="product-subtotal">unit price</li>
                                    </ul>
                                </div>
                                <div class="product-list list-body">
                                    <ul> <!-- end product item -->
                                        <li class="product-remove">
                                            <a href="#" class="winkel winkel-multiply"></a>
                                        </li>
                                        <li class="product-thumbnail">
                                            <a href="#">
                                                <img src="//10.0.1.12/wordpress/winkel/wp-content/uploads/2017/08/product-img9-180x180.jpg" alt="shirt">
                                            </a>
                                        </li>
                                        <li class="product-name">
                                            <a href="#" class="name">Bomber Jacket</a>
                                            <a href="#" class="product-category">for men</a>
                                        </li>
                                        <li class="product-quantity">
                                            <div class="inner">
                                                <a href="#" class="minus">
                                                    <i class="winkel winkel-substract-1"></i>
                                                </a>
                                                <input type="text" value="1" placeholder="0">
                                                <a href="#" class="plus">
                                                    <i class="winkel winkel-add"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="product-size">
                                            <span>XXL</span>
                                        </li>
                                        <li class="product-color">
                                            <span style="background-color: #ff0000"></span>
                                        </li>
                                        <li class="product-subtotal">
                                            <span>$13.00</span>
                                        </li>
                                    </ul> <!-- end product item -->
                                    
                                    <ul><!-- start product item -->
                                        <li class="product-remove">
                                            <a href="#" class="winkel winkel-multiply"></a>
                                        </li>
                                        <li class="product-thumbnail">
                                            <a href="#">
                                                <img src="//10.0.1.12/wordpress/winkel/wp-content/uploads/2017/08/product-img9-180x180.jpg" alt="shirt">
                                            </a>
                                        </li>
                                        <li class="product-name">
                                            <a href="#" class="name">Bomber Jacket</a>
                                            <a href="#" class="product-category">for men</a>
                                        </li>
                                        <li class="product-quantity">
                                            <div class="inner">
                                                <a href="#" class="minus">
                                                    <i class="winkel winkel-substract-1"></i>
                                                </a>
                                                <input type="text" value="1" placeholder="0">
                                                <a href="#" class="plus">
                                                    <i class="winkel winkel-add"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="product-size">
                                            <span>XXL</span>
                                        </li>
                                        <li class="product-color">
                                            <span style="background-color: #ff0000"></span>
                                        </li>
                                        <li class="product-subtotal">
                                            <span>$13.00</span>
                                        </li>
                                    </ul> <!-- end product item -->
                                </div>
                                <div class="cart-total">
                                    <div class="row">
                                        <div class="col-6">
                                            <h3>Total Price</h3>
                                        </div>
                                        <div class="col-6 text-right">
                                            <h3>$45</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-btns clearfix">
                                    <a href="#" class="button round-btn winkel-success">Continue Shopping</a>
                                    <a href="#" class="button round-btn winkel-grey">Cancel</a>
                                    <a href="#" class="button round-btn pull-right collapse-next">Next step</a>
                                </div>
                            </form> <!-- end cart markup -->
                            
                        </div>
                    </div>
                    <div class="single-item">
                        <h3 class="accordion-title">Delevery</h3>
                        <a href="#" class="accordion-icon">+</a>
                        <div class="accordion-content thm-delevery-form">
                            <form action="#">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">First Name</label>
                                        <input type="text" placeholder="Jhon">
                                    </div>
                                    <div class="col-6">
                                        <label for="">Last Name</label>
                                        <input type="text" placeholder="Last">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Phone Number</label>
                                        <input type="text" placeholder="+123456789">
                                    </div>
                                    <div class="col-6">
                                        <label for="">Email Address</label>
                                        <input type="email" placeholder="Jhonmark@gmail.com">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">City</label>
                                        <input type="text" placeholder="New York">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Postal Code</label>
                                        <input type="text" placeholder="0234">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Country</label>
                                        <input type="text" placeholder="USA">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Address</label>
                                        <input type="text" placeholder="Line 1">
                                        <input type="text" placeholder="Line 2 (optional)">
                                    </div>
                                </div>
                                <div class="cart-btns clearfix">
                                    <a href="#" class="button round-btn winkel-success">Continue Shopping</a>
                                    <a href="#" class="button round-btn winkel-grey collapse-prev">Previous Step</a>
                                    <a href="#" class="button round-btn pull-right collapse-next">Next step</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="single-item">
                        <h3 class="accordion-title">Payment</h3>
                        <a href="#" class="accordion-icon">+</a>
                        <div class="accordion-content">
                            <form action="#">
                                <div class="row payment-details">
                                    <div class="col-7">
                                       <div class="single-payment">
                                            <input id="bank-payment" name="payment-method" type="radio" value="bank">
                                            <label for="bank-payment">
                                                <h4>Direct Bank Transfer</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                            </label>
                                       </div>
                                       <div class="single-payment">
                                            <input id="card-payment" name="payment-method" type="radio" value="card">
                                            <label for="card-payment">
                                                <h4>Credit Card</h4>
                                                <img src="https://image.ibb.co/ndKnRk/Bitmap.png" alt="">
                                            </label>
                                       </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="cart-total-box">
                                            <h4>Your Order</h4>
                                            <ul>
                                                <li><span>Cart Subtotal</span> $390</li>
                                                <li><span>Shipping cost</span> $0.00</li>
                                                <li><span>Discount Coupon</span> $90</li>
                                                <li class="total"><span>Order total</span> $300</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="cart-btns clearfix">
                                            <a href="#" class="button round-btn winkel-success">Continue Shopping</a>
                                            <a href="#" class="button round-btn winkel-grey collapse-prev">Previous Step</a>
                                            <a href="#" class="button round-btn pull-right collapse-next">Next step</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="single-item">
                        <h3 class="accordion-title">Overview</h3>
                        <a href="#" class="accordion-icon">+</a>
                        <div class="accordion-content">
                           
                            <form action="#" class="thm-cart-form"> <!-- start cart markup -->
                                <div class="product-list list-head">
                                    <ul>
                                        <li class="product-remove">&nbsp;</li>
                                        <li class="product-thumbnail">image</li>
                                        <li class="product-name">items</li>
                                        <li class="product-quantity">quantity</li>
                                        <li class="product-size">size</li>
                                        <li class="product-color">color</li>
                                        <li class="product-subtotal">unit price</li>
                                    </ul>
                                </div>
                                <div class="product-list list-body">
                                    <ul> <!-- end product item -->
                                        <li class="product-remove">
                                            <a href="#" class="winkel winkel-multiply"></a>
                                        </li>
                                        <li class="product-thumbnail">
                                            <a href="#">
                                                <img src="//10.0.1.12/wordpress/winkel/wp-content/uploads/2017/08/product-img9-180x180.jpg" alt="shirt">
                                            </a>
                                        </li>
                                        <li class="product-name">
                                            <a href="#" class="name">Bomber Jacket</a>
                                            <a href="#" class="product-category">for men</a>
                                        </li>
                                        <li class="product-quantity">
                                            <div class="inner">
                                                <a href="#" class="minus">
                                                    <i class="winkel winkel-substract-1"></i>
                                                </a>
                                                <input type="text" value="1" placeholder="0">
                                                <a href="#" class="plus">
                                                    <i class="winkel winkel-add"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="product-size">
                                            <span>XXL</span>
                                        </li>
                                        <li class="product-color">
                                            <span style="background-color: #ff0000"></span>
                                        </li>
                                        <li class="product-subtotal">
                                            <span>$13.00</span>
                                        </li>
                                    </ul> <!-- end product item -->
                                    
                                    <ul><!-- start product item -->
                                        <li class="product-remove">
                                            <a href="#" class="winkel winkel-multiply"></a>
                                        </li>
                                        <li class="product-thumbnail">
                                            <a href="#">
                                                <img src="//10.0.1.12/wordpress/winkel/wp-content/uploads/2017/08/product-img9-180x180.jpg" alt="shirt">
                                            </a>
                                        </li>
                                        <li class="product-name">
                                            <a href="#" class="name">Bomber Jacket</a>
                                            <a href="#" class="product-category">for men</a>
                                        </li>
                                        <li class="product-quantity">
                                            <div class="inner">
                                                <a href="#" class="minus">
                                                    <i class="winkel winkel-substract-1"></i>
                                                </a>
                                                <input type="text" value="1" placeholder="0">
                                                <a href="#" class="plus">
                                                    <i class="winkel winkel-add"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="product-size">
                                            <span>XXL</span>
                                        </li>
                                        <li class="product-color">
                                            <span style="background-color: #ff0000"></span>
                                        </li>
                                        <li class="product-subtotal">
                                            <span>$13.00</span>
                                        </li>
                                    </ul> <!-- end product item -->
                                </div>
                                <div class="cart-total">
                                    <div class="row">
                                        <div class="col-6">
                                            <h3>Total Price</h3>
                                        </div>
                                        <div class="col-6 text-right">
                                            <h3>$45</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="shopping-overview">
                                    <div class="row">
                                        <div class="col-7">
                                            <h4>Shipping Details</h4>
                                            <p><span>Name:</span> Jhon Doe</p>
                                            <p><span>Email:</span> jhondoe@gmail.com</p>
                                            <p><span>Adrress:</span> 305 Intergraph Way Madison, AL 35758, USA</p>
                                            <p><span>Phone:</span> +67531927398</p>
                                        </div>
                                        <div class="col-5">
                                            <h4>Shipping Details</h4>
                                            <p><span>Name:</span> Jhon Doe</p>
                                            <p><span>Email:</span> jhondoe@gmail.com</p>
                                            <p><span>Card Number:</span> 1896 XXXXXXXXXXX234</p>
                                            <p><span>Adrress:</span> 305 Intergraph Way Madison, AL 35758, USA</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="cart-btns clearfix">
                                    <a href="#" class="button round-btn winkel-grey">Cancel</a>
                                    <a href="#" class="button round-btn pull-right">Proceed to checkout</a>
                                </div>
                            </form> <!-- end cart markup -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- start mailchimp-popup -->
        <div class="thm-mailchimp-popup">
            <div class="thm-mailchimp-inner">
               <a href="#" class="mc-close winkel winkel-multiply"></a>
                <?php echo do_shortcode('[mc4wp_form id="1781"]'); ?>
            </div>
        </div> <!-- end mailchimp-popup -->
        <a href="#" class="btn round-btn mc-open">Open Newsletter</a> <!-- mailchimp popup open -->
        
        
        <!-- start login form -->
        <div class="thm-account-popup thm-login">
            <div class="thm-account-inner">
               <a href="#" class="thm-account-close winkel winkel-multiply"></a>
               <form action="#">
                    <h1>Login</h1>
                    <p>The European languages are members of the same family. Their separate existence is a myth. </p>
                    <input type="email" placeholder="Email address">
                    <input type="password" placeholder="Password">
                    <input type="submit" value="login">
                    <div class="login-alternative">
                        <a href="#">Forgot password?</a>
                        <span>No account? <a href="#">Sign Up</a></span>
                    </div>
               </form>
            </div>
        </div> <!-- end login form -->
        
        <a href="#" class="btn round-btn thm-login-open">Login</a> <!-- login popup open -->
        
        <!-- start registration form -->
        <div class="thm-account-popup thm-reg">
            <div class="thm-account-inner">
               <a href="#" class="thm-account-close winkel winkel-multiply"></a>
               <form action="#">
                    <h1>Sign Up</h1>
                    <p>The European languages are members of the same family. Their separate existence is a myth. </p>
                    <input type="text" placeholder="Full name">
                    <input type="email" placeholder="Email address">
                    <input type="password" placeholder="Password">
                    <input type="password" placeholder="Confirm Password">
                    <input type="submit" value="Registration Now">
                    <div class="login-alternative">
                        <a href="#">Forgot password?</a>
                        <span>Already have account? <a href="#">Login</a></span>
                    </div>
               </form>
            </div>
        </div>  <!-- end registration form -->
        <a href="#" class="btn round-btn thm-reg-open">Registration</a>  <!-- registration popup open -->
            
        <!-- start payment-success-popup form -->
        <div class="payment-success-popup">
            <div class="thm-payment-success-inner">
                <a href="#" class="thm-payment-close winkel winkel-multiply"></a>
                <img src='https://i.imgur.com/fAi5oXb.png'>
                <h1>Successfully Received</h1>
                <p>The European languages are members of the same family. <br> Their separate existence is a myth.</p>
                <a href="#" class="btn round-btn">Back To home page</a>
            </div>
        </div>
        <!-- end payment-success-popup form -->
        <a href="#" class="btn round-btn thm-payment-open">Payment Success</a>  <!-- registration popup open -->
        
        <br><br><br>
        
        <div class="cart-success-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cart-success">
                            <img src='https://i.imgur.com/HX2KrbQ.png' />
                            <h1>Order Successfully Received</h1>
                            <h3>Thanks for your purchase</h3>
                            <a href="#" class="btn round-btn">Back To home page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (function($) {
                
                function popupClose (mainSelector, parentSelector, openSelector, closeSelector) {
                    
                    var accountPopup = $(mainSelector);
                    accountPopup.each(function() {
                        var accOpen = $(openSelector),
                            accClose = $(closeSelector),
                            accPopup= $(this).closest(parentSelector);
                        if(accClose.length){
                            accClose.on('click', function(e) {
                                e.preventDefault();
                                accPopup.removeClass('active');
                            });
                        }
                        if(accOpen.length){
                            accOpen.on('click', function(e) {
                                e.preventDefault();
                                accPopup.addClass('active');
                            });
                        }
                    });
                }
                
                popupClose('.thm-account-popup.thm-login > div', '.thm-account-popup', '.thm-login-open', '.thm-account-close');
                
                popupClose('.thm-account-popup.thm-reg > div', '.thm-account-popup', '.thm-reg-open', '.thm-account-close');
                
                popupClose('.thm-mailchimp-popup > div', '.thm-mailchimp-popup', '.mc-open', '.mc-close');
                
                popupClose('.payment-success-popup > div', '.payment-success-popup', '.thm-payment-open', '.thm-payment-close');
                
                
                var productQT = $('.product-quantity');
                productQT.each(function() {
                    var pMinus = $(this).find('.minus'),
                        pPlus = $(this).find('.plus'),
                        pInput = $(this).find('input'),
                        pInpVal = pInput.val();

                    pPlus.on('click', function(e) {
                        e.preventDefault();
                        pInpVal++;
                        pInput.val(pInpVal);
                    });

                    pMinus.on('click', function(e) {
                        e.preventDefault();
                        if (pInpVal == 0) {
                            return false;
                        }
                        pInpVal--;
                        pInput.val(pInpVal);
                    });

                    pInput.keyup(function() {
                        pInpVal = pInput.val();
                        if (pInpVal < 0) {
                            pInpVal = 0;
                            pInput.val(pInpVal);
                        }
                    });
                });
                ``
                
                
            })(jQuery);

        </script>


    <!-- remove cart item -->
    <?php
        
        $confirmTitle = "Are you sure?";
        $confirmDesc = "This product will be removed!";
        $confirmBtnColor = "#DD6B55";
        $confirmBtnText = "Yes, delete it!";
        $successTitle = "Deleted!";
        $successDesc = "Your product has been removed!";
        
        $product_script = "
            <script>
                (function($) {
                        var productRemove = $('.product-remove');
                        productRemove.each(function() {
                            var removeParent = $(this).closest('ul');
                            $(this).on('click', function(e) {
                                e.preventDefault();
                                swal({
                                  title: '".esc_html($confirmTitle)."',
                                  text: '".esc_html($confirmDesc)."',
                                  type: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '".esc_attr($confirmBtnColor)."',
                                  confirmButtonText: '".esc_html($confirmBtnText)."',
                                  closeOnConfirm: false
                                },
                                function(){
                                  swal('".esc_html($successTitle)."', '".esc_html($successDesc)."', 'success');
                                    removeParent.slideUp().remove();
                                });
                            });
                        });
                })(jQuery);
            </script>
        ";
        echo $product_script;
    ?>


    </div>

    <?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_markup() );
