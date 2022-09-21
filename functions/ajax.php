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

/* class AjaxEndpoints {
    public static function add_ajax_endpoint($name){
        add_action(
            'wp_ajax_napriv',    
        );
    }
    public static function find_post(){

    }

} */