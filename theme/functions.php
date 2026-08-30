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
	add_theme_support( 'align-wide' );

	$styles = array(
		'assets/css/fonts.css',
		'assets/css/tokens.css',
		'assets/css/base.css',
		'assets/css/layout.css',
		'assets/css/components.css',
	);

	/*
	 * wp_enqueue_scripts (frontend) resuelve el CSS de cada página por slug
	 * en tiempo de ejecución (ver vicunav_enqueue_assets), pero
	 * add_editor_style() no tiene ese contexto por post al registrarse:
	 * corre una sola vez en after_setup_theme para todo el sitio. Sin las
	 * 15 hojas de assets/css/pages/*.css, el editor nunca ve el color,
	 * tipografía o posicionamiento propios de cada página (ej.: el H1 de
	 * Home usaba var(--color-light) desde pages/home.css y se veía oscuro
	 * sobre fondo oscuro solo en el editor) aunque el frontend sí se viera
	 * bien. Cada archivo usa un prefijo de clase único por página, así que
	 * cargarlos todos a la vez en el editor no genera colisiones.
	 */
	$page_styles = glob( get_stylesheet_directory() . '/assets/css/pages/*.css' );
	foreach ( (array) $page_styles as $page_style_path ) {
		$styles[] = 'assets/css/pages/' . basename( $page_style_path );
	}

	add_editor_style( $styles );
}
add_action( 'after_setup_theme', 'vicunav_editor_styles' );

/*
 * El editor de bloques (Página/Entrada y Site Editor) clampea a 800px
 * cualquier bloque de nivel superior en post_content que no tenga la clase
 * "alignfull"/"alignwide" (regla propia del editor: ".is-root-container >
 * :not(.alignfull)"). Esa regla nunca existe en el frontend, así que el
 * frontend siempre se vio bien mientras el editor se veía angosto y con
 * secciones amontonadas. Marcar el atributo "align":"full" en el bloque no
 * basta: en esta versión de WordPress, un core/group con layout.type
 * "default" no recibe la clase "alignfull" en el DOM del editor aunque el
 * atributo esté guardado (confirmado con wp.data.select('core/block-editor')
 * mostrando align:"full" pero el elemento renderizado sin la clase). La
 * clase "vicu-full-bleed" la añadimos nosotros directamente en el HTML
 * guardado de cada sección de nivel superior, y aquí neutralizamos el
 * clamp del editor para esa clase con !important, sin depender de que
 * WordPress aplique alignfull correctamente.
 */
function vicunav_editor_only_css() {
	wp_add_inline_style(
		'wp-edit-blocks',
		'.editor-styles-wrapper .is-root-container > .vicu-full-bleed{max-width:none !important;margin-left:0 !important;margin-right:0 !important;}'
	);
}
add_action( 'enqueue_block_editor_assets', 'vicunav_editor_only_css' );

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
	} elseif ( is_singular( 'vicu_vertical' ) ) {
		$page_css_slug = get_post_field( 'post_name', get_queried_object_id() );
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
