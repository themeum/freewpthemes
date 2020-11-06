<?php get_header('alternative');
/*
*Template Name: 404 Page Template
*/

    $erro_logo = get_theme_mod('logo-404', get_template_directory_uri().'/images/logo-gray.png');
    $image_404 = get_theme_mod('image-404', get_template_directory_uri().'/images/404.jpg');
    $logotext  = get_theme_mod( 'logo_text', 'floox' );
?>
<div class="container floox-error-wrapper">
    <div class="row">
        <div class="col-12 info-wrapper text-center">

            <div class="error-logo">
                <?php
                    if($erro_logo){
                        echo '<img src="'. esc_attr($erro_logo).'" alt="error">';
                    }elseif ($logotext) {
                        echo $logotext;
                    }else{
                        echo esc_html(get_bloginfo('name'));
                    }
                ?>
            </div>
            <?php if($image_404) : ?>
                <div class="error-image">
                    <img src="<?php echo $image_404; ?>" alt="error">
                </div>
            <?php endif; ?>
            <div class="error-icon">
                <i class="floox-icon floox-wave"></i>
            </div>
        	<h1 class="error-title"><?php  echo esc_html(get_theme_mod( '404_title', esc_html__('Page not found', 'floox'))); ?></h1>
        	<p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
            <div class="error-button">
            	<a class="btn btn-floox white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'floox' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back', 'floox') )); ?></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer('alternative'); ?>
