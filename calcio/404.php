<?php get_header('alternative');
/*
*Template Name: 404 Page Template
*/
?>

<section class="error-page-inner">
    <div class="error-msg">
        <div class="info-wrapper">
	        <div class="container">
		        <div class="row">
		        	<div class="icon-bg col-sm-4">
		            	<img src="<?php echo esc_url( get_theme_mod('err_logo', get_parent_theme_file_uri( 'images/com.png' ))); ?>" alt="<?php esc_attr_e('Icon', 'calcio'); ?>">
		        	</div>
		        	<div class="col-sm-6">
			        	<h2 class="error-message-title"><?php  echo esc_html(get_theme_mod( '404_title', esc_html__('404', 'calcio') )); ?></h2>
			        	<h3 class="error-intro-text"><?php  echo esc_html(get_theme_mod( '404_intro', esc_html__('Something is wrong', 'calcio') )); ?></h3>
			        	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', esc_html__('The page you are looking for was moved, removed, renamed or might never existed..', 'calcio') )); ?></p>
			        	<a class="btn btn-primary white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_attr_e('HOME', 'calcio'); ?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;<?php echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back Home', 'calcio') )); ?></a>
		        	</div>
		        </div>
	        </div>
        </div>
    </div>
</section>

<?php get_footer('alternative'); ?>
