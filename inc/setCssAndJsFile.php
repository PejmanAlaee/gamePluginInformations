<?php

function wp_data_load_assets()
{

    wp_register_style('wp_data_style', WF_data_URL . 'assets/css/cssFile.css');
    wp_enqueue_style('wp_data_style');
    wp_register_script('wp_data_script', WF_data_URL . 'assets/js/jsFile.js',['jquery']);
    wp_enqueue_script('wp_data_script');
    
}


add_action('wp_enqueue_scripts', 'wp_data_load_assets');
