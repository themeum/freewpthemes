<?php get_header();
/*
*Template Name: 404 Page Template
*/
?>
<div class="container fitgym-error-wrapper inner-padding">
	<div class="row">
	    <div class="col-md-8 info-wrapper">
	    	<h1 class="error-title"><?php _e('404','fitgym'); ?></h1>
	    	<h2 class="error-message-title"><?php  echo esc_html(get_theme_mod( '404_title', '' )); ?></h2>
	    	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
	    	<a class="btn btn-fitgym white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'fitgym' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back', 'fitgym') )); ?></a>
	    </div>
    </div>
</div>
<?php get_footer(); ?>
