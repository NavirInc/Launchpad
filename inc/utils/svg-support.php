<?php

defined('ABSPATH') || exit;

// Add SVG support
function themename_svg_support($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'themename_svg_support');

// Fix SVG Display in the Media Library
function themename_fix_svg_preview($response, $attachment, $meta) {
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
add_filter('wp_prepare_attachment_for_js', 'themename_fix_svg_preview', 10, 3);

