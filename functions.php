<?php

/**
 * Theme setup.
 */
function apk_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			// Hoofd-navigatie
			'primary' => __( 'Primary Menu', 'apk' ),
			// Sitemap-navigatie
			'footer' => __( 'Footer Menu', 'apk' ),
		)
	);

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'disable-custom-font-sizes' );
	add_editor_style( 'css/editor-style.css' );
}
add_action( 'after_setup_theme', 'apk_setup' );


function disable_wp_favicon() {
    remove_action('wp_head', 'wp_site_icon', 99);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head');
	remove_action('wp_head', 'rest_output_link_wp_head');
	// remove_action('wp_head', 'wp_oembed_add_discovery_links');
	// remove_action('wp_head', 'wp_oembed_add_host_js');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'disable_wp_favicon');



// De wp block logica gebruiken fullwith en contentwidth ipv die per segment zetten. Heeft in wp meer flexibiliteit
// Tailwind voor reset en minimale css
// Streep onder header
// verticale ruimte afwerken.
// fontscaling voor mobiel
// Sidebars gebruiken.
// Dark theme DIT VERDER WEER UITWERKEN IN ANYTYPE - !


/**
 * Strippen van WP inline css
 */
add_filter('wp_theme_json_data_default', function ($data) {
    $theme = $data->get_data();

    // COLOR: kill core defaults
    $theme['settings']['color']['gradients'] = [];
    $theme['settings']['color']['duotone']   = [];
    $theme['settings']['color']['palette']   = [];

    unset($theme['settings']['border']);
    unset($theme['settings']['shadow']);
    unset($theme['settings']['spacing']);
	
    $data->update_with($theme);

    return $data;
});

add_filter('block_editor_settings_all', function ($settings) {
    $settings['disableCustomGradients'] = true;
    return $settings;
});

/**
 * Enqueue theme assets.
 */
function apk_enqueue_scripts() {
	$theme = wp_get_theme();
	wp_enqueue_style( 'apk', apk_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'uncss-wpforms', apk_asset( 'src/css/uncss-wpforms.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'apk', apk_asset( 'src/js/app.js' ), array(), $theme->get( 'Version' ) );
	wp_script_add_data('apk', 'strategy', 'defer');
}
add_action( 'wp_enqueue_scripts', 'apk_enqueue_scripts' );




/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function apk_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
	
		return get_stylesheet_directory_uri() . '/' . $path;
	}
	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/*
-------------------------------------------------------------------------------------------------------
	Menus aanpassen 
-------------------------------------------------------------------------------------------------------
*/

/**
 * Clean WP menu + apk + minimal state classes
 */
function apk_nav_menu_add_li_class( $classes, $item, $args, $depth ) {

// 	Start volledig schoon
	$classes = [];

	// apk global class
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}
	// apk per depth class
	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}
	// Has submenu
	if ( in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
		$classes[] = 'has-submenu';
	}
	// Active item
	if ( in_array( 'current-menu-item', (array) $item->classes, true ) ) {
		$classes[] = 'is-active';
	}
	// Active parent / ancestor
	if (
		in_array( 'current-menu-ancestor', (array) $item->classes, true ) ||
		in_array( 'current-menu-parent', (array) $item->classes, true )
	) {
		$classes[] = 'is-parent-active';
	}
	return array_values( array_unique( $classes ) );
}

add_filter( 'nav_menu_css_class', 'apk_nav_menu_add_li_class', 10, 4 );

/**
 * Remove menu item ID completely
 */
add_filter( 'nav_menu_item_id', '__return_empty_string' );

//-----


add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {

	$classes = [];

	$is_active = in_array('current-menu-item', (array) $item->classes, true);

	$is_parent_active = (
		in_array('current-menu-parent', (array) $item->classes, true) ||
		in_array('current-menu-ancestor', (array) $item->classes, true)
	);

	/**
	 * NORMAL state (ONLY when NOT active)
	 */
	if (!$is_active && !$is_parent_active && !empty($args->a_class)) {
		$classes = array_merge(
			$classes,
			preg_split('/\s+/', trim($args->a_class))
		);
	}

	/**
	 * ACTIVE state (ONLY when active OR parent active)
	 */
	if (($is_active || $is_parent_active) && !empty($args->a_class_active)) {
		$classes = array_merge(
			$classes,
			preg_split('/\s+/', trim($args->a_class_active))
		);
	}

	$classes = array_values(array_unique(array_filter($classes)));

	if (!empty($classes)) {
		$atts['class'] = implode(' ', $classes);
	}

	return $atts;

}, 10, 4);


/**
 * Toevoegen classes op submenu
 */

function apk_nav_menu_add_submenu_class( $classes, $args, $depth ) {

	// Check of er überhaupt custom classes zijn ingesteld
	$has_custom =
		isset( $args->submenu_class ) ||
		isset( $args->{"submenu_class_$depth"} );

	// Alleen resetten als er iets custom is opgegeven
	if ( $has_custom ) {

		$new_classes = [];

		if ( isset( $args->submenu_class ) ) {
			$new_classes[] = $args->submenu_class;
		}

		if ( isset( $args->{"submenu_class_$depth"} ) ) {
			$new_classes[] = $args->{"submenu_class_$depth"};
		}

		return $new_classes;
	}

	// Anders: laat WordPress/Tailwind default classes intact
	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'apk_nav_menu_add_submenu_class', 10, 3 );


/*
-------------------------------------------------------------------------------------------------------
	Register Sidebars
-------------------------------------------------------------------------------------------------------
*/


if ( ! function_exists( 'apk_widgets_init' ) ) :

	/** Function block_lite_widgets_init */
	function apk_widgets_init() {
		register_sidebar(array(
			'name'          => esc_html__( 'Content aside', 'apk' ),
			'id'            => 'content-aside',
			'before_widget' => '<aside id="%1$s" class="organic-widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar(array(
			'name'          => esc_html__( 'Footer Widgets', 'apk' ),
			'id'            => 'footer',
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="footer-widget">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
	}
endif;
add_action( 'widgets_init', 'apk_widgets_init' );






