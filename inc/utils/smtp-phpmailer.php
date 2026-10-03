<?php

defined('ABSPATH') || exit;

/*
 * ================================ SMTP EMAILS ===============================
 * 
 * Use SMTP to send emails.
 */

// // To setup, add this code to config.php, then delete. (add this exemple to a file named config.example??)
// define( 'SMTP_username', 'your-email@gmail.com' );
// define( 'SMTP_password', 'your-gmail-app-password' );
// define( 'SMTP_server', 'smtp.gmail.com' );
// define( 'SMTP_FROM', 'your-sender-email@gmail.com' );
// define( 'SMTP_NAME', 'Your Name' );
// define( 'SMTP_PORT', '587' );
// define( 'SMTP_SECURE', 'tls' );
// define( 'SMTP_AUTH', true );
// define( 'SMTP_DEBUG', 0 );

// function themename_smtp_phpmailer( $phpmailer ) {
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
// add_action( 'phpmailer_init', 'themename_smtp_phpmailer' );