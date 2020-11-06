<!DOCTYPE html>
<html <?php language_attributes(); ?> class="alternative-header">
<?php global $themeum_options; ?>
<head>
    
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php if (isset($themeum_options['favicon']) ) { ?>
       <link rel="shortcut icon" href="<?php echo esc_url($themeum_options['favicon']['url']); ?>" type="image/x-icon"/>
    <?php } ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head><!--end head-->
<body <?php body_class() ?>>