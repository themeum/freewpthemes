<?php get_header();
/*
*Template Name: 404 Page Template
*/
?>
<div class="container zephyr-error-wrapper">
	<div class="row">
	    <div class="col-md-8 info-wrapper">
	    	<h1 class="error-title"><?php _e('404','zephyr'); ?></h1>
	    	<h2 class="error-message-title"><?php  echo esc_html(get_theme_mod( '404_title', '' )); ?></h2>
	    	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
	    	<a class="btn btn-zephyr white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'zephyr' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back', 'zephyr') )); ?></a>
	    </div>
    </div>
</div>
<?php get_footer(); ?>
