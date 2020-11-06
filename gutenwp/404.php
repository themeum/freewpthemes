<?php
/*
*Template Name: 404 Page Template
*/
get_header('alternative');
?>

<div class="gutenwp-error-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 info-wrapper">
                <h2 class="error-message-title">
                    <?php  echo esc_html(get_theme_mod( '404_title', esc_html__('404', 'gutenwp') )); ?>
                </h2>
                <p class="error-message">
                    <?php  echo esc_html(get_theme_mod( '404_description', esc_html__('Oops! you’ve encountered an error!', 'gutenwp') )); ?>
                </p>
                <a class="btn btn-gutenwp white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'gutenwp' ); ?>">
                    <?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Home', 'gutenwp') )); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer('alternative'); ?>
