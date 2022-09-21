<?php
/**
 *
 * @package ws
 */

/**
 * Import function
 */

function remove_add_lines_wysiwyg($value, $post_id, $field, $orginal) {
    $value = wpautop($value);
	$value = force_balance_tags($value);
	$value = preg_replace('/<p>(?:\s|&nbsp;)*?<\/p>/i', '', $value);
	$value = trim($value);
	return $value;

}

add_filter('acf/update_value/type=wysiwyg', 'remove_add_lines_wysiwyg', 20, 4);

function pcInclude($path) {
    if(file_exists(__DIR__ . $path) || file_exists($path)) {
        if(!$filepath = locate_template($path)) {
            trigger_error("Error locating `$path` for inclusion!", E_USER_ERROR);
        } else {
            require_once $filepath;
        }
    } else {
        echo 'Nie znajduje pliku: ' . $path;
        die();
    }
}

/**
 * Disable gutenberg
 */
add_filter('use_block_editor_for_post_type', '__return_false', 100);

pcInclude('/functions/basicRemoves.php');

/**
 * Assets
 */

function get_asset( $asset ) {
    return get_template_directory_uri() . '/dist/' . $asset;
}

function asset( $asset ) {
    echo get_template_directory_uri() . '/dist/' . $asset;
}

/**
 * Import Theme styles and scripts
 */
pcInclude('/functions/theme/themeFiles.php');

/**
 * Set theme settings
 */
pcInclude('/functions/theme/themeSettings.php');

/**
 * Active timber
 */
pcInclude('/functions/timber/init.php');

/**
 * Global query settings
 */
pcInclude('/functions/query.php');
pcInclude('/functions/ajax.php');


/**
 * ACF options page
 */
acf_add_options_page(array(
    'page_title' 	=> 'Ustawienia globalne',
    'menu_title'	=> 'Ustawienia globalne',
    'menu_slug' 	=> 'global-settings',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
));

acf_add_options_sub_page(array(
    'page_title' 	=> 'Ustawienia stopki',
    'menu_title'	=> 'Ustawienia stopki',
    'parent_slug'	=> 'global-settings',
));
