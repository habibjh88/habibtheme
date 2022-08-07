<?php

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Register meta boxes
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (! function_exists('habib_register_meta_boxes')) :

	function habib_register_meta_boxes( $meta_boxes ) {

		//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
		// Meta box for portfolio 
		//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
		$meta_boxes[] = array(
			'id' => 'tt-portfolio-metabox',
			'title' => esc_html__( 'Portfolio Meta', 'maacuni' ),
			'pages' => array( 'post'),
			'context' => 'normal',
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(

                array(
                    'name'  => esc_html__( 'Cline Name', 'maacuni' ),
                    'id'    => "cline_name",
                    'type'  => 'textarea',
                    'std'   => ''
                ),
				
				array(
					'name'  => esc_html__( 'Live Preview', 'maacuni' ),
					'id'    => "live_link",
					'type'  => 'text',
					'std'   => ''
				),

				array(
					'name'  => esc_html__( 'Themefores Link', 'maacuni' ),
					'id'    => "themeforest_link",
					'type'  => 'text',
					'std'   => ''
				),
                array(
                    'name'  => esc_html__( 'Development Preview', 'maacuni' ),
                    'id'    => "dev_link",
                    'type'  => 'text',
                    'std'   => ''
                ),

                array(
                    'name'  => esc_html__( 'Role', 'maacuni' ),
                    'id'    => "role",
                    'type'  => 'text',
                    'std'   => ''
                ),

				array(
					'name'  => esc_html__( 'Description', 'maacuni' ),
					'id'    => "description",
					'type'  => 'textarea',
					'std'   => ''
				),


                array(
                    'name'            => 'Select',
                    'id'              => 'theme_type',
                    'type'            => 'select',
                    'options'         => array(
                        'themeforest'       => esc_html__( 'Themeforests Item', 'maacuni' ),
                        'live'       => esc_html__( 'Live Project', 'maacuni' ),
                        'developing'       => esc_html__( 'Developing...', 'maacuni' ),
                    ),
                    // Placeholder text
                    'placeholder'     => 'Select an Item',
                    // Display "Select All / None" button?
                    'select_all_none' => true,
                ),
				
			)
		);

		
	

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'habib_register_meta_boxes' );
endif;