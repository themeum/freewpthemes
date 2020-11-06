<?php get_header();
/*
*Template Name: 404 Page Template
*/
?>

<div class="error_page d-flex align-items-center" style="background-image: url(<?php echo get_template_directory_uri(). '/images/404.jpg'; ?>)">
    <div class="container caritas-error-wrapper">
	<div class="row">
	    <div class="col-md-8 info-wrapper">
	    	<h1 class="error-title"><?php _e('404','caritas'); ?></h1>
	    	<h2 class="error-message-title"><?php  echo esc_html(get_theme_mod( '404_title', 'Oops! Something is wrong' )); ?></h2>
	    	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
	    	<a class="btn btn-caritas white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'caritas' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Back To Home', 'caritas') )); ?></a>
	    </div>
    </div>
</div>
</div>
<?php get_footer('alternative'); ?>
