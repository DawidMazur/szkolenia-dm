<?php
/**
 * Import Timber files
 */

pcInclude('/vendor/autoload.php');

/**
 * Init Timber
 */
$timber = new Timber\Timber();

$gbm_path = '/functions/timber/';
pcInclude($gbm_path  . 'content_settings.php');

add_filter('timber/twig', 'pc_favorite_functions');

function pc_favorite_functions( $twig ) {
    $functions_names = [
        'printr',
        'd',
        'get_asset',
        'function_exists',
        'pll__',
        'get_field',
        'get_fields',
        'do_shortcode',
        'date',

        'array_shift',
        'array_merge',
        'array_slice',
        
        'get_permalink',
        'the_permalink',
        'get_term_link',

        'do_action',
        'sprintf',
        'get_option',

        'ts',
    ];

    if( !empty($functions_names) ) {
        foreach( $functions_names as $name ) {
            $twig->addFunction( new Timber\Twig_Function($name, $name) );
        }
    }

    return $twig;
}

add_filter('timber/twig', 'pc_woo_functions');

function pc_woo_functions( $twig ) {
    $functions_names = [
        'apply_filters',
        'esc_html_e',
        'wp_nonce_field',
        'esc_attr',
        'esc_html',
        'has_action',
        'esc_url',
        'wc_format_datetime',
        'wc_get_order_status_name',
        'esc_attr_e',
        'wp_unslash',
        
    ];

    if( !empty($functions_names) ) {
        foreach( $functions_names as $name ) {
            $twig->addFunction( new Timber\Twig_Function($name, $name) );
        }
    }

    return $twig;
}

function ts($path) {
    switch($path) {
        case 'image': return "basic/image/image.twig";
        case 'button': return "ui/buttons/button-std/button-std.twig";
        case 'render-form': return "components/render-form/render-form.twig";
        case 'social-media': return "views/components/social-media/social-media.twig";
    }

    return ts_woo($path);
}

function ts_woo($path) {
    switch($path) {
        case 'woo/product-preview': return "woocommerce/product-prewiev/product-prewiev.twig";
        case 'woo/cart/product': return "woocommerce/components/cart/product/cart_product.twig";
    }

    return $path;
}