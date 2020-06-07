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
 * Beko elementor section widget.
 *
 * @since 1.0
 */
class Beko_Partners extends Widget_Base {

	public function get_name() {
		return 'beko-partners';
	}

	public function get_title() {
		return __( 'Partners', 'beko' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'beko-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Partners content ------------------------------
		$this->start_controls_section(
			'partners_content',
			[
				'label' => __( 'Our Partners', 'beko' ),
			]
		);

		$this->add_control(
            'partner_slider', [
                'label' => __( 'Create New', 'beko' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ client_name }}}',
                'fields' => [
                    [
                        'name'  => 'client_logo',
                        'label' => __( 'Client Logo', 'beko' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'client_name',
                        'label' => __( 'Client Name', 'beko' ),
                        'type'  => Controls_Manager::TEXT,
                        'default'   => __('Creative', 'beko')
                    ],
                ],
            ]
		);

		$this->end_controls_section(); // End exibition content

	}

	protected function render() {

    $settings = $this->get_settings();

    // call load widget script
    $this->load_widget_script();
    $partners       = !empty( $settings['partner_slider'] ) ? $settings['partner_slider'] : '';
    ?>

    <!--::client logo part end::-->
    <section class="client_logo">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="client_logo_slider owl-carousel d-flex justify-content-between">
                            <?php
                            if( is_array( $partners ) && count( $partners ) > 0 ){
                                foreach ($partners as $partner ) {
                                    $image = !empty( $partner['client_logo']['id'] ) ? wp_get_attachment_image( $partner['client_logo']['id'], 'beko_client_img_150x77', '', array('alt' => $partner['client_name'] ) ) : '';
                                    ?>
                                    <div class="single_client_logo">
                                        <?php
                                            if( $image ){
                                                echo wp_kses_post( $image );
                                            }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--::client logo part end::-->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $(document).ready(function() {
                var client_logo = $('.client_logo_slider')
                if(client_logo.length){
                    client_logo.owlCarousel({
                        items: 6,
                        loop: true,
                        responsive: {
                        0: {
                            items: 3,
                            margin: 15,
                        },
                        600: {
                            items: 3,
                            margin: 15,
                        },
                        991: {
                            items: 5,
                            margin: 15,
                        },
                        1200: {
                            items: 6,
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
