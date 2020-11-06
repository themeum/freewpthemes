<!DOCTYPE html> 
<html <?php language_attributes(); ?>> 
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>  
	<?php 
		$layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
		$headerlayout = get_theme_mod( 'head_style', 'white' );
		$header_style = get_post_meta( get_the_ID(), "themeum_header_style", true );
		if($header_style){
			if($header_style == 'white_color'){
				$headerlayout =  'white';
			}else{
				$headerlayout =  'dark';
			}
		}
		$sticky_class = $topbaren_class = '';
		if( get_theme_mod( 'header_fixed', false )){
			$sticky_class = ' enable-sticky ';
		} 
		if( get_theme_mod( 'topbar_en', true )){
			$topbaren_class = ' enable-topbar ';
		} 
	?> 
	<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">

	<header id="masthead" class="site-header header-<?php echo esc_attr($headerlayout); echo esc_attr($sticky_class); echo esc_attr($topbaren_class); ?> ">  	
		<?php if ( get_theme_mod( 'topbar_en', true ) ) { get_template_part('lib/topbar'); } ?>
		<div class="container">
			<div class="row">
				<?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
					<div class="col-md-12">
						<div class="primary-menu">
							<!-- Woocart Mobile -->
							<?php if (get_theme_mod('woocart_en', 'true')): ?>
								<ul id="menu-main-menu" class="cart-mobile-option">
									<li class="woocart">
										<a href="#">
											<?php 
											global $woocommerce;
											if($woocommerce) { ?>
												<span id="themeum-woo-cart" class="woo-cart" style="display:none;">
													<?php
														$has_products = '';
														$has_products = 'cart-has-products';
													?>
													<i class="fa fa-shopping-cart"></i>
													<span class="woo-cart-items">
														<span class="<?php echo esc_attr($has_products); ?>"><?php //echo $woocommerce->cart->cart_contents_count; ?></span>
													</span>
													<?php the_widget( 'WC_Widget_Cart', 'title= ' ); ?>
												</span>
											<?php } ?> 
										</a>
									</li>
								</ul> 
							<?php endif ?>
							<!-- End Woocart Mobile-->
							<div class="row">
								<div class="col-sm-6 col-md-2 col-lg-2 col-6">
									<div class="themeum-navbar-header">
										<div class="logo-wrapper">
											<a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
												<?php
												$logoimg   = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
												$logotext  = get_theme_mod( 'logo_text', 'mythos-pro' );
												$logotype  = get_theme_mod( 'logo_style', 'logoimg' );
												switch ($logotype) {
													case 'logoimg':
													if( !empty($logoimg) ) { ?>
														<img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php esc_html_e( 'Logo', 'mythos-pro' ); ?>" title="<?php esc_html_e( 'Logo', 'mythos-pro' ); ?>">
													<?php } else { ?>
														<h1> <?php echo esc_html(get_bloginfo('name'));?> </h1>
													<?php }
													break;
													# Default Menu
													default:
													if( $logotext ) { ?>
														<h1> <?php echo esc_html( $logotext ); ?> </h1>
													<?php } else { ?>
														<h1><?php echo esc_html(get_bloginfo('name'));?> </h1>
													<?php }
													break;
												} ?>
											</a>
										</div>   
									</div> <!--/#themeum-navbar-header-->   
								</div> <!--/.col-sm-2-->


								<!-- Mobile Monu -->
								<div class="col-sm-6 col-md-8 col-6 mythos-menu hidden-lg-up">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fas fa-bars"></i></button>
								</div>
								<div id="mobile-menu" class="thm-mobile-menu"> 
									<div class="collapse navbar-collapse">
										<?php 
											if ( has_nav_menu( 'primary' ) ) {
												wp_nav_menu( 
													array(
														'theme_location'    => 'primary',
														'container'         => false,
														'menu_class'        => 'nav navbar-nav',
														'fallback_cb'       => 'wp_page_menu',
														'depth'             => 3,
														'walker'            => new wp_bootstrap_mobile_navwalker()
													)
												); 
											} 
										?>
									</div>
								</div> <!-- thm-mobile-menu -->
								
								<!-- Primary Menu -->
								<div class="col-md-12 col-lg-10 common-menu space-wrap">
									<div class="header-common-menu">
										<?php if ( has_nav_menu( 'primary' ) ) { ?>
											<div id="main-menu" class="common-menu-wrap">
												<?php 
													wp_nav_menu(  
														array(
															'theme_location'  => 'primary',
															'container'       => '', 
															'menu_class'      => 'nav',
															'fallback_cb'     => 'wp_page_menu',
															'depth'            => 4,
															'walker'          => new Megamenu_Walker()
														)
													); 
												?>  
											</div><!--/.col-sm-9--> 
										<?php } ?>
									</div><!-- header-common-menu -->
								</div><!-- common-menu -->
							</div>
						</div>
					</div>
				<?php } ?>

				<!-- For Megamenu -->
				<?php if( class_exists('wp_megamenu_initial_setup') ) { ?>
					<div class="col-md-12 col-lg-12 common-menu common-main-menu">
						<div class="header-common-menu">
							<!-- Woocart Mobile -->
							<?php if (get_theme_mod('woocart_en', 'true')): ?>
								<ul id="menu-main-menu" class="cart-mobile-option">
									<li class="woocart">
										<a href="#">
											<?php 
											global $woocommerce;
											if($woocommerce) { ?>
												<span id="themeum-woo-cart" class="woo-cart" style="display:none;">
													<?php
														$has_products = '';
														$has_products = 'cart-has-products';
													?>
													<i class="fa fa-shopping-cart"></i>
													<span class="woo-cart-items">
														<span class="<?php echo esc_attr($has_products); ?>"><?php //echo $woocommerce->cart->cart_contents_count; ?></span>
													</span>
													<?php the_widget( 'WC_Widget_Cart', 'title= ' ); ?>
												</span>
											<?php } ?> 
										</a>
									</li>
								</ul> 
							<?php endif ?>
							<!-- End Woocart Mobile-->
							<?php if ( has_nav_menu( 'primary' ) ) { ?>
								<div id="main-menu" class="common-menu-wrap">
									<?php 
										wp_nav_menu(  
											array(
												'theme_location'  => 'primary',
												'container'       => '', 
												'menu_class'      => 'nav',
												'fallback_cb'     => 'wp_page_menu',
												'depth'            => 4,
												'walker'          => new Megamenu_Walker()
											)
										); 
									?>  
								</div><!--/.col-sm-9--> 
							<?php } ?>
						</div><!-- header-common-menu -->
					</div><!-- common-menu -->
				<?php } ?>
			</div><!--row-->  
		</div><!--/.container--> 
	</header> <!-- header -->
	