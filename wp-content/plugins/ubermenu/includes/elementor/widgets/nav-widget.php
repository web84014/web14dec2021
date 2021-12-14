<?php

class Elementor_UberMenu_Nav_Widget extends \Elementor\Widget_Base {

	public function get_name() {
    return 'ubermenu';
  }

	public function get_title() {
    return 'UberMenu Mega Menu';
  }

	public function get_icon() {
    return 'eicon-archive-posts';
  }

	public function get_categories() {
    return [ 'general' ];
  }

	protected function _register_controls() {
    $this->start_controls_section(
			'menu_section',
			[
				'label' => __( 'Menu', 'ubermenu' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $this->add_control(
			'assign',
			[
				'label' => __( 'Assign', 'ubermenu' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'menu' => __( 'Menu', 'ubermenu' ),
					'theme_location' => __( 'Theme Location', 'ubermenu' ),
				],
				'default' => 'menu',
			]
		);

    //$menu_ops = ubermenu_get_nav_menu_ops();
		$menus = wp_get_nav_menus( array('orderby' => 'name') );
		$menu_ops = array( 0 => '-- Select Menu --' );
		foreach( $menus as $menu ){
			$menu_ops[$menu->term_id] = $menu->name;
		}
		//uberp( $menu_ops );

    $this->add_control(
			'menu',
			[
				'label' => __( 'Menu', 'ubermenu' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $menu_ops,
        'default' => 0,
        //'default' => array_key_first( $menu_ops ),
        'condition' => [
          'assign' => 'menu'
        ],
        // 'condition' => [
    		// 	'terms' => [
    		// 		[
    		// 			'name' => 'assign',
    		// 			'operator' => '==',
    		// 			'value' => [
    		// 				'menu',
    		// 			],
    		// 		],
    		// 	],
    		// ],
			]
		);

    $theme_location_ops = get_registered_nav_menus(); //ubermenu_get_theme_location_ops();

    $this->add_control(
			'theme_location',
			[
				'label' => __( 'Theme Location', 'ubermenu' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $theme_location_ops,
        //'default' => array_key_first( $theme_location_ops ),
        'condition' => [
          'assign' => 'theme_location',
        ],
        // 'conditions' => [
    		// 	'terms' => [
    		// 		[
    		// 			'name' => 'assign',
    		// 			'operator' => '==',
    		// 			'value' => [
    		// 				'theme_location',
    		// 			],
    		// 		],
    		// 	],
    		// ],
			]
		);

    $configs = ubermenu_get_menu_instances(true);
    $config_ops = [];
    foreach( $configs as $config_id ){
      $config_ops[$config_id] = $config_id;
    }

		$this->add_control(
			'config',
			[
				'label' => __( 'Configuration', 'ubermenu' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $config_ops,
        'default' => 'main',
			]
		);

		$this->end_controls_section();
  }

	protected function render() {
    $settings = $this->get_settings_for_display();

		//echo '<div class="ubermenu-elementor-widget">';

    $config = $settings['config'];
    $menu = $settings['menu'];
    $theme_location = $settings['theme_location'];

    //uberp( $settings );

	  //echo "UberMenu $config Configuration $theme_location Theme Loc $menu Menu";

    switch( $settings['assign'] ){
      case 'menu':

        if( !$settings['menu'] ){
          ubermenu_admin_notice( 'Please select a <strong>Menu</strong> in the Elementor settings' );
          return;
        }

        ubermenu( $config , [ 'menu' => $settings['menu'] ] );
        break;

      case 'theme_location':

        if( !$settings['theme_location'] ){
          ubermenu_admin_notice( 'Please select a <strong>Theme Location</strong> in the Elementor settings' );
          return;
        }

        ubermenu( $config , ['theme_location' => $settings['theme_location'] ] );
        break;
    }

		//echo '</div>';
  }

	protected function _content_template() {}

}
