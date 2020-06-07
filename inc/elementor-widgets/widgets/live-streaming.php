<?php
namespace Bekoelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Beko elementor Who Can Live Streaming section widget.
 *
 * @since 1.0
 */
class Beko_Live_Streaming extends Widget_Base {

	public function get_name() {
		return 'beko-live-streaming';
	}

	public function get_title() {
		return __( 'Live Streaming', 'beko' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'beko-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

        // ----------------------------------------  Live Streaming Section ------------------------------
        $this->start_controls_section(
            'live_stream_heading',
            [
                'label' => __( 'Live Streaming Heading', 'beko' ),
            ]
        );
        $this->add_control(
            'live_stream_header',
            [
                'label'         => esc_html__( 'Live Streaming Header', 'beko' ),
                'description'   => esc_html__('Use <br> tag for line break', 'beko'),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => __( '<h2>live <br> stareams</h2>', 'beko' )
            ]
        );
        $this->add_control(
            'about_btnlabel',
            [
                'label'         => esc_html__( 'Button Label', 'beko' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'Install Now', 'beko' )
            ]
        );
        $this->add_control(
            'about_btnurl',
            [
                'label'         => esc_html__( 'Button Url', 'beko' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false
            ]
        );

        $this->add_control(
            'slide_cont_sep',
            [
                'label'         => esc_html__( 'Slide Contents Separator', 'beko' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'after'
            ]
        );

        $this->add_control(
            'slide_contents', [
                'label' => __( 'Create New', 'beko' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name'      => 'live_stream_img',
                        'label'     => __( 'Live Streaming Image', 'beko' ),
                        'type'      => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'title',
                        'label' => __( 'Image Title', 'beko' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'Image 1', 'beko' )
                    ],
                    [
                        'name'      => 'vid_url',
                        'label'     => __( 'Popup Video URL', 'beko' ),
                        'type'      => Controls_Manager::URL,
                        'default'   => [
                            'url'   => 'https://www.youtube.com/watch?v=pBFQdxA-apI'
                        ]
                    ],
                ],
            ]
        );

        $this->end_controls_section(); // End section top content
        
		

        /**
         * Style Tab
         * ------------------------------ Style Tab Content ------------------------------
         *
         */

        // Heading Style ==============================
        $this->start_controls_section(
            'color_sect', [
                'label' => __( 'Style Heading', 'beko' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_sec_ttitle', [
                'label'     => __( 'Big Title Color', 'beko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .live_stareams .live_stareams_text h2' => 'color: {{VALUE}};',
                ],
            ]
        );    
        $this->add_control(
            'play_btn_col', [
                'label'     => __( 'Play Button Color', 'beko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .live_stareams .live_stareams_slide .live_stareams_slide_img .video-play-button span' => 'color: {{VALUE}};',
                ],
            ]
        );    

        $this->add_control(
            'btn_txt_col', [
                'label'     => __( 'Button Text Color', 'beko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .live_stareams .live_stareams_text .btn_1' => 'color: {{VALUE}};',
                ],
            ]
        );    

        $this->add_control(
            'btn_txt_bg_col', [
                'label'     => __( 'Button BG Color', 'beko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .live_stareams .live_stareams_text .btn_1' => 'background: {{VALUE}};',
                ],
            ]
        );    

        $this->add_control(
            'btn_hvr_separator',
            [
                'label'     => __( 'Hover Styles', 'beko' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 

        $this->add_control(
            'btn_txt_hov_col', [
                'label'     => __( 'Button Hover Text Color', 'beko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .live_stareams .live_stareams_text .btn_1:hover' => 'color: {{VALUE}}!important;',
                ],
            ]
        );    

        $this->add_control(
            'btn_txt_hov_bg_col', [
                'label'     => __( 'Button Hover BG Color', 'beko' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .live_stareams .live_stareams_text .btn_1:hover' => 'background: {{VALUE}};',
                ],
            ]
        );    
        
        $this->end_controls_section();


        // Background Style ==============================
        $this->start_controls_section(
            'section_bg', [
                'label' => __( 'Style Background', 'beko' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg',
                'label' => __( 'Background', 'beko' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .live_stareams',
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

    $settings = $this->get_settings();
    
    // call load widget script
    $this->load_widget_script();

    $live_stream_header = !empty( $settings['live_stream_header'] ) ? $settings['live_stream_header'] : '';
    $btnlabel = !empty( $settings['about_btnlabel'] ) ? $settings['about_btnlabel'] : '';
    $btnurl = !empty( $settings['about_btnurl']['url'] ) ? $settings['about_btnurl']['url'] : '';
    $slide_contents = !empty( $settings['slide_contents'] ) ? $settings['slide_contents'] : '';
    $dynamic_class = is_front_page() ? 'live_stream' : 'live_stream padding_top';

    function single_stream_item( $live_stream_img, $counter, $video_url ){ ?>
        <div class="live_stareams_slide_img">
            <?php
                if( $live_stream_img ){
                    echo wp_kses_post( $live_stream_img );
                }

                echo '<div class="extends_video">';
                    echo '<a id="play-video_'.esc_attr( $counter ).'" class="video-play-button popup-youtube"
                    href="'.esc_url( $video_url ).'">
                        <span class="fa fa-play"></span>
                    </a>';
                echo '</div>';
            ?>
        </div>
    <?php
    }
    ?>

    <!--::about_us part start::-->
    <section class="live_stareams padding_bottom">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-2 offset-lg-2 offset-sm-1">
                        <div class="live_stareams_text">
                            <?php
                                if( $live_stream_header ){
                                    echo wp_kses_post( $live_stream_header );
                                }

                                echo '<a href="'.esc_url( $btnurl ).'" class="btn_1">'.esc_html( $btnlabel ).'</a>';
                            ?>
                        </div>
                    </div>
                    <div class="col-md-7 offset-sm-1">
                        <div class="live_stareams_slide owl-carousel">
                            <?php
                            if( is_array( $slide_contents ) && count( $slide_contents ) > 0 ){
                                $counter = 0;
                                foreach ( $slide_contents as $item ) {
                                    $title = !empty( $item['title'] ) ? $item['title'] : 'stream image';
                                    $live_stream_img = !empty( $item['live_stream_img']['id'] ) ? wp_get_attachment_image($item['live_stream_img']['id'], 'beko_live_stream_img_671x561', false, ['alt' => $title]) : '';
                                    $video_url = !empty( $item['vid_url']['url'] ) ? $item['vid_url']['url'] : '';
                                    $counter++;
                                    
                                    single_stream_item( $live_stream_img, $counter, $video_url );
                                }
                            }
                            ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--::about_us part end::-->
    <?php
    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $(document).ready(function() {
                var review = $('.live_stareams_slide');
                if (review.length) {
                    review.owlCarousel({
                    items: 2,
                    loop: true,
                    dots: false,
                    autoplay: true,
                    autoplayHoverPause: true,
                    autoplayTimeout: 5000,
                    nav: true,
                    navText: [
                        '<i class="fa fa-caret-left"></i>',
                        '<i class="fa fa-caret-right"></i>'
                    ],
                    margin: 15,
                    responsive: {
                        0: {
                        items: 1,
                        margin: 15,
                        },
                        600: {
                        items: 1,
                        margin: 15,
                        },
                        991: {
                        items: 1,
                        margin: 15,
                        },
                        1200: {
                        items: 2,
                        margin: 15,
                        }
                    }
                    });
                }

            });
        })(jQuery);
        </script>
        <?php 
        }
    }
}
