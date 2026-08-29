<?php
/**
 * Plugin Name: Vicunav Web
 * Description: Registra el contenido propio del sitio de Vicunav (verticales y casos de portafolio). Plugin propio de vicunav-web, sin dependencias del ecosistema modular.
 * Version: 0.1.0
 * Author: Mario Vicuña
 * License: GPL-2.0-or-later
 * Text Domain: vicunav-web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/inc/post-types.php';

add_action( 'init', 'Vicu\\Web\\register_post_types' );
