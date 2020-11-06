<?php get_header('alternative');
/*
*Template Name: 404 Page Template
*/
?>
<div class="container tixon-error-wrapper">
    <div class="col-sm-12 info-wrapper">
    		<div class="starter-logo">
                <img src="<?php echo esc_url( get_theme_mod('errorlogo',get_template_directory_uri().'/images/logo.png')); ?>" alt="">
            </div>
        	<h2 class="error-message-title"><?php  echo esc_html(get_theme_mod( '404_title', esc_html__('Page not Found.', 'wptixon') )); ?></h2>
        	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', esc_html__('The page you are looking for was moved, removed, renamed or might never existed..', 'wptixon') )); ?></p>
        	<a class="btn btn-primary white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'wptixon' ); ?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;<?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back Home', 'wptixon') )); ?></a>

    </div>
</div>
<?php get_footer('alternative'); ?>
