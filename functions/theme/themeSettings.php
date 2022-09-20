<?php
// functions for custom post types
pcInclude('/functions/theme/themeFunctions.php');

/*
* Theme menus
*/
register_nav_menus(array(
	'header' => 'Główne',
	'footer_1' => 'Stopka - 1',
	'footer_2' => 'Stopka - 2',
));

// add_theme_support( 'post-thumbnails', ['example_posts'] );

/*
* Theme custom posts types
*/ 
function pc_init_theme_custom_post_types() {
	pc_register_post_type('example_posts', 'Przykładowe posty', 'Przykładowy post', [
		'supports' => [
			'title',
			'editor',
			'excerpt',
			'author',
			// 'thumbnail',
		]
	]);

	// pc_register_post_type('realizacja-zdjecia', 'Realizacje Zdjęcia', 'Realizacja Zdjęcie', [
	// 	'menu_icon' => 'dashicons-format-gallery',
	// 	'taxonomies' => [
	// 		'post_tag'
	// 	]
	// ]);
}

add_action('init', 'pc_init_theme_custom_post_types', 0);