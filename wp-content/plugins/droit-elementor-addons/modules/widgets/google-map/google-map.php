<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Google_Map extends \Elementor\Widget_Base {

    public function get_name() {
        return 'droit-google-map';
    }

    public function get_title() {
        return esc_html__( 'Google Map', 'droit-addons' );
    }

    public function get_icon() {
        return 'eicon-google-maps addons-icon';
    }

    public function get_keywords() {
        return [
            'dl',
            'droitlab',
            'google',
            'google map',
            'google map api'
        ];
    }

    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls() {

        // add content 
        $this-> dl_register_content_controls();
        
        //style section
        $this-> dl_register_styles_controls();
    }

    public function dl_register_content_controls() {

        $this->start_controls_section(
            'dl_google_map_contents_section',
            array(
                'label' => esc_html__( 'Contents', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
			'dl_choose_google_map_modes',
			[
				'label'   => __( 'Map Modes', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'view',
				'options' => [
					'place'      => __( 'Place', 'droit-addons' ),
					'view'       => __( 'View', 'droit-addons' ),
					'directions' => __( 'Directions', 'droit-addons' ),
					'streetview' => __( 'StreetView', 'droit-addons' ),
					'search'     => __( 'Search', 'droit-addons' ),
				],
			]
		);

        $this->add_control(
			'dl_map_marker_location',
			[
				'label'       => __( 'Map Location', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'City Hall, New York, NY', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => ['place']
                ]
			]
		);

        $this->add_control(
			'dl_map_marker_waypoints',
			[
				'label'       => __( 'Waypoints', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Germany|Paris', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => ['directions']
                ]
			]
		);

        $this->add_control(
			'dl_map_marker_avoid',
			[
				'label'       => __( 'Avoid', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'tolls|highways', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => ['directions']
                ]
			]
		);

        $this->add_control(
			'dl_choose_google_units',
			[
				'label'   => __( 'Units', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'metric',
				'options' => [
					'metric'       => __( 'Metric', 'droit-addons' ),
					'imperial'     => __( 'Imperial', 'droit-addons' ),
				],
                'condition'   => [
                    'dl_choose_google_map_modes' => 'directions'
                ]
			]
		);

        $this->add_control(
			'dl_map_streetview_heading',
			[
				'label'       => __( 'Heading', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => __('Indicates the compass heading of the camera in degrees clockwise from North', 'droit-addons'),
				'placeholder' => __( '-180 to 360', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => ['streetview']
                ]
			]
		);

        $this->add_control(
			'dl_map_streetview_pitch',
			[
				'label'       => __( 'Pitch', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => __('specifies the angle, up or down, of the camera', 'droit-addons'),
				'placeholder' => __( '-90 to 90', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => ['streetview']
                ]
			]
		);

        $this->add_control(
			'dl_map_streetview_fov',
			[
				'label'       => __( 'fov', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( '10-100', 'droit-addons' ),
                'description' => __('determines the horizontal field of view of the image', 'droit-addons'),
                'condition'   => [
                    'dl_choose_google_map_modes' => ['streetview']
                ]
			]
		);

        $this->add_control(
			'dl_map_streetview_pano',
			[
				'label'       => __( 'Pano', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'panorama ID', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => ['streetview']
                ]
			]
		);

        $this->add_control(
			'dl_map_search_terms',
			[
				'label'       => __( 'Search Terms', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'record stores in seattle', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => 'search'
                ]
			]
		);

        $this->add_control(
			'dl_map_latitude',
			[
				'label'       => __( 'Latitude', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT, 
                'default'     => '46.414382',
				'placeholder' => __( '46.414382', 'droit-addons' ),
			]
		);

        $this->add_control(
			'dl_map_longitude',
			[
				'label'       => __( 'Longitude', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '10.013988',
				'placeholder' => __( '10.013988', 'droit-addons' ),
			]
		);

        $this->add_control(
			'dl_map_zoom',
			[
				'label'       => __( 'Zoom', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( '10', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => ['place', 'view', 'directions', 'search']
                ]
			]
		);

        $this->add_control(
			'dl_choose_google_map_type',
			[
				'label'   => __( 'Map Type', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'roadmap',
				'options' => [
					'roadmap'         => __( 'Roadmap', 'droit-addons' ),
					'satellite'       => __( 'Satellite', 'droit-addons' ),
				],
                'condition'   => [
                    'dl_choose_google_map_modes' => ['place', 'view', 'directions', 'search']
                ]
			]
		);

        $this->add_control(
			'dl_choose_google_mode',
			[
				'label'   => __( 'Mode', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'driving',
				'options' => [
					'driving'       => __( 'Driving', 'droit-addons' ),
					'walking'       => __( 'Walking', 'droit-addons' ),
				],
                'condition'   => [
                    'dl_choose_google_map_modes' => 'directions'
                ]
			]
		);

        $this->add_control(
			'dl_choose_google_map_origin',
			[
				'label'       => __( 'Start Point', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Oslo Norway', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => 'directions'
                ]
 			]
		);

        $this->add_control(
			'dl_choose_google_map_destination',
			[
				'label'       => __( 'End Point', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Telemark Norway', 'droit-addons' ),
                'condition'   => [
                    'dl_choose_google_map_modes' => 'directions'
                ]
			]
		);
        
        $this->end_controls_section();
    } 

    public function dl_register_styles_controls() {
        
    } 

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract( $settings ); 

        $api          = drdt_manager()->api->api_data();
        $api_key      = ($api['google_map']['access_token']) ?? '';
        $location     = $dl_map_marker_location ?? '';
        $zoom         = $dl_map_zoom ?? '';
        $map_type     = $dl_choose_google_map_type ?? '';
        $center       = $dl_map_latitude . ',' . $dl_map_longitude;
        $origin       = $dl_choose_google_map_origin ?? '';
        $destination  = $dl_choose_google_map_destination ?? '';
        $mode         = $dl_choose_google_mode ?? '';
        $search_terms = $dl_map_search_terms ?? '';
        $heading      = $dl_map_streetview_heading ?? '';
        $pitch        = $dl_map_streetview_pitch ?? '';
        $fov          = $dl_map_streetview_fov ?? '';
        $pano         = $dl_map_streetview_pano ?? '';
        $waypoints    = $dl_map_marker_waypoints ?? '';
        $avoid        = $dl_map_marker_avoid ?? '';
        $units        = $dl_choose_google_units ?? '';


        
        if(empty($api_key)) {
           $params['key']  = 'AIzaSyCgNrR6SPSoAdFkwrEhhuzTX_AihI74Mv4';
        }
        else {
            $params['key']  = $api_key;
        }

        if($dl_choose_google_map_modes != 'streetview' && !empty($zoom)) {
            $params['zoom'] = $zoom;
        }

        if($dl_choose_google_map_modes !== 'streetview' && !empty($zoom)) {
            $params['maptype'] = $map_type;
        }

        if( $dl_choose_google_map_modes !== 'streetview' ) {

            if($dl_choose_google_map_modes === 'view') {
                if(empty($dl_map_latitude) || empty($dl_map_longitude)){
                    echo 'You must provide latitude and longitude';
                    return;
                }
                else {
                    $center   = $dl_map_latitude . ',' . $dl_map_longitude;
                    $params['center'] = $center;
                }
            }
            else if(!empty($dl_map_latitude) && !empty($dl_map_longitude)) {
                $center   = $dl_map_latitude . ',' . $dl_map_longitude;
                $params['center'] = $center;
            }
        }

        switch($dl_choose_google_map_modes) {

            case 'place':
                                
                if(empty($location)) {
                    echo 'You must provide location';
                    return;
                }
                else {
                    $params['q']  = $location;
                }

                $url = 'https://www.google.com/maps/embed/v1/place?' . http_build_query($params);
                break;
            
            case 'view':
        
                $url = 'https://www.google.com/maps/embed/v1/view?' . http_build_query($params);
                break;

            case 'directions':
                
                if(empty($origin)) {
                    echo 'Please provide start point';
                    return;
                }
                else {
                    $params['origin']         = $origin;
                }

                if(empty($destination)) {
                    echo 'Please Provide End Point';
                    return;
                }
                else {
                    $params['destination']    = $destination;
                }

                if(!empty($waypoints)) {
                    $params['waypoints'] = $waypoints;
                }

                if(!empty($avoid)) {
                    $params['avoid'] = $avoid;
                }

                if(!empty($units)) {
                    $params['units'] = $units;
                }

                if(!empty($mode)) {
                    $params['mode'] = $mode;
                }
        
                $url = 'https://www.google.com/maps/embed/v1/directions?' . http_build_query($params);
                break;

            case 'streetview':
               
                if( empty($dl_map_latitude) || empty($dl_map_longitude) ) {
                    echo 'You must provide latitude and longitude';
                    return;
                }
                else {
                    $center   = $dl_map_latitude . ',' . $dl_map_longitude;
                    $params['location'] = $center;
                }
                
                if(!empty($heading)) {
                    $params['heading']  = $heading;
                }

                if(!empty($pitch)) {
                    $params['pitch']  = $pitch;
                }

                if(!empty($fov)) {
                    $params['fov']  = $fov;
                }

                if(!empty($pano)) {
                    $params['pano'] = $pano;
                }

                $url = 'https://www.google.com/maps/embed/v1/streetview?' . http_build_query($params);
                break;

            case 'search':
                               
                if(empty($search_terms)) {
                    echo 'You must provide Search Terms';
                    return;
                }
                else {
                    $params['q']  = $search_terms;
                }

                $url = 'https://www.google.com/maps/embed/v1/search?' . http_build_query($params);
                break;

            default:
                
                if(empty($location)) {
                    echo 'You must provide location';
                    return;
                }
                else {
                    $params['q']  = $location;
                }
        
                $url = 'https://www.google.com/maps/embed/v1/place?' . http_build_query($params);

        }
  
        
        ?>
        <iframe
        width="450"
        height="550"
        frameborder="0" style="border:0"
        src="<?php echo $url;?>" allowfullscreen>
        </iframe>

        <?php

    }

    protected function content_template(){}
}
