<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
			$current_url = itou_get_current_url();
		?>
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
	<?php
	if (strstr($_SERVER['SERVER_NAME'], '.local')) {
			echo '<p style="text-align:center;padding:8px;margin:0;background-color:MediumBlue;color:white;font-weight:700;position:sticky;top:0;z-index:1000;">LOCAL</p>';
		} elseif (strstr($_SERVER['SERVER_NAME'], '.cleverapps.io')) {
			echo '<p style="text-align:center;padding:8px;margin:0;background-color:Crimson;color:white;font-weight:700;position:sticky;top:0;z-index:1000;">STAGING</p>';
		}
		?>

		<?php wp_body_open(); ?>

		<?php if (!is_singular('llms_my_certificate')):

			do_action( THEME_HOOK_PREFIX . 'before_page' );

		endif; ?>

		<div id="page" class="site">

			<?php do_action( THEME_HOOK_PREFIX . 'before_header' ); ?>

			<header id="masthead" class="<?php echo apply_filters( 'buddyboss_site_header_class', 'site-header site-header--bb' ); ?>">
				<?php do_action( THEME_HOOK_PREFIX . 'header' ); ?>
			</header>

			<?php do_action( THEME_HOOK_PREFIX . 'after_header' ); ?>

			<?php do_action( THEME_HOOK_PREFIX . 'before_content' ); ?>

			<div id="content" class="site-content">

				<?php do_action( THEME_HOOK_PREFIX . 'begin_content' ); ?>

				<div class="container">
					<div class="<?php echo apply_filters( 'buddyboss_site_content_grid_class', 'bb-grid site-content-grid' ); ?>">
