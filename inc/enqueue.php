<?php

defined('ABSPATH') || exit;

// Enqueue style and script file.
function themename_enqueue() {

    // Style
    wp_enqueue_style( 'style', get_template_directory_uri() . '/dist/css/main.css', array(), filemtime(get_template_directory() . '/dist/css/main.css'), 'all' );

    // Script
    wp_enqueue_script( 'main', get_template_directory_uri() . '/dist/js/main.min.js', array(), filemtime(get_template_directory() . '/dist/js/main.min.js'), true );

}
add_action( 'wp_enqueue_scripts', 'themename_enqueue' );