<?php

defined('ABSPATH') || exit;

// Menu
function themename_admin_menu() {
    remove_menu_page( 'meta-box' );
}

add_action( 'admin_init', 'themename_admin_menu' );