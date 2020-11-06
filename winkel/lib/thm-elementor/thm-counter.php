<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themeum_Widget_Counter extends Widget_Base {
    public function get_name() {
        return 'thm-counter';
    }

    public function get_title() {
        return __( 'Themeum Counter', 'winkel' );
    }

    public function get_icon(){
        return 'eicon-counter-circle';
    }

    public function get_categories() {
        return [ 'themeum-elementor' ];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title Element', 'winkel' )
            ]
        );
        $this->add_control(
            'counter_digit',
            [
                'label'         => __( 'Digit Number', 'winkel' ),
                'type'          => Controls_Manager::NUMBER,
                'label_block'   => true,
                'default'       => __( '60', 'winkel' ),
            ]
        );
        $this->add_control(
            'currency_symbol',
            [
                'label'         => __( 'Prefix Text', 'winkel' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( '$', 'winkel' ),
            ]
        );
        $this->add_control(
            'counter_symbol',
            [
                'label'         => __( 'Postfix Text', 'winkel' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( '%', 'winkel' ),
            ]
        );
        $this->add_control(
            'counter_text',
            [
                'label'         => __( 'Counter Text', 'winkel' ),
                'type'          => Controls_Manager::TEXTAREA,
                'label_block'   => true,
                'default'       => __( '', 'winkel' ),
            ]
        );
        $this->end_controls_section();

        # Styling
        $this->start_controls_section(
            'section_style',
            [
                'label'     => __( 'Section Style', 'winkel' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'section_padding',
            [
                'label' => __( 'Section Padding', 'winkel' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thm-counter-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __( 'Image Border', 'winkel' ),
                'selector' => '{{WRAPPER}} .thm-counter-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'section_background',
                'selector' => '{{WRAPPER}} .thm-counter-content',
            ]
        );
        $this->add_control(
            'section_border_radius',
            [
                'label' => __( 'Border Radius', 'winkel' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thm-counter-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'section_box_shadow',
                'selector' => '{{WRAPPER}} .thm-counter-content',
            ]
        );
        $this->end_controls_section();


        # Styling
        $this->start_controls_section(
            'section_title_style',
            [
                'label'     => __( 'Title Style', 'winkel' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'text_align',
            [
                'label'     => __( 'Alignment', 'winkel' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'      => [
                        'title' => __( 'Left', 'winkel' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'winkel' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'winkel' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'   => [
                        'title' => __( 'Justified', 'winkel' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .thm-counter-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'text_padding',
            [
                'label' => __( 'Counter Padding', 'winkel' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thm-counter-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'text_margin',
            [
                'label' => __( 'Counter Margin', 'winkel' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thm-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'         => __( 'Text Color', 'winkel' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .thm-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .thm-counter-title',
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'section_text_style',
            [
                'label'     => __( 'Text Style', 'winkel' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'text_text_align',
            [
                'label'     => __( 'Alignment', 'winkel' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'      => [
                        'title' => __( 'Left', 'winkel' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'winkel' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'winkel' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'   => [
                        'title' => __( 'Justified', 'winkel' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .thm-counter-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'text_text_padding',
            [
                'label' => __( 'Counter Padding', 'winkel' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thm-counter-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'text_text_margin',
            [
                'label' => __( 'Counter Margin', 'winkel' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thm-counter-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'text_title_color',
            [
                'label'         => __( 'Text Color', 'winkel' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .thm-counter-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'typography2',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .thm-counter-text',
            ]
        );

    }

    protected function render(){
        $settings           = $this->get_settings();
        $counter_digit      = $settings['counter_digit'];
        $currency_symbol    = $settings['currency_symbol'];
        $counter_symbol     = $settings['counter_symbol'];
        $counter_text       = $settings['counter_text'];
         ?>
        <div class="thm-counter-content">
            <?php if( $counter_digit ) { ?>
                <div class="thm-counter-title">
                    <?php echo $currency_symbol; ?><span class="counter"><?php echo $counter_digit; ?></span><?php echo $counter_symbol; ?>
                </div>
            <?php } ?>
            <?php if( $counter_text ) { ?>
                <div class="thm-counter-text">
                    <?php echo $counter_text; ?>
                </div>
            <?php } ?>
            
        </div>
<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themeum_Widget_Counter() );

