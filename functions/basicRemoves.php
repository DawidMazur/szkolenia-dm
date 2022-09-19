<?php
function pc_deregister_scripts()
{
	wp_deregister_script('wp-embed');
}
remove_action('wp_head', 'wp_generator');
add_action('wp_footer', 'pc_deregister_scripts');
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
remove_action('wp_head', 'wp_resource_hints', 2);
add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
remove_action('welcome_panel', 'wp_welcome_panel');
function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array(
			'wpemoji'
		));
	} else {
		return array();
	}
}

function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
	if ('dns-prefetch' == $relation_type) {
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
		$urls          = array_diff($urls, array(
			$emoji_svg_url
		));
	}

	return $urls;
}

/**
 * Remove default woocommerce styles
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');


/**
 * Remove CF7 styles
 */
function removeStyles()
{
	wp_deregister_style('contact-form-7');
	wp_dequeue_style('wp-block-library');
}
add_action('wp_print_styles', 'removeStyles', 100);


/**
 * Remove some not used things in menu
 */
function remove_admin_menus() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
	// remove_menu_page( 'tools.php' );
	remove_submenu_page( 'options-general.php', 'options-writing.php' );
	remove_submenu_page( 'options-general.php', 'options-discussion.php' );
	remove_submenu_page( 'options-general.php', 'options-media.php' );
	// define('DISALLOW_FILE_EDIT', TRUE);
}
add_action( 'admin_menu', 'remove_admin_menus' );