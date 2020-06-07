<?php 
/**
 * @Packge 	   : Colorlib
 * @Version    : 1.0
 * @Author 	   : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	/**
	 *
	 * Define constant
	 *
	 */
	
	 
	// Base URI
	if( !defined( 'BEKO_DIR_URI' ) )
		define( 'BEKO_DIR_URI', get_template_directory_uri().'/' );
	
	// assets URI
	if( !defined( 'BEKO_DIR_ASSETS_URI' ) )
		define( 'BEKO_DIR_ASSETS_URI', BEKO_DIR_URI.'assets/' );
	
	// Css File URI
	if( !defined( 'BEKO_DIR_CSS_URI' ) )
		define( 'BEKO_DIR_CSS_URI', BEKO_DIR_ASSETS_URI .'css/' );
	
	// Js File URI
	if( !defined( 'BEKO_DIR_JS_URI' ) )
		define( 'BEKO_DIR_JS_URI', BEKO_DIR_ASSETS_URI .'js/' );
	
	// Icon Images
	if( !defined('BEKO_DIR_ICON_IMG_URI') )
		define( 'BEKO_DIR_ICON_IMG_URI', BEKO_DIR_ASSETS_URI.'img/icon/' );
	
	// Animate Icon Images
	if( !defined('BEKO_DIR_ANIMATE_ICON_IMG_URI') )
		define( 'BEKO_DIR_ANIMATE_ICON_IMG_URI', BEKO_DIR_ASSETS_URI.'img/animate_icon/' );
	
	//DIR inc
	if( !defined( 'BEKO_DIR_INC' ) )
		define( 'BEKO_DIR_INC', BEKO_DIR_URI.'inc/' );

	//Elementor Widgets Folder Directory
	if( !defined( 'BEKO_DIR_ELEMENTOR' ) )
		define( 'BEKO_DIR_ELEMENTOR', BEKO_DIR_INC.'elementor-widgets/' );

	// Base Directory
	if( !defined( 'BEKO_DIR_PATH' ) )
		define( 'BEKO_DIR_PATH', get_parent_theme_file_path().'/' );
	
	//Inc Folder Directory
	if( !defined( 'BEKO_DIR_PATH_INC' ) )
		define( 'BEKO_DIR_PATH_INC', BEKO_DIR_PATH.'inc/' );
	
	//Colorlib framework Folder Directory
	if( !defined( 'BEKO_DIR_PATH_LIB' ) )
		define( 'BEKO_DIR_PATH_LIB', BEKO_DIR_PATH_INC.'libraries/' );
	
	//Classes Folder Directory
	if( !defined( 'BEKO_DIR_PATH_CLASSES' ) )
		define( 'BEKO_DIR_PATH_CLASSES', BEKO_DIR_PATH_INC.'classes/' );

	
	//Widgets Folder Directory
	if( !defined( 'BEKO_DIR_PATH_WIDGET' ) )
		define( 'BEKO_DIR_PATH_WIDGET', BEKO_DIR_PATH_INC.'widgets/' );
		
	//Elementor Widgets Folder Directory
	if( !defined( 'BEKO_DIR_PATH_ELEMENTOR_WIDGETS' ) )
		define( 'BEKO_DIR_PATH_ELEMENTOR_WIDGETS', BEKO_DIR_PATH_INC.'elementor-widgets/' );
	

		
	/**
	 * Include File
	 *
	 */
	
	// Breadcrumbs file include
	require_once( BEKO_DIR_PATH_INC . 'beko-breadcrumbs.php' );
	// Sidebar register file include
	require_once( BEKO_DIR_PATH_INC . 'widgets/beko-widgets-reg.php' );
	// Post widget file include
	require_once( BEKO_DIR_PATH_INC . 'widgets/beko-recent-post-thumb.php' );
	// News letter widget file include
	require_once( BEKO_DIR_PATH_INC . 'widgets/beko-newsletter-widget.php' );
	//Social Links
	require_once( BEKO_DIR_PATH_INC . 'widgets/beko-social-links.php' );
	// Instagram Widget
	require_once( BEKO_DIR_PATH_INC . 'widgets/beko-instagram.php' );
	// Nav walker file include
	require_once( BEKO_DIR_PATH_INC . 'wp_bootstrap_navwalker.php' );
	// Theme function file include
	require_once( BEKO_DIR_PATH_INC . 'beko-functions.php' );

	// Theme Demo file include
	require_once( BEKO_DIR_PATH_INC . 'demo/demo-import.php' );

	// Post Like
	require_once( BEKO_DIR_PATH_INC . 'post-like.php' );
	// Theme support function file include
	require_once( BEKO_DIR_PATH_INC . 'support-functions.php' );
	// Html helper file include
	require_once( BEKO_DIR_PATH_INC . 'wp-html-helper.php' );
	// Pagination file include
	require_once( BEKO_DIR_PATH_INC . 'wp_bootstrap_pagination.php' );
	// Elementor Widgets
	require_once( BEKO_DIR_PATH_ELEMENTOR_WIDGETS . 'elementor-widget.php' );
	//
	require_once( BEKO_DIR_PATH_CLASSES . 'Class-Enqueue.php' );
	
	require_once( BEKO_DIR_PATH_CLASSES . 'Class-Config.php' );
	// Customizer
	require_once( BEKO_DIR_PATH_INC . 'customizer/customizer.php' );
	// Class autoloader
	require_once( BEKO_DIR_PATH_INC . 'class-epsilon-dashboard-autoloader.php' );
	// Class beko dashboard
	require_once( BEKO_DIR_PATH_INC . 'class-epsilon-init-dashboard.php' );
	// Common css
	require_once( BEKO_DIR_PATH_INC . 'beko-commoncss.php' );


	if( class_exists( 'RW_Meta_Box' ) ){
		// Metabox Function
		require_once( BEKO_DIR_PATH_INC . 'beko-metabox.php' );
	}
	

	// Admin Enqueue Script
	function beko_admin_script(){
		wp_enqueue_style( 'beko-admin', get_template_directory_uri().'/assets/css/beko_admin.css', false, '1.0.0' );
		wp_enqueue_script( 'beko_admin', get_template_directory_uri().'/assets/js/beko_admin.js', false, '1.0.0' );
	}
	add_action( 'admin_enqueue_scripts', 'beko_admin_script' );

	 
	// WooCommerce style desable
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );


	/**
	 * Instantiate Beko object
	 *
	 * Inside this object:
	 * Enqueue scripts, Google font, Theme support features, Beko Dashboard .
	 *
	 */
	
	$Beko = new Beko();
	
