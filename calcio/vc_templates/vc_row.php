<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 * @var $ep_row_color
 * @var $ep_row_text_align
 * @var $ep_bg_overlay_color
 * @var $ep_row_padding_bottom
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $before_output = $after_output = $row_inner_before = $row_inner_after = $ep_row_color = $ep_row_text_align = $ep_row_bg_primary = $row_overlay = $ep_bg_overlay_color = $ep_row_padding_bottom = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'vc_row',
    'wpb_row',
    'vc_row-fluid',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() ) {
        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    } else {
        return '';
    }
}

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
    $css_classes[]='vc_row-has-fill';
}

if (!empty($atts['gap'])) {
    $css_classes[] = 'vc_column-gap-'.$atts['gap'];
}

$wrapper_attributes = array();

if ( ! empty( $el_id ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if ( empty( $full_width ) ) {
    $row_inner_before .= '<div class="container">';
    $row_inner_after .= '</div>';
}
if ( ! empty( $full_width ) ) {
    
    if( 'stretch_row' === $full_width ){
        $row_inner_before .= '<div class="container"><div class="row">';
        $row_inner_after .= '</div></div>';
        $css_classes[] = ' ep_row_stretch_row';
    }
    elseif ( 'stretch_row_content' === $full_width ) {
        $css_classes[] = ' ep_row_stretch_row_content';
    } elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
        $css_classes[] = ' vc_row-no-padding ep_row_stretch_row_content_no_paddings';
    }
}


if ( ! empty( $full_height ) ) {
    $css_classes[] = 'vc_row-o-full-height';
    if ( ! empty( $columns_placement ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-columns-' . $columns_placement;
        if ( 'stretch' === $columns_placement ) {
            $css_classes[] = 'vc_row-o-equal-height';
        }
    }
}

if ( ! empty( $equal_height ) ) {
    $flex_row = true;
    $css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
    $flex_row = true;
    $css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
    $css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
    $parallax = $video_bg_parallax;
    $parallax_speed = $parallax_speed_video;
    $parallax_image = $video_bg_url;
    $css_classes[] = 'vc_video-bg-container';
    wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
    wp_enqueue_script( 'vc_jquery_skrollr_js' );
    $wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; 
    $css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
    if ( false !== strpos( $parallax, 'fade' ) ) {
        $css_classes[] = 'js-vc_parallax-o-fade';
        $wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
    } elseif ( false !== strpos( $parallax, 'fixed' ) ) {
        $css_classes[] = 'js-vc_parallax-o-fixed';
    }
}

if ( ! empty( $parallax_image ) ) {
    if ( $has_video_bg ) {
        $parallax_image_src = $parallax_image;
    } else {
        $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
        $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
        if ( ! empty( $parallax_image_src[0] ) ) {
            $parallax_image_src = $parallax_image_src[0];
        }
    }
    $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
    $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}

/* EP Row Color */

if( $ep_row_color == 'white' ){
    $css_classes[] = 'ep_vc_row-color-white';
}

/* EP Row BG primary Color */

if( $ep_row_bg_primary == 'on' ){
    $css_classes[] = 'ep_vc_row-background-primary';
}

/* EP Row Align */

if( $ep_row_text_align ){
    $css_classes[] = 'text-'.$ep_row_text_align;
}

/* Row padding bottom */

if( $ep_row_padding_bottom ){
    $css_classes[] = 'ep_vc_row-padding-bottom-'.$ep_row_padding_bottom;
}

/* EP overlay */

if ( ! empty( $parallax ) && $ep_bg_overlay_color ) {
    $row_overlay .= '<div class="xt-row-overlay" style="background-color:'.$ep_bg_overlay_color.'"></div>';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= $before_output;
if( $full_width == '' ){   $output .= $row_inner_before; }
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
if( $full_width != '' ){ $output .= $row_inner_before; }
$output .= wpb_js_remove_wpautop( $content );
if( $full_width != '' ){ $output .= $row_inner_after; }
$output .= $row_overlay;
$output .= '</div>';
if( $full_width == '' ){  $output .= $row_inner_after; }
$output .= $after_output;

print $output;
