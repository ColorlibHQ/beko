<?php
namespace Bekoelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Beko elementor gallery section widget.
 *
 * @since 1.0
 */
class Beko_Gallery extends Widget_Base {

	public function get_name() {
		return 'beko-gallery';
	}

	public function get_title() {
		return __( 'Gallery', 'beko' );
	}

	public function get_icon() {
		return 'eicon-gallery-justified';
	}

	public function get_categories() {
		return [ 'beko-elements' ];
	}

	protected function _register_controls() {

        // Gallery Heading
		$this->start_controls_section(
			'section_heading',
			[
				'label' => __( 'Section Heading', 'beko' ),
			]
		);
        $this->add_control(
			'sec_title',
			[
				'label'         => esc_html__( 'Section Title', 'beko' ),
				'description'   => __( "Use < span> tag for color and italic word", "beko" ),
				'type'          => Controls_Manager::WYSIWYG,
				'label_block'   => true,
				'default'       => __( '<h2>All Fighter</h2>', 'beko' )
			]
        );
		$this->end_controls_section();  


		// ----------------------------------------  Gallery content ------------------------------
		$this->start_controls_section(
			'gallery_content',
			[
				'label' => __( 'Our Gallery', 'beko' ),
			]
		);

		$this->add_control(
            'gallery_items', [
                'label' => __( 'Create New', 'beko' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ image_size }}}',
                'fields' => [
                    [
                        'name'      => 'image',
                        'label'     => __( 'Gallery Image', 'beko' ),
                        'type'      => Controls_Manager::MEDIA,
                        'default'   => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name'  => 'image_size',
                        'label' => __( 'Image Size', 'beko' ),
                        'type'  => Controls_Manager::SELECT,
                        'default'   => '435x423',
                        'options'   => [
                            '435x423'      => '435x423',
                            '445x512'      => '445x512',
                            '555x512'      => '555x512',
                            '455x580'      => '455x580',
                            '435x559'      => '435x559',
                            '1010x470'     => '1010x470',
                            '455x402'      => '455x402',
                        ]
                    ],
                ],
                'default' => [
                    [
                        'image' => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ],
                        'image_size'      => '435x423'
                    ],
                    [
                        'image' => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ],
                        'image_size'      => '435x423'
                    ],
                ]
            ]
		);

		$this->end_controls_section(); // End exibition content

        /**
         * Style Tab
         *
         */
		//------------------------------ Style Section ------------------------------
		$this->start_controls_section(
			'style_section', [
				'label' => __( 'Style Section Heading', 'beko' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'color_ttitle', [
				'label'     => __( 'Title Color', 'beko' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery_part .section_tittle h2' => 'color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();

	}

	protected function render() {

    $settings = $this->get_settings();
    
    // Image size function
    function beko_img_thumb_class( $img_size ){
        switch ( $img_size ) {
            case '435x423':
                $img_classes = ' grid-item--height-1';
                break;

            case '445x512':
                $img_classes = '';
                break;

            case '555x512':
                $img_classes = '';
                break;

            case '455x580':
                $img_classes = ' grid-item--height-2';
                break;

            case '435x559':
                $img_classes = ' grid-item--height-2';
                break;

            case '1010x470':
                $img_classes = ' grid-item--width-1';
                break;

            case '455x402':
                $img_classes = ' sm_weight grid-item--height-1';
                break;
            
            default:
                $img_classes = '';
                break;
        }
        
        return $img_classes;
    }

    // call load widget script
    $this->load_widget_script();
    
	$title          = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $galleries       = !empty( $settings['gallery_items'] ) ? $settings['gallery_items'] : '';
    ?>

    <!-- gallery_part part start-->
    <section class="gallery_part section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5">
                        <div class="section_tittle text-center">
                            <?php
                                //Title text ==============
                                if( $title ){
                                    echo wp_kses_post( wpautop( $title ) );
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="gallery_part_item">
                            <div class="grid">
                                <div class="grid-sizer"></div>
                                <?php
                                if( is_array( $galleries ) && count( $galleries ) > 0 ){
                                    foreach ($galleries as $gallery ) {
                                        $img_size = !empty( $gallery['image_size'] ) ? $gallery['image_size'] : '';
                                        $image = !empty( $gallery['image']['id'] ) ? wp_get_attachment_image_src( $gallery['image']['id'], $img_size, '', array('alt' => 'gallery image' ) ) : '';
                                        $designation = !empty( $gallery['designation'] ) ? $gallery['designation'] : '';
                                        $location = !empty( $gallery['location'] ) ? $gallery['location'] : '';
                                        ?>
                                        <a href="<?php echo esc_url( $image[0] )?>" class="grid-item bg_img img-gal<?php echo beko_img_thumb_class( $img_size )?>"
                                            style="background-image: url(<?php echo esc_url( $image[0] )?>)">
                                            <div class="single_gallery_item">
                                                <div class="single_gallery_item_iner">
                                                    <div class="gallery_item_text">
                                                        <i class="ti-zoom-in"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }
                                }
                                ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- gallery_part part end-->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $('.grid').masonry({
                itemSelector: '.grid-item',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });
        })(jQuery);
        </script>
        <?php 
        }
    }
	
}
