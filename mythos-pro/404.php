<?php get_header();
/*
*Template Name: 404 Page Template
*/
?>

<?php $logo_404   = get_theme_mod( 'logo_404', get_template_directory_uri().'/images/logo.png' ); ?>

<div class="mythos-error">
	<div class="mythos-error-wrapper" style="background-image: url(<?php echo esc_url( get_theme_mod('error_404', get_template_directory_uri().'/images/404.png')); ?>)">
		<div class="row">
		    <div class="col-md-12 info-wrapper">
		    	
		    	<a class="error-logo" href="<?php echo esc_url(site_url()); ?>">
			    	<img class="enter-logo img-responsive" src="<?php echo esc_url( $logo_404 ); ?>" alt="<?php  esc_html_e( 'Logo', 'mythos-pro' ); ?>" title="<?php esc_html_e( 'Logo', 'mythos-pro' ); ?>">
			    </a>

		    	<h1 class="error-title"><?php esc_html_e('404','mythos-pro'); ?></h1>
		    	<h2 class="error-message-title"><?php echo html_entity_decode(esc_attr(get_theme_mod( '404_title', 'Oops, This Page Could Not Be Found!' ))); ?></h2>
		    	<p class="error-message"><?php echo html_entity_decode(esc_attr(get_theme_mod( '404_description', 'The page you are looking for might have been removed, had its name  changed, or is temporarily unavailable.' ))); ?></p>
		    	
		    	

	            <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn-secondary">
	            	<span class="fa fa-home" aria-hidden="true"></span>
	            	<?php echo esc_attr(get_theme_mod( '404_btn_text', 'Go Home' )); ?>
	            </a>
		    	
		    </div>
	    </div>
	</div>
</div>
<?php get_footer();
