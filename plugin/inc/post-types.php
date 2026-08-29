<?php

namespace Vicu\Web;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function register_post_types() {
	register_post_type(
		'vicu_vertical',
		array(
			'labels'       => array(
				'name'          => __( 'Verticales', 'vicunav-web' ),
				'singular_name' => __( 'Vertical', 'vicunav-web' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'verticales' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'menu_icon'    => 'dashicons-store',
		)
	);

	register_post_type(
		'vicu_project',
		array(
			'labels'       => array(
				'name'          => __( 'Casos de portafolio', 'vicunav-web' ),
				'singular_name' => __( 'Caso de portafolio', 'vicunav-web' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'portafolio' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'menu_icon'    => 'dashicons-portfolio',
		)
	);
}
