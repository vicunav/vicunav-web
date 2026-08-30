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

/*
 * El iframe del Site Editor / editor de bloques no hereda wp_enqueue_scripts
 * (ese hook solo pinta el frontend). Sin esto, el editor renderiza los
 * bloques con cero CSS del tema aplicado.
 */
function vicunav_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style(
		array(
			'assets/css/fonts.css',
			'assets/css/tokens.css',
			'assets/css/base.css',
			'assets/css/layout.css',
			'assets/css/components.css',
		)
	);
}
add_action( 'after_setup_theme', 'vicunav_editor_styles' );

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
	} elseif ( is_singular( 'post' ) ) {
		$page_css_slug = 'articulo';
	} elseif ( is_category() || is_home() ) {
		$page_css_slug = 'articulos';
	}

	if ( $page_css_slug && file_exists( get_stylesheet_directory() . '/assets/css/pages/' . $page_css_slug . '.css' ) ) {
		wp_enqueue_style( 'vicunav-page-' . $page_css_slug, $base . 'pages/' . $page_css_slug . '.css', array( 'vicunav-components' ), $ver );
	}

	/*
	 * El bloque core/button exige que "className" viva en el div contenedor
	 * (".wp-block-button"), no en el enlace, o el editor lo marca inválido.
	 * WordPress pinta su propio botón oscuro por defecto en ".wp-block-button__link"
	 * cuando no tiene color propio asignado; lo neutralizamos para que el
	 * contenedor (con las clases reales .btn/.btn--accent) sea el único que
	 * pinta, sin duplicar la píldora.
	 */
	wp_add_inline_style(
		'vicunav-components',
		'.wp-block-button.btn .wp-block-button__link{background:none;color:inherit;padding:0;border-radius:0;min-height:0;text-decoration:none;}'
	);

	/*
	 * El baseline diseñó .filter-chip y los títulos de article-card como
	 * <button>/texto plano; aquí son enlaces reales de WordPress (navegación
	 * real a archivos de categoría y a cada post), así que se resetea el
	 * subrayado por defecto del navegador para <a>.
	 */
	wp_add_inline_style(
		'vicunav-components',
		'.filter-chip{display:inline-flex;align-items:center;justify-content:center;text-decoration:none;} .article-card__title a,.article-card__title.wp-block-post-title a,.badge a,.badge.wp-block-post-terms a{text-decoration:none;color:inherit;} ul.wp-block-post-template{list-style:none;margin:0;padding:0;} ul.wp-block-post-template>li{margin:0;}'
	);
}
add_action( 'wp_enqueue_scripts', 'vicunav_enqueue_assets' );
