<?php get_header();
/*
*Template Name: 404 Page Template
*/
?>
<div class="container flatpro-error-wrapper">
    <div class="col-sm-7 info-wrapper">
    	<h1 class="error-title"><?php _e('Error 404','flatpro'); ?></h1>
    	<h2 class="error-message-title"><?php  echo esc_html(get_theme_mod( '404_title', '' )); ?></h2>
    	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
    	<a class="btn btn-flatpro white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'flatpro' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back', 'flatpro') )); ?></a>
    </div>
</div>
<?php get_footer(); ?>
