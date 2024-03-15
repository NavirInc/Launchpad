<?php
/**
 * THEMENAME functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package THEMENAME
 * @since THEMENAME 0.0.0
 */

if ( ! defined( 'THEMENAME_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( 'THEMENAME_VERSION', '1.0.0' );
}


function THEMENAME_setup() {

    // Make theme available for translation.
    load_theme_textdomain( 'THEMENAME', get_template_directory() . '/languages' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages. Specify which post type. https://developer.wordpress.org/reference/functions/add_theme_support/
    add_theme_support( 'post-thumbnails', array( 'post' ) );

    // // Add default posts and comments RSS feed links to head.
	// add_theme_support( 'automatic-feed-links' );

}
add_action( 'after_setup_theme', 'THEMENAME_setup' );


function THEMENAME_scripts() {

    // Style
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), THEMENAME_VERSION, 'all' );

    // Script
    wp_enqueue_script( 'main', $this->appConfig['template_url']['assets']['js'] . '/main.js', array(), TEMPLATE_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'THEMENAME_scripts' );


// // Support the new JavaScript functionality with comment threading
// function THEMENAME_enqueue_comment_reply_script() {
//     if ( get_option( 'thread_comments' ) ) {
//         wp_enqueue_script( 'comment-reply' );
//     }
// }
// add_action( 'comment_form_before', 'THEMENAME_enqueue_comment_reply_script' );


// // Sanitize file name. --->  LOOK IF THIS IS WORKING
// add_filter('sanitize_file_name', 'remove_accents' );