<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="scn-loader" class="scn-loader" aria-hidden="true">
	<div class="scn-loader__inner">
		<div class="scn-loader__glow"></div>
		<img src="<?php scn_url( 'loader_image' ); ?>" alt="Loading" class="scn-loader__orb" />
	</div>
</div>

<img src="<?php scn_url( 'background_image' ); ?>" alt="" class="scn-bg" />
<div class="scn-bg-overlay"></div>

<header class="scn-header">
	<div class="scn-header__wrap">
		<div class="scn-header__bar">
			<a class="scn-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( scn_logo_url() ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
			</a>

			<nav class="scn-nav desktop-nav" aria-label="<?php esc_attr_e( 'Primary', 'smartcodenucleo' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'nav-list',
						'fallback_cb'    => 'scn_fallback_menu',
						'depth'          => 1,
					)
				);
				?>
			</nav>

			<button type="button" class="scn-burger" id="scn-burger" aria-label="Menu">
				<span></span><span></span><span></span>
			</button>
		</div>

		<div class="scn-mobile-menu" id="scn-mobile-menu" hidden>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'mobile-nav-list',
					'fallback_cb'    => 'scn_fallback_menu',
					'depth'          => 1,
				)
			);
			?>
		</div>
	</div>
</header>
