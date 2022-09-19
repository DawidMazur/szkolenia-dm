<?php

add_action( 
    'wp_ajax_nopriv_pc_check_cert', 'pc_check_cert'
);
add_action( 
    'wp_ajax_pc_check_cert', 'pc_check_cert'
);
function pc_check_cert() {
    // wp_send_json($_POST);

    if(! isset($_POST['data']['cert_id']) || !isset($_POST['data']['cert_user'])) {
        wp_send_json([
            'status' => 'error',
            'message' => __('Certyfikat o tym numerze nie istnieje', 'ws'),
        ]);
    }

    if(WooFunctions::check_certificate($_POST['data']['cert_id'], true, $_POST['data']['cert_user'])) {
        $url = WooFunctions::get_certificate_url($_POST['data']['cert_id'], true, $_POST['data']['cert_user']);

        wp_send_json([
            'status' => 'success',
            'url' => $url
        ]);
    }

    wp_send_json([
        'status' => 'error',
        'message' => __('Certyfikat o tym numerze nie istnieje', 'ws'),
    ]);
}

add_action( 
    'wp_ajax_pc_update_video_info', 'pc_update_video_info'
);

function pc_update_video_info() {
    if(!$_POST['data']['id']) {
        die();
    }

    $arr = get_field('watched_video', 'user_' . get_current_user_id());
    
    if($arr) {
        for($i=0; $i<count($arr); $i++) {
            if($arr[$i]['id'] == $_POST['data']['id']) {
                $arr[$i]['watched'] = $_POST['data']['watched'] == 'true' ? 1 : 0 ;
                $arr[$i]['time'] = $_POST['data']['time'];

                update_field('watched_video', $arr, 'user_' . get_current_user_id());
                wp_send_json([
                    'status' => 'success',
                    'data' => $arr,
                    'post' => $_POST['data'],
                ]);
            }
        }

        $arr[] = [
            'id' => $_POST['data']['id'],
            'watched' => $_POST['data']['watched'] == 'true' ? 1 : 0 ,
            'time' => $_POST['data']['time'],
        ];

        update_field('watched_video', $arr, 'user_' . get_current_user_id());

        wp_send_json([
            'status' => 'success',
            'data' => $arr,
        ]);
    }



    $arr[] = [
        'id' => $_POST['data']['id'],
        'watched' => $_POST['data']['watched'] == 'true' ? 1 : 0 ,
        'time' => $_POST['data']['time'],
    ];

    update_field('watched_video', $arr, 'user_' . get_current_user_id());

    wp_send_json([
        'status' => 'success',
        'data' => $arr,
    ]);
}