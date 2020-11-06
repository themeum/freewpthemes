<?php

add_action( 'admin_notices', 'starter_ads' );
// starter_ads();
function starter_ads()
{
	$output = '<a href="#" target="_blank"><img src="http://updates.themepunch.tools/banners/updatenow_banner_large_5.3.jpg"></a>';

	// $output .= '<span style="padding-top: 0;font-size:23px;font-weight:700;display:block;">'.esc_html__('Starter Pro (Available)', 'starter').'</span>';
	// $output .= '<span style="padding-top: 0;font-size:16px;font-weight:400;display:block;">'.esc_html__('Upgrade to starter pro and enjoy more features.', 'starter').'</span>';
	// $output .= '<ul style="padding-left: 40px;list-style-type: disc;">';
	// 	$output .= '<li>'.esc_html__('Example Feature 1', 'starter').'</li>';
	// 	$output .= '<li>'.esc_html__('Example Feature 2', 'starter').'</li>';
	// 	$output .= '<li>'.esc_html__('Example Feature 3', 'starter').'</li>';
	// 	$output .= '<li>'.esc_html__('Example Feature 4', 'starter').'</li>';
	// 	$output .= '<li>'.esc_html__('Example Feature 5', 'starter').'</li>';
	// $output .= '</ul>';

	add_settings_error('starter_ads', esc_attr( 'settings_updated' ), $output, 'notice-warning');

	settings_errors( 'starter_ads' );
}

function starter_ads_customize_register( $wp_customize ) {
	require_once(get_template_directory() . '/lib/ads/starter-ads-section.php' );


   $wp_customize->add_section( new Starter_Pro_Ads_Section( $wp_customize, 'pro_ads', array(
		'title'      => 'Starter Pro',
		'priority'   => 9999,
	) ) );

   $wp_customize->add_setting( new WP_Customize_Filter_Setting( $wp_customize, 'pro_ads_setting', array() ) );

   $wp_customize->add_control( 'pro_ads_id', array(
		'theme'    => 'Starter Pro',
		'section'  => 'pro_ads',
		'settings' => 'pro_ads_setting',
	) );
}
add_action( 'customize_register', 'starter_ads_customize_register' );