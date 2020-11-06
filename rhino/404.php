<?php get_header('alternative');
/*
*Template Name: 404 Page Template
*/
$error_logo = get_theme_mod( 'logo-404', get_template_directory_uri().'/images/logo.png');
?>
<div class="error-wrap">
	<div class="container rhino-error-wrapper">
		<div class="row">
		    <div class="col-md-8 info-wrapper">
		    	<div class="error-logo">
		    		<img src="<?php echo $error_logo; ?>" alt="">
		    	</div>
		    	<h1 class="error-title"><?php echo esc_html(get_theme_mod( '404_title', '404' )); ?></h1>
		    	<p class="error-message">
		    		<?php echo esc_html(get_theme_mod( '404_description', 'Page not found' )); ?>
		    	</p>
		    	<a class="btn btn-rhino white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'rhino' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back', 'rhino') )); ?></a>
		    </div>
	    </div>
	</div>
</div>
<?php get_footer('alternative');?>
