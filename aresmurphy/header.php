<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>  
  <?php 
    $layout = get_theme_mod( 'boxfull_en', 'boxwidth' );
    
    $headerstyle = get_theme_mod( 'header_layout', 'portfolio' );
  ?> 
<div id="page" class="hfeed site <?php echo esc_attr($layout); ?> homepage-<?php echo esc_attr($headerstyle); ?>">
<?php 
get_template_part('lib/advanced-header');

    