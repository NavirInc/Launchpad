<?php
/**
 * @package Theme_Name
 * @since Theme_Name 0.0.0
 */

defined('ABSPATH') || exit;

$launchpad_includes = [
    'setup',
    'enqueue',
    'admin-menu',
    'gutenberg',  //TBD
    'metabox/post-types',  //TBD
    'metabox/fields',  //TBD
    'utils/svg-support', //TBD
    'utils/smtp-phpmailer',  //TBD
    'utils/disable-comments',  //TBD
    'utils/disable-emojis',  //TBD
];

foreach ($launchpad_includes as $file) {
    $path = get_template_directory() . "/inc/{$file}.php";
    if (file_exists($path)) {
        require_once $path;
    }
}