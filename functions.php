<?php
/**
 * THEMENAME functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package THEMENAME
 * @since THEMENAME 0.0.0
 */


/*
 * ================================ THEME SETUP ===============================
 * 
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
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.min.css', array(), THEMENAME_VERSION, 'all' );

    // Script
    wp_enqueue_script( 'main', $this->appConfig['template_url']['assets']['js'] . '/main.min.js', array(), TEMPLATE_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'THEMENAME_scripts' );


/*
 * ================================ SMTP EMAILS ===============================
 * 
 * Use SMTP to send emails.
 */

// To setup add this code to config.php, then delete.
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


/*
 * ================================ SVG SUPPORT ===============================
 * 
 * Add SVG support.
 */

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


/*
 * ============================ GOOGLE TAG MANAGER ============================
 * 
 * Add Google Tag Manager javascript code as close to the opening <head> tag
 * as possible and immediately after the opening <body> tag. Dont forget to
 * change GTM ID.
 */

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

function google_tag_manager_body(){
?>
    <!-- Google Tag Manager (noscript) --> <!-- CHANGE GTM ID AND DELETE THIS COMMENT -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXXX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php 
}
add_action( 'body_top', 'google_tag_manager_body' );


/*
 * ================================= COMMENTS =================================
 * 
 * Uncomment the proper section to activate or deactivate comments on the site.
 */

/* ----- To activate comments ----- */

// // Support the new JavaScript functionality with comment threading
// function THEMENAME_enqueue_comment_reply_script() {
//     if ( get_option( 'thread_comments' ) ) {
//         wp_enqueue_script( 'comment-reply' );
//     }
// }
// add_action( 'comment_form_before', 'THEMENAME_enqueue_comment_reply_script' );

/* ------ To globally deactivate comments ------ */
//See the code here (end of comment section): https://gist.github.com/mattclements/eab5ef656b2f946c4bfb

add_action('admin_init', function () {
	// Redirect any user trying to access comments page
	global $pagenow;

	if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
		wp_redirect(admin_url());
		exit;
	}

	// Remove comments metabox from dashboard
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

	// Disable support for comments and trackbacks in post types
	foreach (get_post_types() as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
	remove_submenu_page('options-general.php', 'options-discussion.php');
});

// Remove comments links from admin bar
add_action('init', function () {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
});

// Remove comments icon from admin bar
add_action('wp_before_admin_bar_render', function() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
});

// Return a comment count of zero to hide existing comment entry link.
function zero_comment_count($count){
	return 0;
}
add_filter('get_comments_number', 'zero_comment_count');

// Multisite - Remove manage comments from admin bar
add_action( 'admin_bar_menu', 'remove_toolbar_items', PHP_INT_MAX -1 );
function remove_toolbar_items( $bar )
{
	$sites = get_blogs_of_user( get_current_user_id() );
	foreach ( $sites as $site )
	{
		$bar->remove_node( "blog-{$site->userblog_id}-c" );
	}
}


/*
 * ========================== ROLES AND CAPABILITIES ==========================
 * 
 * Execute this code one time only to configure the roles and capabilities.
 * https://codex.wordpress.org/Roles_and_Capabilities
 */

// Remove default roles
remove_role( 'subscriber' );
remove_role( 'editor' );
remove_role( 'contributor' );
remove_role( 'author' );

// Add new role  ---> TBD
add_role('proprietaire', 'Propriétaire', array(
    'read' => true,
    'create_posts' => true,
    'edit_posts' => true,
    'edit_others_posts' => true,
    'publish_posts' => true,
    'manage_categories' => true,
));