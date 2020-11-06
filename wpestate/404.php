<?php get_header('alternative');
/*
*Template Name: 404 Page Template
*/
?>
<div class="error-wrap wpestate-error-wrapper">
	<div class="container">
		<div class="row">
		    <div class="col-md-8 info-wrapper">
		    	<h1 class="error-title"><?php echo esc_html(get_theme_mod( '404_title', esc_html__('404', 'wpestate')) ); ?></h1>
		    	<p class="error-message">
		    		<?php echo esc_html(get_theme_mod( '404_description', esc_html__('Sorry but the page you are looking for cannot be found', 'wpestate' )) ); ?>
		    	</p>
		    	<a class="btn btn-wpestate white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'wpestate' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Home', 'wpestate') )); ?></a>
		    </div>
	    </div>
	</div>
</div>
<?php get_footer('alternative');?>
