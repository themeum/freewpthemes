<?php 
/*
*Template Name: 404 Page Template
*/
get_header('alternative');
$bg_img = get_theme_mod( '404_bg_img', get_parent_theme_file_uri( 'images/404.jpg' ) );
?>
<div class="text-center melody-error-wrapper" style="background-image: url(<?php echo $bg_img; ?>)">
        <h1 class="error-title"><?php  echo esc_html(get_theme_mod( '404_title', esc_html__('Page not found', 'melody'))); ?></h1>
        <p class="error-message"><?php  echo esc_html(get_theme_mod( '404_description', '' )); ?></p>
        <div class="error-button">
            <a class="btn btn-melody white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_attr_e( 'HOME', 'melody' ); ?>"><?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Back Home', 'melody') )); ?></a>
    </div>
</div>
<?php get_footer('alternative'); ?>