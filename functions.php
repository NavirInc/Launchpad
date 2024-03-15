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


// Add SVG support. --> TO BE VALIDATED
function enable_svg_support($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'enable_svg_support');

// Fix SVG Display in the Media Library --> TO BE VALIDATED
function fix_svg_preview($response, $attachment, $meta) {
    if ($response['mime'] === 'image/svg+xml') {
        $response['sizes'] = [
            'thumbnail' => [
                'url' => $response['url'],
                'width' => $response['width'],
                'height' => $response['height'],
            ],
        ];
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'fix_svg_preview', 10, 3);


// Add Google Tag Manager javascript code as close to the opening <head> tag as possible
function google_tag_manager_head(){
?>
    <!-- Google Tag Manager --> <!-- CHANGE GTM ID AND DELETE THIS COMMENT -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-XXXXXXXX');</script>
    <!-- End Google Tag Manager -->
<?php 
}
add_action( 'wp_head', 'google_tag_manager_head', 10 );

// Add Google Tag Manager noscript codeimmediately after the opening <body> tag
function google_tag_manager_body(){
?>
    <!-- Google Tag Manager (noscript) --> <!-- CHANGE GTM ID AND DELETE THIS COMMENT -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXXX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php 
}
add_action( 'body_top', 'google_tag_manager_body' );


// // Support the new JavaScript functionality with comment threading
// function THEMENAME_enqueue_comment_reply_script() {
//     if ( get_option( 'thread_comments' ) ) {
//         wp_enqueue_script( 'comment-reply' );
//     }
// }
// add_action( 'comment_form_before', 'THEMENAME_enqueue_comment_reply_script' );


// // Sanitize file name. --> TO BE VALIDATED
// add_filter('sanitize_file_name', 'remove_accents' );


