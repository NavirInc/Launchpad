<?php
/**
 * Theme Name functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme_Name
 * @since Theme_Name 0.0.0
 */


/*
 * ================================ THEME SETUP ===============================
 * 
 */

if ( ! defined( 'THEMENAME_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( 'THEMENAME_VERSION', '0.0.0' );
}

function themename_setup() {

    // Make theme available for translation.
    load_theme_textdomain( 'theme-name', get_template_directory() . '/languages' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages. Specify which post type. https://developer.wordpress.org/reference/functions/add_theme_support/
    add_theme_support( 'post-thumbnails', array( 'post' ) );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

}
add_action( 'after_setup_theme', 'themename_setup' );

// Enqueue style and script file.
function themename_scripts() {

    // Style
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.min.css', array(), THEMENAME_VERSION, 'all' );

    // Script
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.min.js', array(), THEMENAME_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'themename_scripts' );


/*
 * ================================ SMTP EMAILS ===============================
 * 
 * Use SMTP to send emails.
 */

// // To setup, add this code to config.php, then delete.
// define( 'SMTP_username', 'your-email@gmail.com' );
// define( 'SMTP_password', 'your-gmail-app-password' );
// define( 'SMTP_server', 'smtp.gmail.com' );
// define( 'SMTP_FROM', 'your-sender-email@gmail.com' );
// define( 'SMTP_NAME', 'Your Name' );
// define( 'SMTP_PORT', '587' );
// define( 'SMTP_SECURE', 'tls' );
// define( 'SMTP_AUTH', true );
// define( 'SMTP_DEBUG', 0 );

// function my_phpmailer_smtp( $phpmailer ) {
//     $phpmailer->isSMTP();
//     $phpmailer->Host = SMTP_server;
//     $phpmailer->SMTPAuth = SMTP_AUTH;
//     $phpmailer->Port = SMTP_PORT;
//     $phpmailer->Username = SMTP_username;
//     $phpmailer->Password = SMTP_password;
//     $phpmailer->SMTPSecure = SMTP_SECURE;
//     $phpmailer->From = SMTP_FROM;
//     $phpmailer->FromName = SMTP_NAME;
// }
// add_action( 'phpmailer_init', 'my_phpmailer_smtp' );


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
 * ================================ ADMIN MENU ================================
 * 
 * Uncomment the proper section.
 */

function menu_modification() {
    //remove_menu_page('edit.php'); // Remove "Post" from admin menu.
    // Add other modification here.
}
add_action('admin_menu', 'menu_modification');


/*
 * ================================= COMMENTS =================================
 * 
 * Uncomment the proper section to activate or deactivate comments on the site.
 */

/* ----- To activate comments ----- */

// // Support the new JavaScript functionality with comment threading
// function lunchpad_enqueue_comment_reply_script() {
//     if ( get_option( 'thread_comments' ) ) {
//         wp_enqueue_script( 'comment-reply' );
//     }
// }
// add_action( 'comment_form_before', 'lunchpad_enqueue_comment_reply_script' );

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
 * ============================== DISABLE EMOJIS ==============================
 * 
 * From the work of David Peach.
 * https://gist.github.com/davidpeach/39d9de2f3e8f4ca841771727edb75098
 */

 function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}


/*
 * ========================== ROLES AND CAPABILITIES ==========================
 * 
 * If necessary, execute this code one time only to configure the roles and capabilities, then delete this section.
 * https://codex.wordpress.org/Roles_and_Capabilities
 */

// // Remove default roles
// remove_role( 'subscriber' );
// remove_role( 'editor' );
// remove_role( 'contributor' );
// remove_role( 'author' );

// // Add new role - Change the role name and capalities before executing.
// add_role('role', 'Role', array(
//     'activate_plugins' => true,
//     'delete_others_pages' => true,
//     'delete_others_posts' => true,
//     'delete_pages' => true,
//     'delete_posts' => true,
//     'delete_private_pages' => true,
//     'delete_private_posts' => true,
//     'delete_published_pages' => true,
//     'delete_published_posts' => true,
//     'edit_dashboard' => true,
//     'edit_others_pages' => true,
//     'edit_others_posts' => true,
//     'edit_pages' => true,
//     'edit_posts' => true,
//     'edit_private_pages' => true,
//     'edit_private_posts' => true,
//     'edit_published_pages' => true,
//     'edit_published_posts' => true,
//     'edit_theme_options' => true,
//     'export' => true,
//     'import' => true,
//     'list_users' => true,
//     'manage_categories' => true,
//     'manage_links' => true,
//     'manage_options' => true,
//     'moderate_comments' => true,
//     'promote_users' => true,
//     'publish_pages' => true,
//     'publish_posts' => true,
//     'read_private_pages' => true,
//     'read_private_posts' => true,
//     'read' => true,
//     'remove_users' => true,
//     'switch_themes' => true,
//     'upload_files' => true,
//     'customize' => true,
//     'delete_site' => true,
//     'update_core' => true,
//     'update_plugins' => true,
//     'update_themes' => true,
//     'install_plugins' => true,
//     'install_themes' => true,
//     'delete_themes' => true,
//     'delete_plugins' => true,
//     'edit_plugins' => true,
//     'edit_themes' => true,
//     'edit_files' => true,
//     'edit_users' => true,
//     'add_users' => true,
//     'create_users' => true,
//     'delete_users' => true,
//     'unfiltered_html' => true,
// ));