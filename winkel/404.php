<?php get_header();
/*
*Template Name: 404 Page Template
*/
?>
<div class="container winkel-error-wrapper">
    <div class="col-sm-12 info-wrapper">
        <div class="image">
            <img src="<?php echo esc_url( get_theme_mod('err_bg',get_template_directory_uri().'/images/404.png')); ?>" alt="">
        </div>
    	<h1 class="error-title"><?php  echo esc_html(get_theme_mod( '404_title', esc_html__('OOPS!, PAGE NOT FOUND', 'winkel') )); ?></h1>
    	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', esc_html__('WE CAN’T SEEM TO FIND THE PAGE YOU’RE LOKING FOR.', 'winkel') )); ?></p>
    	<a class="button round-btn" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'winkel' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('back to homepage', 'winkel') )); ?></a>
    </div>
</div>

<?php get_footer(); ?>
