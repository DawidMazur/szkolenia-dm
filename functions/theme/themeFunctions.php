<?php

function pc_register_post_type($post_name, $plural, $singular, $args = []) {
	$labels = array(
		'name'          => _x(ucfirst($plural), ucfirst($plural), 'ws'),
		'singular_name' => _x(ucfirst($singular), ucfirst($singular), 'ws')
	);

	$args_basic = array(
		'label'               => __(ucfirst($singular), 'ws'),
		'labels'              => $labels,
		'supports'            => array(
			'title'
		),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 2,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon' => 'dashicons-format-aside'
	);

	$args_merged = array_merge($args_basic, $args);

	register_post_type($post_name, $args_merged);
}

// acf_add_options_sub_page(array(
// 	'page_title' 	=> $addons['options']['label'],
// 	'menu_title'	=> $addons['options']['label'],
// 	'parent_slug' 	=> 'edit.php?post_type=' . $post_type_name,
// ));