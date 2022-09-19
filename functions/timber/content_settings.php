<?php


add_filter( 'timber/context', 'pc_timber_add_acf_to_context' );
function pc_timber_add_acf_to_context( $context ) {
    $context['acf'] = get_fields();
	$context['acf_global'] = get_fields('options');

    global $post;
    $context['content'] = $post->post_content;
    $context['post'] = $post;

    $context['localhost'] = strpos(get_home_url(), 'localhost');

    global $wp;
    $context['current_url'] = home_url( $wp->request );


    if(is_archive() || is_category() ) {
        // foreach($context['posts'] as $item) {
        //     do something with $item
        // }

        // do something for archive pages
    }

    // if breadcrumbs needed
    // $context['breadcrumbs_list'] = pc_breadcrumbs_list();

    return $context;
}

add_filter( 'timber/context', 'pc_timber_add_menu_to_context' );
function pc_timber_add_menu_to_context( $context ) {
    foreach (get_registered_nav_menus() as $menu => $menu_label) {
        $context['menu'][$menu] = new \Timber\Menu( $menu );
    }
    return $context;
}



/**
 * Prepare breadcrumbs list
 */
function pc_breadcrumbs_list() {
    $list = [];

    // homepage
    $list[] = [
        'url' => home_url(),
        'title' => pll__('Strona główna'),
    ];

    // archive

    if( is_category() ) {
        $cat = get_queried_object();

        $postType = get_post_type_object('product');
        $list[] = [
            'url' => get_post_type_archive_link(get_post_type()),
            'title' => $postType->labels->name,
        ];

        $list[] = [
            'title' => $cat->name,
            'current' => true,
        ];

        return $list;
    }

    // archive but not category
    if(is_archive()) {
        $postType = get_post_type_object(get_post_type());

        $list[] = [
            'title' => $postType->labels->name,
            'current' => true,
        ];
    }


    if( is_single() ) {
        $postType = get_post_type_object(get_post_type());
        $list[] = [
            'url' => get_post_type_archive_link(get_post_type()),
            'title' => $postType->labels->name,
        ];

        if( has_category() ) {
            $cat = get_the_category()[0];
            $list[] = [
                'url' => get_category_link($cat),
                'title' => $cat->name,
            ];
        }

        // current page
        $list[] = [
            'title' => get_the_title(),
            'current' => true,
        ];

        return $list;
    }

    if(is_singular( )) {
        // current page
        $list[] = [
            'title' => get_the_title(),
            'current' => true,
        ];
    }

    return $list;
}
