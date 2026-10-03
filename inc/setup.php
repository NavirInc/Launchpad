<?php

defined('ABSPATH') || exit;

// Theme setup
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