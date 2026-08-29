<?php
/**
 * Vicunav theme bootstrap.
 *
 * Reutiliza, sin copiar, el CSS del baseline estático ya verificado 1:1
 * contra el diseño aprobado (assets/ en la raíz del repo, enlazado por
 * symlink en theme/assets/). Los bloques de WordPress llevan las clases
 * originales del baseline vía "Additional CSS class" para heredar ese CSS
 * tal cual, sin reescribirlo página por página.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function vicunav_enqueue_assets() {
	$base = get_stylesheet_directory_uri() . '/assets/css/';
	$ver  = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'vicunav-fonts', $base . 'fonts.css', array(), $ver );
	wp_enqueue_style( 'vicunav-tokens', $base . 'tokens.css', array( 'vicunav-fonts' ), $ver );
	wp_enqueue_style( 'vicunav-base', $base . 'base.css', array( 'vicunav-tokens' ), $ver );
	wp_enqueue_style( 'vicunav-layout', $base . 'layout.css', array( 'vicunav-base' ), $ver );
	wp_enqueue_style( 'vicunav-components', $base . 'components.css', array( 'vicunav-layout' ), $ver );

	$page_css_slug = null;
	if ( is_front_page() ) {
		$page_css_slug = 'home';
	} elseif ( is_page() ) {
		$page_css_slug = get_post_field( 'post_name', get_queried_object_id() );
	}

	if ( $page_css_slug && file_exists( get_stylesheet_directory() . '/assets/css/pages/' . $page_css_slug . '.css' ) ) {
		wp_enqueue_style( 'vicunav-page-' . $page_css_slug, $base . 'pages/' . $page_css_slug . '.css', array( 'vicunav-components' ), $ver );
	}
}
add_action( 'wp_enqueue_scripts', 'vicunav_enqueue_assets' );
