<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicons -->
	<link rel="icon" href="data:image/svg+xml,%3Csvg viewBox='0 0 30 30'%3E%3Cstyle%3Epath%7Bfill:%23d1af66%7D@media(prefers-color-scheme:dark)%7Bpath%7Bfill:%23fff%7D%7D%3C/style%3E%3Cpath d='M13.35.09v2.07c0 .9.74 14.41 1.65 14.41s1.65-13.5 1.65-14.41V.09c8.24.91 14.17 8.32 13.26 16.56s-8.32 14.17-16.56 13.26S-.81 21.59 .09 13.35C.86 6.37 6.37 .86 13.35 .09'/%3E%3C/svg%3E">
	<link rel="icon" type="image/png" sizes="32x32" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAnFBMVEUAAADRr2bRr2XRr2bAoFzPrWWni1DPrmXRr2bRr2bRr2bRr2amik+qjlKylVaqjVG1mFenjFDRr2amik+8nVvRr2atkFPRr2bPrWXOrWTEpF+xlFbRr2azllbMq2O2mFi4mlmwk1SkiU7Ip2HEpF/GpWDQrmW/oFypjVHCol7AoV2ukVPOrGS8nVu7nFqsj1Kni1DJqGK9nlvKqWI3Ald5AAAAHHRSTlMAwIBAIFDAMPDQqGBQgFAw8PDg0MBwYBDw8NDQOdrQ5AAAAS5JREFUOMt1jtl6gjAQRv+EsLrvXdKWKoqiKOr7v1uzANNQeu4mZ843ARFyJj3Ak4yH+IsfS4VZUMQDuAgmDStgJQ1MOHkkLRzg0hL55AeyIQGSdhi0vWxhAKPJr+9H9DQH5jRFAoBJCOD3xJoDxGYjLfSN2HnxPGeMgVD2LBAhuHTg3Rns34XD4XC5MEiXJCH5qXh2FxjTrpb3+25HCzZ8ebXuqdxuv99nIEdhI7PsdIJ7sZGZkUVR5OgPtczz/PEowbRzZWFlWZbX6xK8N9Tumqbp1whhb5hqqfiYAG+dkKTiHYBPkpzmWzGGYkmhI8/ncwCNmLqulrfbbSZgGLuhlUfFEDVrNzxqqqpao2U8pdC4arudqZ4QAYVbQyDgMlyYsGZBOTEZBXU8mqDlBxLPZRQz1GJIAAAAAElFTkSuQmCC" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri();?>/img/apple-touch-icon-180-180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_stylesheet_directory_uri();?>/img/android-chrome-192x192.png">
	<!-- Preload -->
	<link rel="preload" href="<?php echo get_bloginfo( 'url' ); ?>/wp-content/uploads/2024/02/P-Kan.webp" as="image">
	<link rel="preload" href="<?php echo get_stylesheet_directory_uri() . '/img/Acupunctuurpraktijk-Kan-logo.svg'; ?>" as="image" type="image/svg+xml">
	<?php wp_head(); ?>
</head>
<body class="antialiased min-h-screen<?php if (is_front_page() || is_home()) { echo " home" ; }  ?>">

<?php do_action( 'apk_site_before' ); ?>



	<?php do_action( 'apk_header' ); ?>

	<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-md focus:bg-black focus:px-4 focus:py-2 focus:text-white">Ga naar inhoud</a>

	<header class="flex justify-between items-center py-6">

		<a href="<?php echo get_bloginfo( 'url' ); ?>">
			<img width="170" height="52" alt="logo image" focusable="false" aria-hidden="true" src="<?php echo get_stylesheet_directory_uri() . '/img/Acupunctuurpraktijk-Kan-logo.svg'; ?>">
			<h1 class="sr-only">
				<?php echo get_bloginfo( 'name' ); ?>
			</h1>
		</a>

		<button aria-label="navigatiemenu openen / sluiten" aria-expanded="false" id="primary-menu-toggle">
			<svg class="icon-menu-open" version="1.1" id="icon-open" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
				<rect y="2" width="24" height="2"/>
				<rect y="11" width="24" height="2"/>
				<rect y="20" width="24" height="2"/>
			</svg>
			<svg class="icon-menu-close" version="1.1" id="icon-close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
				<rect x="0" y="11" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 12 28.9706)" width="24" height="2"/>
				<rect x="0" y="11" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 28.9706 12)" width="24" height="2"/>
			</svg>
		</button>

		<nav id="primary-menu" aria-label="Hoofdnavigatie" class="h-full overflow-x-hidden overflow-y-auto">
		<?php
		wp_nav_menu(
			array(
				'container'       => false,
				'menu_class'      => 'flex-col',
				'submenu_class'	  => '',
				'theme_location'  => 'primary',
				'li_class'        => 'p-4',
				'a_class'        => '',
				'a_class_active'  => 'active',
				'fallback_cb'     => false,
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			)
		);
		?>
		</nav>

	</header>



	<?php do_action( 'apk_content_start' ); ?>

	<main id="main-content" tabindex="-1">
