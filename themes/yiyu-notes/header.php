<?php
/** Site header. @package Yiyu_Notes */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content"><?php esc_html_e( '跳到正文', 'yiyu-notes' ); ?></a>
<header class="site-header">
	<div class="site-shell header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="brand-mark" aria-hidden="true">晨</span>
			<span><?php bloginfo( 'name' ); ?></span>
		</a>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation"><?php esc_html_e( '菜单', 'yiyu-notes' ); ?></button>
		<nav id="primary-navigation" class="site-navigation" aria-label="<?php esc_attr_e( '主导航', 'yiyu-notes' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'primary-menu',
					'fallback_cb'    => 'yiyu_notes_fallback_menu',
					'depth'          => 2,
				)
			);
			?>
		</nav>
	</div>
</header>
<main id="main-content">
