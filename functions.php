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


// Enqueue style and script file.
function THEMENAME_scripts() {

    // Style
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), THEMENAME_VERSION, 'all' );

    // Script
    wp_enqueue_script( 'main', $this->appConfig['template_url']['assets']['js'] . '/main.js', array(), TEMPLATE_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'THEMENAME_scripts' );


// Use SMTP to send emails.

// Add this code to config.php, then delete.
// define( 'SMTP_username', 'your-email@gmail.com' );
// define( 'SMTP_password', 'your-gmail-app-password' );
// define( 'SMTP_server', 'smtp.gmail.com' );
// define( 'SMTP_FROM', 'your-sender-email@gmail.com' );
// define( 'SMTP_NAME', 'Your Name' );
// define( 'SMTP_PORT', '587' );
// define( 'SMTP_SECURE', 'tls' );
// define( 'SMTP_AUTH', true );
// define( 'SMTP_DEBUG', 0 );

function my_phpmailer_smtp( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host = SMTP_server;
    $phpmailer->SMTPAuth = SMTP_AUTH;
    $phpmailer->Port = SMTP_PORT;
    $phpmailer->Username = SMTP_username;
    $phpmailer->Password = SMTP_password;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From = SMTP_FROM;
    $phpmailer->FromName = SMTP_NAME;
}
add_action( 'phpmailer_init', 'my_phpmailer_smtp' );


// // Support the new JavaScript functionality with comment threading
// function THEMENAME_enqueue_comment_reply_script() {
//     if ( get_option( 'thread_comments' ) ) {
//         wp_enqueue_script( 'comment-reply' );
//     }
// }
// add_action( 'comment_form_before', 'THEMENAME_enqueue_comment_reply_script' );


// // Sanitize file name. --->  LOOK IF THIS IS WORKING
// add_filter('sanitize_file_name', 'remove_accents' );