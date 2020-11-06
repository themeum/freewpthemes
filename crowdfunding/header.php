<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $themeum_options;
?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	if(isset($themeum_options['favicon'])){ ?>
		<link rel="shortcut icon" href="<?php echo esc_url($themeum_options['favicon']['url']); ?>" type="image/x-icon"/>
	<?php }else{ ?>
		<link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri().'/images/plus.png'); ?>" type="image/x-icon"/>
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

 <?php
     if ( isset($themeum_options['boxfull-en']) ) {
      $layout = esc_attr($themeum_options['boxfull-en']);
     }else{
        $layout = 'fullwidth';
     }
 ?>
<body <?php body_class( $layout.'-bg' ); ?>>
	<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
		<header id="masthead" class="site-header header" role="banner">
			<div id="header-container">
				<div id="navigation" class="container">
                    <div class="row">
                        <div class="col-md-3">
        					<div class="navbar-header">
        						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        						</button>
                                <div class="logo-wrapper">
        	                       <a class="navbar-brand" href="<?php echo site_url(); ?>">
        		                    	<?php
        									if (isset($themeum_options['logo']))
        								   {

        										if($themeum_options['logo-text-en']) {
        											echo esc_html($themeum_options['logo-text']);
        										}
        										else
        										{
        											if(!empty($themeum_options['logo'])) {
        											?>
        												<img class="enter-logo img-responsive" src="<?php echo esc_url($themeum_options['logo']['url']); ?>" alt="" title="">
        											<?php
        											}else{
        												echo esc_html(get_bloginfo('name'));
        											}
        										}
        								   }
        									else
        								   {
        								    	echo esc_html(get_bloginfo('name'));
        								   }
        								?>
        		                     </a>
                                </div>     
        					</div>
                        </div>

                        <div class="col-md-9">

                            <div id="main-menu" class="hidden-sm hidden-xs ">

                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu(  array(
                                        'theme_location' => 'primary',
                                        'container'      => '', 
                                        'menu_class'     => 'nav',
                                        'fallback_cb'    => 'wp_page_menu',
                                        'depth'          => 3,
                                        'walker'         => new Megamenu_Walker()
                                        )
                                    ); 
                                }
                                ?>
                            </div><!--/#main-menu-->

                        </div>
                        
                        

                        <div id="mobile-menu" class="visible-sm visible-xs">
                            <div class="collapse navbar-collapse tablet-responsive-collapse">
                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu( array(
                                        'theme_location'      => 'primary',
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
                    </div><!--/.row--> 
				</div><!--/.container--> 
			</div>

		</header><!--/#header-->
        <div class=“clearfix”></div>
        <!-- sign in form -->
        <section id="sign-form">
             <div id="myaccount" class="modal fade">
                <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                         <div class="modal-header">
                             <i class="fa fa-close close" data-dismiss="modal"></i>
                         </div>
                         <div class="modal-body text-center">
                             <h3><?php _e('Welcome','crowdfunding'); ?></h3>
                             <p><?php _e('Share your idea, put up your feet, stay awhile.',''); ?></p>
                             <form id="login" action="login" method="post">
                                <div class="login-error alert alert-info" role="alert"></div>
                                <input type="text"  id="username" name="username" class="form-control" placeholder="<?php _e('User Name','crowdfunding'); ?>">
                                <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e('Password','crowdfunding'); ?>">
                                <input type="submit" class="btn btn-default btn-block submit_button"  value="Login" name="submit">
                                <a class="forget-password" href="<?php echo esc_url(site_url()).'/wp-login.php?action=lostpassword'; ?>"><strong><?php _e('Forgot password?','crowdfunding'); ?></strong></a>
                                <p class="not-member"><?php _e('Not a member?','crowdfunding'); ?> <a href="<?php echo esc_url(get_permalink(get_option('wpneo_registration_page_id'))); ?>"><strong><?php _e('Join today','crowdfunding'); ?></strong></a></p>
                                <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                             </form>
                         </div>
                     </div>
                 </div> 
             </div>
        </section> <!-- end sign-in form -->
        <div id="logout-url" class="hidden"><?php echo wp_logout_url( home_url() ); ?></div>