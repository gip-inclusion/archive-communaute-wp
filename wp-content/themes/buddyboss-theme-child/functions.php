<?php

function custom_wp_enqueue_scripts() {
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}
add_action('wp_enqueue_scripts', 'custom_wp_enqueue_scripts');


function custom_login_style() {
  wp_enqueue_style('buddyboss-theme-login', get_template_directory_uri() . '/assets/css/login.min.css');
  wp_enqueue_style('child-login', get_stylesheet_directory_uri() . '/assets/css/login.css', array('buddyboss-theme-login'));  
}
add_action('login_enqueue_scripts', 'custom_login_style');


function custom_mail_from($email) {
  return 'noreply@inclusion.beta.gouv.fr';
}
add_filter('wp_mail_from', 'custom_mail_from');


// function custom_mail_from_name($name) {
//   return 'La communauté de l’inclusion';
// }
// add_filter('wp_mail_from_name', 'custom_mail_from_name');


// function custom_send_smtp_email($phpmailer) {
//   $phpmailer->isSMTP();
// 	$phpmailer->Host       = SMTP_HOST;
// 	$phpmailer->SMTPAuth   = SMTP_AUTH;
// 	$phpmailer->Port       = SMTP_PORT;
// 	$phpmailer->Username   = SMTP_USER;
// 	$phpmailer->Password   = SMTP_PASS;
// 	$phpmailer->SMTPSecure = SMTP_SECURE;
// 	$phpmailer->From       = SMTP_FROM;
// 	$phpmailer->FromName   = SMTP_NAME;
// }
// add_action('phpmailer_init', 'custom_send_smtp_email');



function delete_script_version($src) {
  $parts = explode('?', $src);
  return $parts[0];
}
add_filter('script_loader_src', 'delete_script_version', 15, 1);
add_filter('style_loader_src', 'delete_script_version', 15, 1);

remove_action('wp_head', 'wp_generator');


function is_post_type($type) {
  global $wp_query;
  if($type == get_post_type($wp_query->post->ID)) {
    return true;
  } else {
    return false;
  }
}


function custom_register_nav_menu(){
  register_nav_menus( array(
    'header-menu-mobile'		=> 'Primary Mobile',
  ) );
}
add_action( 'after_setup_theme', 'custom_register_nav_menu', 0 );
