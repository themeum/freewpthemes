<?php get_header();
/*
*Template Name: 404 Page Template
*/
?>
<div class="container bizness-error-wrapper">
	<div class="row">
	    <div class="col-md-8 info-wrapper">
	    	<h1 class="error-title"><?php _e('404','bizness'); ?></h1>
	    	<h2 class="error-message-title"><?php  echo esc_html(get_theme_mod( '404_title', '' )); ?></h2>
	    	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
	    	<a class="btn btn-bizness white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'bizness' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back', 'bizness') )); ?></a>
	    </div>
    </div>
</div>
<?php get_footer(); ?>
