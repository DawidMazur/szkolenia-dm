<?php

// add_action( 
//     'wp_ajax_nopriv_pc_check_cert', 'pc_check_cert'
// );
// add_action( 
//     'wp_ajax_pc_check_cert', 'pc_check_cert'
// );
// function pc_check_cert() {
//     // wp_send_json($_POST);

//     if(! isset($_POST['data']['cert_id']) || !isset($_POST['data']['cert_user'])) {
//         wp_send_json([
//             'status' => 'error',
//             'message' => __('Certyfikat o tym numerze nie istnieje', 'ws'),
//         ]);
//     }

//     if(WooFunctions::check_certificate($_POST['data']['cert_id'], true, $_POST['data']['cert_user'])) {
//         $url = WooFunctions::get_certificate_url($_POST['data']['cert_id'], true, $_POST['data']['cert_user']);

//         wp_send_json([
//             'status' => 'success',
//             'url' => $url
//         ]);
//     }

//     wp_send_json([
//         'status' => 'error',
//         'message' => __('Certyfikat o tym numerze nie istnieje', 'ws'),
//     ]);
// }


class AjaxEndpoints {
    public static function init() {
        AjaxEndpoints::add_ajax_endpoint('find_post');
    }

    private static function add_ajax_endpoint($name) {
        add_action( 
            'wp_ajax_nopriv_' . $name , [
                'AjaxEndpoints',
                $name
            ]
        );
        add_action( 
            'wp_ajax_' . $name , [
                'AjaxEndpoints',
                $name
            ]
        );
    }

    public static function find_post() {
        $name = $_POST['data']['name'];

        $posts = get_posts([
            'post_type' => 'example_posts',
            'posts_per_page' => -1,
            // 's' => $name,
            'meta_query' => [
                [
                    'key' => 'info_test',
                    'value' => $name,
                    'compare' => 'LIKE',
                ]
            ]
        ]);

        if(empty( $posts )) {
            wp_send_json([
                'status' => '404',
                'message' => 'Brak posta',
            ]);
        }

        $post = $posts[0];

        $post->acf = get_fields($post->ID);
        $post->url = get_the_permalink($post->ID );

        $html = Timber::compile('views/components/post-prev/post-prev.twig', [ 'post' => $post ]);

        wp_send_json([
            'status' => '200',
            'message' => $html,
        ]);
    }

    public static function create_post() {
        $title = $_POST['data']['title'];

        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_type' => 'example_posts',
        ]);

        update_field('test', $title, $post_id);
    }
}
AjaxEndpoints::init();