<?php 
/**
 * @Packge 	   : Beko
 * @Version    : 1.0
 * @Author 	   : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	// Final Class
	final class Beko{

		
		// Theme Version
		private $beko_version = '1.0';

		// Minimum WordPress Version required
		private $min_wp = '4.0';

		// Minimum PHP version required 
		private $min_php = '5.6.25';

		function __construct(){
			// Theme Support
			add_action( 'after_setup_theme', array( $this, 'support' ) );
			// 
			$this->init();
		}

		// Theme init
		public function init(){
			//
			$this->setup();

			// customizer init Instantiate
			$this->customizer_init();
			
		}

		// Theme setup
		private function setup(){
			
			// Create enqueue class instance
			$enqueu = new beko_Enqueue();
			$enqueu->scripts = $this->enqueue() ;
			$enqueu->beko_scripts_enqueue_init() ;

		}
		// Theme Support
		public function support(){
			// content width
	        $GLOBALS['content_width'] = apply_filters( 'beko_content_width', 751 );

	        
	        // text domain for translation.
	        load_theme_textdomain( 'beko', BEKO_DIR_PATH . '/languages' );
	        
	        // support title tage
	        add_theme_support( 'title-tag' );
	        
	        // support logo
			add_theme_support( 'custom-logo', array(
				'height'      => 38,
				'width'       => 154,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			) );

			//Custom Hreader
			add_theme_support( 'custom-header', array(
				'flex-width'    => true,
				'width'         => 1920,
				'flex-height'   => true,
				'height'        => 625,
				'default-image' => get_template_directory_uri() . '/assets/img/banner.jpg'
			) );

			//Custom background
			add_theme_support( 'custom-background', array(
				'default-color' => 'ffffff'
			) );

	        //  support post format
	        add_theme_support( 'post-formats', array( 'video','audio' ) );
	        
	        // support post-thumbnails
			add_theme_support( 'post-thumbnails', array( 'post' ) );
			
			// Removing default image sizes
			remove_image_size('large');
			remove_image_size('medium');
			remove_image_size('thumbnail');
			
			// Site logo size
			add_image_size( 'beko_logo_154x38', 154, 38, true );
			
			// Partners img size
			add_image_size( 'beko_partners_img_150x77', 150, 77, true );
					
			// About image size
			add_image_size( 'beko_about_img_802x767', 802, 767, true );
					
			// Live stream image size
			add_image_size( 'beko_live_stream_img_671x561', 671, 561, true );
					
			// War top logo image size
			add_image_size( 'beko_war_top_logo_70x38', 70, 38, true );
					
			// War logo image size
			add_image_size( 'beko_war_logo_img_122x99', 122, 99, true );
					
			// Latest war image size
			add_image_size( 'beko_latest_war_img_570x585', 570, 585, true );
										
			// Gallery image sizes
			add_image_size( 'beko_gallery_img_435x423', 435, 423, true );
			add_image_size( 'beko_gallery_img_445x512', 445, 512, true );
			add_image_size( 'beko_gallery_img_555x512', 555, 512, true );
			add_image_size( 'beko_gallery_img_455x580', 455, 580, true );
			add_image_size( 'beko_gallery_img_435x559', 435, 559, true );
			add_image_size( 'beko_gallery_img_1010x470', 1010, 470, true );
			add_image_size( 'beko_gallery_img_455x402', 455, 402, true );
					
			// Single pricing bg image size
			add_image_size( 'beko_single_pricing_bg_img_363x181', 363, 181, true );

			// Single blog post image size
			add_image_size( 'beko_single_blog_750x375', 750, 375, true );
			add_image_size( 'beko_np_thumb', 60, 60, true );

			// Latest post thumbnail Widget thumbnail size
			add_image_size( 'beko_widget_post_thumb', 80, 80, true );
	        	        
	        // support automatic feed links
	        add_theme_support( 'automatic-feed-links' );
	        
	        // support html5
	        add_theme_support( 'html5' );
			
			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );
						    
	        // register nav menu
	        register_nav_menus( array(
	            'primary-menu'    => esc_html__( 'Primary Menu', 'beko' ),
				'important-links' => esc_html__( 'Important Links', 'beko' ),
	        ) );

	        // editor style
	        add_editor_style('assets/css/editor-style.css');

		} // end support method

		// enqueue theme style and script
		private function enqueue(){

			$cssPath = BEKO_DIR_CSS_URI;
			$jsPath  = BEKO_DIR_JS_URI;

			$scripts = array(
				'style' => array(
					array(
						'handler'		=> 'beko-google-font',
						'file' 			=> $this->google_font(),
					),
					array(
						'handler'		=> 'beko-bootstrap',
						'file' 			=> $cssPath.'bootstrap.min.css',
						'dependency' 	=> array(),
						'version' 		=> '5.3.8-5',
					),
					array(
						'handler'		=> 'beko-animate',
						'file' 			=> $cssPath.'animate.css',
						'dependency' 	=> array(),
						'version' 		=> '1.0',
					),
					array(
						'handler'		=> 'beko-owl-carousel',
						'file' 			=> $cssPath.'owl.carousel.min.css',
						'dependency' 	=> array(),
						'version' 		=> '1.0',
					),
					array(
						'handler'		=> 'beko-font-awesome',
						'file' 			=> $cssPath.'font-awesome.min.css',
						'dependency' 	=> array(),
						'version' 		=> '7.3.1-1',
					),
					array(
						'handler'		=> 'beko-themify',
						'file' 			=> $cssPath.'themify-icons.css',
						'dependency' 	=> array(),
						'version' 		=> '1.0',
					),
					array(
						'handler'		=> 'beko-flaticon',
						'file' 			=> $cssPath.'flaticon.css',
						'dependency' 	=> array(),
						'version' 		=> '1.0',
					),
					array(
						'handler'		=> 'beko-magnific-popup-css',
						'file' 			=> $cssPath.'magnific-popup.css',
						'dependency' 	=> array(),
						'version' 		=> '1.0',
					),
					array(
						'handler'		=> 'beko-slick-css',
						'file' 			=> $cssPath.'slick.css',
						'dependency' 	=> array(),
						'version' 		=> '1.0',
					),
					array(
						'handler'		=> 'beko-default-css',
						'file' 			=> $cssPath.'default.css',
						'dependency' 	=> array(),
						'version' 		=> '1.0',
					),
					array(
						'handler'		=> 'beko-style-css',
						'file' 			=> $cssPath.'style.css',
						'dependency' 	=> array(),
						'version' 		=> '1.0',
					),
					
					array(
						'handler'		=> 'beko-style',
						'file' 			=> get_stylesheet_uri(),
					),
				),
				
				'scripts' => array(
					array(
						'handler'		=> 'beko-bootstrap',
						'file' 			=> $jsPath.'bootstrap.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '5.3.8-4',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-magnific-popup-js',
						'file' 			=> $jsPath.'jquery.magnific-popup.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-swiper-min-js',
						'file' 			=> $jsPath.'swiper.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-instagram-feed-js',
						'file' 			=> $jsPath.'jquery.instagramFeed.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-owl-carousel-js',
						'file' 			=> $jsPath.'owl.carousel.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-jquery-nice-select-js',
						'file' 			=> $jsPath.'jquery.nice-select.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-jquery-counterup-js',
						'file' 			=> $jsPath.'jquery.counterup.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-waypoints-min-js',
						'file' 			=> $jsPath.'waypoints.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-jquery-ajaxchimp-js',
						'file' 			=> $jsPath.'jquery.ajaxchimp.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'beko-slick-min-js',
						'file' 			=> $jsPath.'slick.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					
					array(
						'handler'		=> 'beko-custom',
						'file' 			=> $jsPath.'custom.js',
						'dependency' 	=> array( 'jquery', 'masonry' ),
						'version' 		=> $this->beko_version,
						'in_footer' 	=> true
					),

				)
			);

			return $scripts;

		} // end enqueu method 

		// Google Font  
		private function google_font(){
			$font_url = '';

			/*
			 * The families this theme uses are bundled under
			 * assets/fonts/google, so nothing is fetched from Google and
			 * no request leaves the visitor's browser for a third party.
			 *
			 * Translators can still turn the fonts off for scripts these
			 * families do not cover.
			 */
			if ( 'off' !== _x( 'on', 'Google font: on or off', 'beko' ) ) {
				$font_url = get_template_directory_uri() . '/assets/css/google-fonts.css';
			}

			return esc_url_raw( $font_url );
		} //End google_font method

		private function customizer_init(){

		
			

			
			// Instantiate beko theme customizer
			$beko_theme_customizer = new beko_theme_customizer();
		}
	} // End Beko Class

?>