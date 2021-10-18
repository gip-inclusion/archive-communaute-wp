<?php

function custom_wp_enqueue_scripts() {
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));

  wp_enqueue_style('login-css-css', get_template_directory_uri() . '/assets/css/login.css');
  wp_enqueue_style('child-login', get_stylesheet_directory_uri() . '/login.css', array('login-css'));
}
add_action('wp_enqueue_scripts', 'custom_wp_enqueue_scripts');





// function wpm_traduction($texte) { 
//   $texte = str_ireplace('actualités', 'je teste', $texte); 
// 	return $texte; 
// } 

// add_filter('gettext', 'wpm_traduction'); 
// add_filter('ngettext', 'wpm_traduction');
