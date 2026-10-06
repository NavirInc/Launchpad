<?php
/**
 * This file loads the theme's core includes, initializes the theme,
 * and registers required functionality such as menus, assets, metaboxes,
 * and WordPress cleanup features.
 */

defined('ABSPATH') || exit;

$launchpad_includes = [
    'setup',
    'enqueue',
    'admin-menu',
    'metabox/post-types',  //TBD
    'metabox/fields',  //TBD
    'utils/svg-support', //TBD
    'utils/smtp-phpmailer',  //TBD
    'utils/disable-gutenberg',  //TBD
    'utils/disable-comments',  //TBD
    'utils/disable-emojis',  //TBD
];

foreach ($launchpad_includes as $file) {
    $path = get_template_directory() . "/inc/{$file}.php";
    if (file_exists($path)) {
        require_once $path;
    }
}