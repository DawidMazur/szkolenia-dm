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
                $name,
            ]
        );
        add_action( 
            'wp_ajax_' . $name , [
                'AjaxEndpoints',
                $name,
            ]
        );
    }

    public static function find_post() {
        $name = $_POST['data']['name'];

        $posts = get_posts([
            'post_type' => 'example_posts',
            'post_per_page' => -1,
            //'s' => $name,
            'meta_query' => [
                [
                    'key' => 'info_test',
                    'value' => $name,
                    'compare' => 'LIKE',
                ]
            ]
        ]);

        $titles = [];

        foreach($posts ?: [] as $post) {
            $titles[] = $post->post_title;
        }

        wp_send_json([
            'status' => 200,
            'message' => $titles,
        ]);
    }
}
AjaxEndpoints::init();