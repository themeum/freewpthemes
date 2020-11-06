<?php get_header();
/*
*Template Name: 404 Page Template
*/

    $image_404 = get_theme_mod('image-404', get_template_directory_uri().'/images/404.png');
?>
<div class="container calypso-error-wrapper">
    <div class="row">
        <div class="col-12 info-wrapper text-center">
            <?php if($image_404) : ?>
                <div class="error-image">
                    <img src="<?php echo esc_url($image_404); ?>" alt="error">
                </div>
            <?php endif; ?>
        	<h1 class="error-title heading-font"><?php  echo esc_html(get_theme_mod( '404_title', esc_html__('Page not found', 'calypso'))); ?></h1>
        	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
            <div class="error-button">
            	<a class="btn btn-calypso" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'calypso' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('BACK TO HOME', 'calypso') )); ?></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>