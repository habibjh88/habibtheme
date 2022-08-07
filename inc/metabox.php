<?php

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Register meta boxes
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_register_meta_boxes')) :

    function habib_register_meta_boxes($meta_boxes)
    {

        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Meta box for portfolio
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        $meta_boxes[] = array(
            'id' => 'tt-portfolio-metabox',
            'title' => esc_html__('Portfolio Meta', 'habib'),
            'pages' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(

                array(
                    'name' => esc_html__('Author Name', 'habib'),
                    'id' => "cline_name",
                    'type' => 'textarea',
                    'std' => ''
                ),

                array(
                    'name' => esc_html__('Live Preview', 'habib'),
                    'id' => "live_link",
                    'type' => 'text',
                    'std' => ''
                ),

                array(
                    'name' => esc_html__('Themefores Link', 'habib'),
                    'id' => "themeforest_link",
                    'type' => 'text',
                    'std' => ''
                ),

                array(
                    'name' => esc_html__('WordPress org', 'habib'),
                    'id' => "wp_org_link",
                    'type' => 'text',
                    'std' => ''
                ),

                array(
                    'name' => esc_html__('Pro Link', 'habib'),
                    'id' => "pro_link",
                    'type' => 'text',
                    'std' => ''
                ),

                array(
                    'name' => esc_html__('Development Preview', 'habib'),
                    'id' => "dev_link",
                    'type' => 'text',
                    'std' => ''
                ),

                array(
                    'name' => esc_html__('Role', 'habib'),
                    'id' => "role",
                    'type' => 'text',
                    'std' => ''
                ),

                array(
                    'name' => esc_html__('Description', 'habib'),
                    'id' => "description",
                    'type' => 'textarea',
                    'std' => ''
                ),


                array(
                    'name' => 'Select',
                    'id' => 'theme_type',
                    'type' => 'select',
                    'options' => array(
                        'themeforest' => esc_html__('Themeforests Item', 'habib'),
                        'live' => esc_html__('Live Project', 'habib'),
                        'wordpress' => esc_html__('WordPress.org', 'habib'),
                        'developing' => esc_html__('Developing...', 'habib'),
                    ),
                    // Placeholder text
                    'placeholder' => 'Select an Item',
                    // Display "Select All / None" button?
                    'select_all_none' => true,
                ),

            )
        );


        return $meta_boxes;
    }

    add_filter('rwmb_meta_boxes', 'habib_register_meta_boxes');
endif;