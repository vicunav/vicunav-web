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
 * El baseline estático mostraba "X min de lectura" en cada tarjeta de
 * artículo, como <span class="article-card__read"> HERMANO del título y el
 * excerpt dentro de .article-card (que es flex column; el CSS usa
 * margin-top:auto en ese span para empujarlo al fondo de la tarjeta). No
 * existe un bloque core para "tiempo de lectura" porque depende del
 * contenido real de cada post.
 *
 * Un core/shortcode dentro de core/post-template (el Query Loop de
 * templates/archive.html) NO se expande — confirmado con render_block()
 * aislado: la expansión de do_shortcode() ocurre como parte del filtro
 * the_content sobre el contenido YA renderizado de una página completa, y
 * el Query Loop no pasa por ese filtro.
 *
 * Colgar el badge del filtro de core/post-excerpt tampoco sirve: lo
 * anidaría DENTRO de .article-card__excerpt en vez de como hermano, y
 * margin-top:auto no empuja nada al fondo si su padre inmediato no es el
 * contenedor flex (.article-card__excerpt no lo es). La solución correcta:
 * el filtro genérico render_block, que sí se dispara por cada bloque del
 * Query Loop con el post correcto ya establecido, apuntado solo al
 * core/group con className "article-card" (el wrapper real de la
 * tarjeta) e insertando el span antes de su última etiqueta de cierre.
 */
function vicunav_append_reading_time_to_article_card( $block_content, $parsed_block ) {
	if ( ( $parsed_block['blockName'] ?? '' ) !== 'core/group' ) {
		return $block_content;
	}
	$class_names = explode( ' ', trim( (string) ( $parsed_block['attrs']['className'] ?? '' ) ) );
	if ( ! in_array( 'article-card', $class_names, true ) ) {
		return $block_content;
	}

	$word_count = str_word_count( wp_strip_all_tags( get_the_content() ) );
	$minutes    = max( 1, (int) ceil( $word_count / 200 ) );
	$label      = sprintf(
		/* translators: %d: reading time in minutes. */
		_n( '%d min de lectura', '%d min de lectura', $minutes, 'vicunav' ),
		$minutes
	);
	$badge = '<span class="article-card__read">' . esc_html( $label ) . '</span>';

	$last_closing_tag = strrpos( $block_content, '</div>' );
	if ( false === $last_closing_tag ) {
		return $block_content . $badge;
	}
	return substr_replace( $block_content, $badge . '</div>', $last_closing_tag, strlen( '</div>' ) );
}
add_filter( 'render_block', 'vicunav_append_reading_time_to_article_card', 10, 2 );

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
/*
 * CSS compartido entre frontend (wp_enqueue_scripts) y editor
 * (enqueue_block_editor_assets): correcciones sobre las clases reales del
 * baseline que WordPress no resuelve solo. Vivir en una sola función evita
 * que una de las dos superficies quede desactualizada respecto a la otra,
 * que es exactamente cómo se coló el bug de botones más grandes en el
 * editor (este bloque vivía solo en el hook de frontend).
 */
function vicunav_shared_inline_css() {
	return
		/*
		 * El bloque core/button exige que "className" viva en el div
		 * contenedor (".wp-block-button"), no en el enlace, o el editor lo
		 * marca inválido. WordPress pinta su propio botón oscuro por
		 * defecto en ".wp-block-button__link" cuando no tiene color propio
		 * asignado; lo neutralizamos para que el contenedor (con las clases
		 * reales .btn/.btn--accent) sea el único que pinta, sin duplicar la
		 * píldora.
		 */
		'.wp-block-button.btn .wp-block-button__link{background:none;color:inherit;padding:0;border-radius:0;min-height:0;text-decoration:none;}' .
		/*
		 * El baseline diseñó .filter-chip y los títulos de article-card
		 * como <button>/texto plano; aquí son enlaces reales de WordPress
		 * (navegación real a archivos de categoría y a cada post), así que
		 * se resetea el subrayado por defecto del navegador para <a>.
		 */
		'.filter-chip{display:inline-flex;align-items:center;justify-content:center;text-decoration:none;} .article-card__title a,.article-card__title.wp-block-post-title a,.badge a,.badge.wp-block-post-terms a{text-decoration:none;color:inherit;} ul.wp-block-post-template{list-style:none;margin:0;padding:0;} ul.wp-block-post-template>li{margin:0;}' .
		/*
		 * WordPress core (block-library/style.css, cargado en frontend Y
		 * editor) trae una regla global "is-layout-flow > * { margin-block:
		 * 24px 0px; }" — su sistema de "block spacing" automático entre
		 * hijos de cualquier core/group con layout tipo "flow"/"default".
		 * El diseño aprobado nunca usó ese sistema: cada componente controla
		 * su propio espaciado con "gap" explícito (.pillars__grid, .kicker,
		 * .founder-teaser, etc.) o márgenes puntuales ya definidos en
		 * components.css/pages/*.css. El resultado, sin este reset, es
		 * espaciado duplicado (gap + el margin-top de WordPress) en
		 * prácticamente cualquier sección con elementos apilados de las 15
		 * páginas — confirmado midiendo Home a 390px: pillars pasaba de
		 * 1439px (baseline) a 1727px (WordPress), founder-teaser de 1135px a
		 * 1365px, únicamente por este margin extra sumado varias veces en
		 * cascada. No es "is-layout-flex"/"is-layout-grid" (esos ya usan
		 * gap nativo de CSS, no margin) — solo "is-layout-flow" necesita el
		 * reset.
		 */
		'.is-layout-flow > *{margin-block-start:0 !important;}';
}

function vicunav_editor_only_css() {
	wp_add_inline_style(
		'wp-edit-blocks',
		'.editor-styles-wrapper .is-root-container > .vicu-full-bleed{max-width:none !important;margin-left:0 !important;margin-right:0 !important;}' .
		/*
		 * Cada página/CPT usa un template genérico sin wp:post-title (el
		 * hero real, con su propio título grande, vive en el post_content).
		 * Sin un wp:post-title explícito en el template, el editor de
		 * bloques igual inyecta un campo de título editable arriba del
		 * canvas (.editor-visual-editor__post-title-wrapper) — no viene del
		 * template ni del post_content, es UI del editor. En el frontend
		 * nunca aparece. Se oculta acá; el título real del post sigue
		 * editable desde el panel lateral (Page/Post) o el listado, no se
		 * pierde la capacidad de renombrar la página.
		 */
		'.editor-visual-editor__post-title-wrapper{display:none !important;}' .
		vicunav_shared_inline_css()
	);
}
add_action( 'enqueue_block_editor_assets', 'vicunav_editor_only_css' );

/*
 * Los 35 <symbol> de íconos (ico-mail, ico-download, etc.) viven en
 * theme/parts/header.html, un template part. El editor de bloques de una
 * página/entrada individual (a diferencia del Site Editor) NUNCA renderiza
 * el header/footer dentro de su iframe de canvas — solo el post_content —
 * así que cualquier <use href="#ico-X"> dentro de una página no encuentra
 * su <symbol> y el ícono queda invisible, aunque en el frontend (donde el
 * header sí se renderiza en el mismo documento) se vea perfecto. Centralizar
 * los símbolos en el header evita duplicarlos en las 15 páginas; el precio
 * es que hay que inyectarlos también en el editor. Se inyecta el mismo
 * bloque <svg class="icon-defs"> leído en el servidor desde header.html
 * directamente en el <body> del iframe del canvas vía JS, con reintentos
 * porque el iframe no existe todavía en el primer render del editor.
 */
function vicunav_editor_icon_defs_script() {
	$header_path = get_stylesheet_directory() . '/parts/header.html';
	if ( ! file_exists( $header_path ) ) {
		return;
	}
	$header_html = file_get_contents( $header_path );
	if ( ! preg_match( '/<svg class="icon-defs"[^>]*>.*?<\/svg>/s', $header_html, $matches ) ) {
		return;
	}
	$icon_defs_json = wp_json_encode( $matches[0] );
	$script         = <<<JS
(function () {
	var iconDefsHtml = {$icon_defs_json};
	function inject() {
		var iframe = document.querySelector('iframe[name="editor-canvas"]');
		var doc = iframe && iframe.contentDocument;
		if ( ! doc || ! doc.body ) {
			return false;
		}
		if ( doc.querySelector( 'svg.icon-defs' ) ) {
			return true;
		}
		var wrapper = doc.createElement( 'div' );
		wrapper.setAttribute( 'aria-hidden', 'true' );
		wrapper.style.display = 'none';
		wrapper.innerHTML = iconDefsHtml;
		doc.body.prepend( wrapper );
		return true;
	}
	var attempts = 0;
	var timer = setInterval( function () {
		attempts++;
		if ( inject() || attempts > 60 ) {
			clearInterval( timer );
		}
	}, 250 );
})();
JS;
	wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'vicunav_editor_icon_defs_script' );

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

	wp_add_inline_style( 'vicunav-components', vicunav_shared_inline_css() );
}
add_action( 'wp_enqueue_scripts', 'vicunav_enqueue_assets' );
