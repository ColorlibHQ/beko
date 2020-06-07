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
 * Beko elementor upcomming war section widget.
 *
 * @since 1.0
 */
class Beko_Upcomming_War extends Widget_Base {

	public function get_name() {
		return 'beko-upcomming-war';
	}

	public function get_title() {
		return __( 'Upcomming War', 'beko' );
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
				'type'          => Controls_Manager::TEXT,
				'label_block'   => true,
				'default'       => __( 'Upcoming Fighter', 'beko' )
			]
        );
        $this->add_control(
			'upc_war_title',
			[
				'label'         => esc_html__( 'Upcomming War Title', 'beko' ),
				'type'          => Controls_Manager::TEXT,
				'label_block'   => true,
				'default'       => __( 'Dark Dragon', 'beko' )
			]
        );
        $this->add_control(
			'upc_war_date',
			[
				'label'         => esc_html__( 'Upcomming War Date', 'beko' ),
				'type'  => Controls_Manager::DATE_TIME,
                'label_block' => true,
                'default' => __( '24 sep 2020 9:56:00', 'beko' )
			]
        );
		$this->end_controls_section();  

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
				'label'     => __( 'Section Title Color', 'beko' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upcomming_war .section_tittle h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'counter_title_col', [
				'label'     => __( 'Counter Title Color', 'beko' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upcomming_war .upcomming_war_iner h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'counter_col', [
				'label'     => __( 'Counter Color', 'beko' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upcomming_war #days' => 'color: {{VALUE}};',
					'{{WRAPPER}} .upcomming_war #hours' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'counter_label_col', [
				'label'     => __( 'Counter Label Color', 'beko' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upcomming_war #days span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .upcomming_war #hours span' => 'color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();


        /*------------------------------ Background Style ------------------------------*/
		$this->start_controls_section(
            'section_bg', [
                'label' => __( 'Style Background', 'beko' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_txt_shd_sep',
            [
                'label'     => __( 'Background Shade Text', 'beko' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_txt_shd',
                'label' => __( 'Section Background', 'beko' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .upcomming_war',
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {

    $settings = $this->get_settings();

    // call load widget script
    $this->load_widget_script();
    
	$sec_title      = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
	$war_title      = !empty( $settings['upc_war_title'] ) ? $settings['upc_war_title'] : '';
	$war_date       = !empty( $settings['upc_war_date'] ) ? $settings['upc_war_date'] : '';
    ?>

    <!-- use sasu part end-->
    <section class="upcomming_war">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section_tittle text-center">
                            <h2><?php echo esc_html($sec_title)?></h2>
                        </div>
                    </div>
                </div>
                <div class="upcomming_war_iner">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-10 col-sm-5 col-lg-3">
                            <div class="upcomming_war_counter text-center" data-war-date="<?php echo esc_html($war_date)?>">
                                <h2><?php echo esc_html($war_title)?></h2>
                                <div id="timer" class="d-flex justify-content-between">
                                    <div id="days"></div>
                                    <div id="hours"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- use sasu part end-->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            function makeTimer() {
                var warDate = $('.upcomming_war_counter').data('war-date');	
                var endTime = new Date( warDate );
                endTime = (Date.parse(endTime) / 1000);

                var now = new Date();
                now = (Date.parse(now) / 1000);

                var timeLeft = endTime - now;

                var days = Math.floor(timeLeft / 86400);
                var hours = Math.floor((timeLeft - (days * 86400)) / 3600);

                if (hours < "10") {
                hours = "0" + hours;
                }

                $("#days").html(days + "<span>Days</span>");
                $("#hours").html(hours + "<span>Hours</span>");

                setInterval(function () {
                    makeTimer();
                }, 1000);
            }

        })(jQuery);
        </script>
        <?php 
        }
    }
	
}
