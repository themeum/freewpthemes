<?php
$padding = '';
if(!get_theme_mod( 'header_login', false )){
	$padding = 'search-top';
}
?>

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
	<header class="thm-educon-header">
		<?php if ( get_theme_mod( 'topbar_en', false ) ) { get_template_part('lib/topbar'); } ?>
		<div id="masthead" class="site-header header <?php echo esc_attr( (get_theme_mod( 'header_fixed', '' ) ) ); ?>">
			<div class="container">
				<div class="row">
					<?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
						<div class="main-menu-wrap clearfix col-sm-12">
						<div class="common-menu">
					<?php } else { ?>
						<div class="main-menu-wrap-responsive clearfix">
						<div class="common-menu-responsive">
					<?php } ?>
						<div class="themeum-navbar-header">
							<div class="logo-wrapper">
								<a class="themeum-navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php
										$logoimg = get_theme_mod( 'logo', get_parent_theme_file_uri( 'images/logo.png' ) );
										$logotext = get_theme_mod( 'logo_text', 'calcio' );
										$logotype = get_theme_mod( 'logo_style', 'logotext' );
										switch ($logotype) {
											case 'logoimg':
												if( !empty($logoimg) ) { ?>
													<img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_attr_e( 'Logo', 'calcio' ); ?>" title="<?php  esc_attr_e( 'Logo', 'calcio' ); ?>">
												<?php } else { ?>
													<h1> <?php  echo esc_html(get_bloginfo('name'));?> </h1>
												<?php }
											break; 
											case 'logotext':
												if( $logotext ) { ?>
													<h1> <?php echo esc_html( $logotext ); ?> </h1>
												<?php } else { ?>
													<h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
												<?php }
											break;
											default:
												if( $logotext ) { ?>
													<h1> <?php echo esc_html( $logotext ); ?> </h1>
												<?php } else { ?>
													<h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
												<?php }
											break;
										} ?>
									</a>
							</div>     
						</div><!--/#themeum-navbar-header-->   
						</div><!--/.col-sm-2-->
						
						<?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
						<div class="common-menu default-menu hidden-xs hidden-sm">
						<?php } else { ?>
						<div class="common-menu-responsive common-menu-responsive-wrap">
						<?php } ?>
						<?php if ( has_nav_menu( 'mainmenu' ) ) { ?>
							<div id="main-menus" class="common-menu-wrap">
								<?php 
									wp_nav_menu(  array(
										'theme_location' => 'mainmenu',
										'container'      => '', 
										'menu_class'     => 'nav',
										'fallback_cb'    => 'wp_page_menu',
										'depth'          => 4,
										'walker'         => new calcio_Megamenu_Walker()
										)
									); 
								?>      
							</div><!--/#main-menu-->
						<?php  } ?>
			
						</div><!--/.col-sm-10--> 
						<div class="col-auto login-logout text-md-right <?php echo esc_html($padding); ?>">
						
							<?php if(get_theme_mod( 'header_search_btn', false )): ?>
							<div class="header-search-wrap">
								<a href="#" class="educon-search search-open-icon"><i class="fa fa-search"></i></a> 
								<a href="#" class="educon-search search-close-icon"><i class="fa fa-times"></i></a>
								<div class="top-search-input-wrap">
								<div class="top-search-overlay"></div>
								<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
									<div class="search-wrap">
									<div class="search  pull-right educon-top-search">
										<div class="sp_search_input">
										<input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control" placeholder="<?php esc_attr_e('Search . . . . .','calcio'); ?>" autocomplete="off" />
										</div>
									</div>
									</div>
								</form>
								</div>
							</div>
							<?php endif; ?>

							<?php if(get_theme_mod( 'header_login', false )): ?>
								<?php if ( is_user_logged_in() ) { ?>
									<a class="topbar-login" href="<?php echo wp_logout_url( esc_url( home_url('/') ) ); ?>"><i class="fa fa-sign-out"></i><?php esc_attr_e('Logout','calcio'); ?></a>
								<?php } else { ?>
									<span class="topbar-login">
										<a href="#sign-in" data-toggle="modal" data-target="#sign-in" class="educon-login-url"><i class="fa fa-user"></i> <?php esc_attr_e('Login','calcio'); ?></a>   
									</span>                                  
								<?php } ?>
							<?php endif; ?>
					
						</div>
							
						
						<?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
						<button type="button" class="navbar-toggle col-md-6 col-xs-6" data-toggle="collapse" data-target=".navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>   
						<div id="mobile-menu" class="visible-xs visible-sm">
							<div class="collapse navbar-collapse">
								<?php 
								if ( has_nav_menu( 'mainmenu' ) ) {
									wp_nav_menu( array(
										'theme_location'      => 'mainmenu',
										'container'           => false,
										'menu_class'          => 'nav navbar-nav',
										'fallback_cb'         => 'wp_page_menu',
										'depth'               => 3,
										'walker'              => new wp_bootstrap_mobile_navwalker()
										)
									); 
								}
								?>
							</div>
						</div><!--/.#mobile-menu-->
						<?php } ?>

					</div><!--/.main-menu-wrap-->     
				</div><!--/.row--> 
			</div><!--/.container--> 
		</div><!--/.site-header header--> 
	</header><!--/.header-->

	  <div id="page" class="hfeed site <?php echo esc_attr( get_theme_mod( 'boxfull_en', 'fullwidth' ) ); ?>">
	  <?php if ( has_nav_menu( 'secondary_menu' ) ) { ?>
		<div class="secondary_menu">
			<div class="container">
				<div class="row">
					<?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
						<div class="col-md-12">
					<?php } else { ?>
						<div class="common-menu-responsive common-menu-responsive-wrap">
					<?php } ?>
						<?php if ( has_nav_menu( 'secondary_menu' ) ) { ?>
							<div id="main-menu" class="common-menu-wrap col-sm-10">
								<?php 
									wp_nav_menu(  array(
										'theme_location' => 'secondary_menu',
										'container'      => '', 
										'menu_class'     => 'nav',
										'fallback_cb'    => 'wp_page_menu',
										'depth'          => 1,
										'walker'         => new calcio_Megamenu_Walker()
										)
									); 
								?>      
							</div><!--/#main-menu-->
						<?php  } ?>

						<?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
							<button type="button" class="navbar-toggle col-md-6 col-xs-6" data-toggle="collapse" data-target=".navbar-collapse">
								<i class="fa fa-bars"></i>
							</button>   
							<div id="mobile-menu" class="visible-xs visible-sm">
								<div class="collapse navbar-collapse">
									<?php 
									if ( has_nav_menu( 'secondary_menu' ) ) {
										wp_nav_menu( array(
											'theme_location'      => 'secondary_menu',
											'container'           => false,
											'menu_class'          => 'nav navbar-nav',
											'fallback_cb'         => 'wp_page_menu',
											'depth'               => 1,
											'walker'              => new wp_bootstrap_mobile_navwalker()
											)
										); 
									}
									?>
								</div>
							</div><!--/.#mobile-menu-->
						<?php } ?>

						<div class="header-social">
							<?php get_template_part('lib/social-link');?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<!-- sign in form -->
		<div id="sign-form">
			<div id="sign-in" class="modal fade">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<i class="fa fa-close close" data-dismiss="modal"></i>
						</div>
						<div class="modal-body text-center">
							<h3 class="login-form-title"><?php esc_html_e('Welcome','calcio'); ?></h3>
							<form id="login" action="login" method="post">
								<div class="login-error alert alert-info" role="alert"></div>
								<input type="text"  id="username" name="username" class="form-control" placeholder="<?php esc_attr_e('User Name','calcio'); ?>">
								<input type="password" id="password" name="password" class="form-control" placeholder="<?php esc_attr_e('Password','calcio'); ?>">
								<input type="submit" class="btn btn-primary btn-block submit_button"  value="Login" name="submit">
								<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><strong><?php esc_html_e('Forgot password?','calcio'); ?></strong></a>
								<p><?php esc_html_e('Not a member?','calcio'); ?> <a href="<?php echo esc_url(get_permalink(get_option('register_page_id'))); ?>"><strong><?php esc_html_e('Join today','calcio'); ?></strong></a></p>
								<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
							</form>
						</div>
					</div>
				</div> 
			</div>
		</div> <!-- end sign-in form -->
		<div class="clearfix"></div>