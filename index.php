<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

 if (strstr($_SERVER['SERVER_NAME'], '.local')) {
	echo '<p style="text-align:center;padding:8px;margin:0;background-color:MediumBlue;color:white;font-weight:700;position:sticky;top:0;z-index:1000;">LOCAL</p>';
} elseif (strstr($_SERVER['SERVER_NAME'], '.cleverapps.io')) {
	echo '<p style="text-align:center;padding:8px;margin:0;background-color:Crimson;color:white;font-weight:700;position:sticky;top:0;z-index:1000;">STAGING</p>';
} 

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
