<?php get_header('alternative');
/*
*Template Name: 404 Page Template
*/
?>

<section class="container comingsoon" style="background-image: url(<?php echo esc_url( get_theme_mod('errorbg',get_template_directory_uri().'/images/coming-soon.png')); ?>);">
	<div class="container">
	    <div class="col-sm-12 info-wrapper">
	    	<div class="starter-logo"><img src="<?php echo esc_url( get_theme_mod('errorlogo',get_template_directory_uri().'/images/logo.png')); ?>" alt=""></div>
	        <h2 class="error-message-title"><?php  echo esc_html(get_theme_mod( '404_title', esc_html__('404', 'aresmurphy') )); ?></h2>
	        <h3 class="error-sub-title"><?php  echo esc_html(get_theme_mod( '404_sub_title', esc_html__('Page not Found!', 'aresmurphy') )); ?></h3>
	        <p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', esc_html__('Component not found...', 'aresmurphy') )); ?></p>
	        <a class="btn btn-primary white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'aresmurphy' ); ?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> <?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back Home', 'aresmurphy') )); ?></a>
	    </div>
	</div>
</section>
<?php get_footer('alternative'); ?>
