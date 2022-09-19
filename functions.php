<?php
/**
 *
 * @package ws
 */

/**
 * Import function
 */

add_filter( 'acf_the_content', function($value) {
    return str_replace('&nbsp;', '', $value);
}, 999, 1 );

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