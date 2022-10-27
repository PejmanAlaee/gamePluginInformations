<?php

add_action('init', function () {
    add_shortcode('data', 'data_setter');
});


function data_setter($atts, $content = null)
{
    global $wpdb;
    /*
    $dataFile =  $wpdb->get_results("SELECT * FROM {$wpdb->prefix}opp");
                                                    $w = json_decode($result['body']);
                                                    foreach ($w->results as $a) {
                                                        if($term->name == $a->title){
                                                            echo $a->title;

                                                        }
                                                    
                                                       
                                                    }
                                          
*/

    $url = 'https://api.bitpin.ir/v1/mkt/currencies/';

    $result = wp_remote_get($url);
    $url = 'https://api.bitpin.ir/v1/mkt/currencies/';

    $result = wp_remote_get($url);
    //print_r($result['count']);
    //print($result["count"]);
    $w = json_decode($result['body']);
/*
    // print_r( $w->results);
    foreach ($w->results as $a) {

        print($a->price_info->price);
    }
    */
    ob_start(); {
    }

    include WF_data_tpl . "front/mainFrontPage.php";


    return ob_get_clean();
}
