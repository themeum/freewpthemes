<?php get_header('alternative');
/*
*Template Name: 404 Page Template
*/
    $error_img = get_template_directory_uri().'/images/error.png';
?>
<div class="container newskit-error-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6 info-wrapper text-center">
            <div class="row">
                <?php if($error_img) : ?>
                <div class="col-sm-6">
                    <div class="error-image">
                        <img src="<?php echo $error_img; ?>" alt="error" />
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-sm-6">
                    <h1 class="error-title"><?php  echo esc_html(get_theme_mod( '404_title', esc_html__('Page not found', 'newskit'))); ?></h1>
                    <p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
                    <div class="error-button">
                        <a class="btn btn-newskit white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_attr_e( 'HOME', 'newskit' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back Home', 'newskit') )); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer('alternative'); ?>