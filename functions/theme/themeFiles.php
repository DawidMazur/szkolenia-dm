<?php
/**
 * Include scripts and styles
 */

function pcLoadThemeFiles(){
    $theme = wp_get_theme();

    wp_enqueue_style('global-css', get_template_directory_uri() . '/dist/global-style.css', '', '1.0', 'all');

    wp_enqueue_script('global-libs-js', get_template_directory_uri() . '/dist/global-libs-js.js', 'jquery', '1.0', true);
	wp_enqueue_script('global-functions-js', get_template_directory_uri() . '/dist/global-functions-js.js', ['jquery', 'global-libs-js'], '1.0', true);
    wp_enqueue_script('global-js', get_template_directory_uri() . '/dist/global-js.js', ['jquery', 'global-libs-js', 'global-functions-js'], '1.0', true);

    wp_localize_script('global-js', 'wp_data', [
        'ajax' => admin_url( 'admin-ajax.php' ),
    ]);
}

add_action('wp_enqueue_scripts', 'pcLoadThemeFiles');

function pcLoadAdminSiteFiles() {
    wp_enqueue_style('global-css', get_template_directory_uri() . '/dist/wp-admin-css.css', '', '1.0', 'all');
}
add_action( 'admin_enqueue_scripts', 'pcLoadAdminSiteFiles');