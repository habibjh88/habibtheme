<?php if ( ! defined( 'ABSPATH' ) ) :
        exit; // Exit if accessed directly
    endif;

    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // ReduxFramework  Config File
    // For full documentation, please visit: https://docs.reduxframework.com
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // This is your option name where all the Redux data is stored.
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    $opt_name = "habib_theme_option";


    /**
     * SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => TRUE,
        // Show the sections below the admin menu item or not
        'menu_title'           => sprintf( esc_html__( '%s Options', 'habib' ), $theme->get( 'Name' ) ),
        // Show the sections below the admin page title or not
        'page_title'           => sprintf( esc_html__( '%s Theme Options', 'habib' ), $theme->get( 'Name' ) ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => FALSE,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => TRUE,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => TRUE,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => FALSE,
        // Show the time the page took to load, etc
        'update_notice'        => TRUE,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => TRUE,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => '40',
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => TRUE,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => FALSE,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => TRUE,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => TRUE,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => TRUE,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'        => sprintf( esc_html__( '%s Theme Options', 'habib' ), $theme->get( 'Name' ) ),
        // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => TRUE,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => TRUE,
                'rounded' => FALSE,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // START SECTIONS
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    // General Settings
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-cogs',
        'title'  => esc_html__('General Settings', 'habib'),
        'fields' => array(

            array(
                'id'       => 'rtl',
                'type'     => 'switch',
                'title'    => esc_html__('RTL', 'habib'),
                'subtitle' => esc_html__('Enable or Disabled RTL', 'habib'),
                'on'       => esc_html__('Enable', 'habib'),
                'off'      => esc_html__('Disabled', 'habib'),
                'default'  => FALSE,
            )
        )
    ));


    // Header settings
    Redux::setSection( $opt_name, array(
        'icon'   => 'el el-website',
        'title'  => esc_html__( 'Header Settings', 'habib' ),
        'fields' => array(
            
            // header style
            array(
                'id'       => 'header-style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header styles', 'habib' ),
                'subtitle' => esc_html__( 'Select Header Style.', 'habib' ),
                'options'  => array(
                    'header-default'   => array(
                        'alt' => esc_html__('Header default', 'habib'),
                        'img' => get_template_directory_uri() . '/images/header-default.jpg'
                    ),
                    'header-transparent'   => array(
                        'alt' => esc_html__('Header Transparent', 'habib'),
                        'img' => get_template_directory_uri() . '/images/header-transparent.jpg'
                    ),
                    'header-left-menu'   => array(
                        'alt' => esc_html__('Header Menu Left', 'habib'),
                        'img' => get_template_directory_uri() . '/images/header-left.jpg'
                    ),
                    'no-header'   => array(
                        'alt' => esc_html__('No Header', 'habib'),
                        'img' => get_template_directory_uri() . '/images/no-header.jpg'
                    )
                ),
                'default'  => 'header-default'
            ),

        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Header Topbar
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-website-alt',
        'title'  => esc_html__('Header Topbar', 'habib'),
        'subsection'       => true,
        'fields' => array(
            // header top wrapper
            array(
                'id'       => 'header-top-visibility',
                'type'     => 'switch',
                'title'    => esc_html__('Header topbar visibility', 'habib'),
                'subtitle' => esc_html__('Visible or Hidden header topbar', 'habib'),
                'on'       => esc_html__('Visible', 'habib'),
                'off'      => esc_html__('Hidden', 'habib'),
                'default'  => false,
            ),

            array(
                'id'       => 'news-feed-visibility',
                'type'     => 'switch',
                'required' => array('header-top-visibility', '=', '1'),
                'title'    => esc_html__('News Feed visibility', 'habib'),
                'subtitle' => esc_html__('Visible or Hidden topbar newsfeed', 'habib'),
                'on'       => esc_html__('Visible', 'habib'),
                'off'      => esc_html__('Hidden', 'habib'),
                'default'  => TRUE,
            ),

            array(
                'id'       => 'prefix-title',
                'type'     => 'text',
                'required' => array('news-feed-visibility', '=', '1'),
                'title'    => esc_html__('News Feed prefix', 'habib'),
                'subtitle' => esc_html__('Change news prefix text', 'habib'),
                'default'  => esc_html__('Press:', 'habib')
            ),

            array(
                'id'       => 'post-source',
                'type'     => 'select',
                'required' => array('news-feed-visibility', '=', '1'),
                'title'    => esc_html__('Select post source', 'habib'),
                'options'  => array(
                    'latest-post' => 'Latest Post',
                    'selected-post' => 'Selected Post',
                    'category-post' => 'From Category'
                ),
                'default'  => 'latest-post',
                'subtitle' => esc_html__('Select post source', 'habib'),
            ),

            array(
                'id'       => 'post-lists',
                'type'     => 'select',
                'required' => array('post-source', '=', 'selected-post'),
                'title'    => esc_html__('Select posts', 'habib'),
                'data'     => 'posts',
                'args'     => array(
                    'post_type'      => 'post',
                    'posts_per_page' => -1
                ),
                'multi'    => true,
                'subtitle' => esc_html__('Select post to show on breaking news', 'habib'),
            ),

            array(
                'id'       => 'category-lists',
                'type'     => 'select',
                'required' => array('post-source', '=', 'category-post'),
                'title'    => esc_html__('Select a category', 'habib'),
                'data'     => 'categories',
                'multi'    => true,
                'subtitle' => esc_html__('Select a cateogry to show selected category post', 'habib'),
            ),

            array(
                'id'       => 'news-feed-limit',
                'type'     => 'text',
                'required' => array('post-source', '=', array('category-post', 'latest-post')),
                'title'    => esc_html__('News feed limit', 'habib'),
                'subtitle' => esc_html__('Change post limit from header topbar', 'habib'),
                'default'  => 5
            ),

            array(
                'id'       => 'header-contact',
                'type'     => 'editor',
                'required' => array('header-top-visibility', '=', '1'),
                'title'    => esc_html__('Header contact', 'habib'),
                'subtitle' => esc_html__('Change header contact info', 'habib'),
                'default'  => '<ul><li><i class="fa fas fa-phone"></i> +123 125 145</li><li><a href="mailto:username@host.com"><i class="fas fa-envelope"></i> username@host.com</a></li></ul>'
            ),

            array(
                'id'       => 'language-switcher-visibility',
                'type'     => 'switch',
                'required' => array('header-top-visibility', '=', '1'),
                'title'    => esc_html__('Language switcher visibility, N.B: need WPML to get the output', 'habib'),
                'subtitle' => esc_html__('Visible or Hidden language switcher', 'habib'),
                'on'       => esc_html__('Visible', 'habib'),
                'off'      => esc_html__('Hidden', 'habib'),
                'default'  => TRUE,
            )
        )
    ));

    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Header Menu
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-home-alt',
        'title'  => esc_html__('Header Menu', 'habib'),
        'subsection'       => true,
        'fields' => array(
            array(
                'id'       => 'menu-alignment',
                'type'     => 'select',
                'title'    => esc_html__('Menu Alignment', 'habib'),
                'options'  => array(
                    'justify-content-start' => 'Left',
                    'justify-content-center' => 'Center',
                    'justify-content-end' => 'Right'
                ),
                'default'  => 'justify-content-end',
                'subtitle' => esc_html__('Select menu alignment', 'habib'),
            ),

            // Menu typography
            array(
                'id'       => 'menu-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Menu Typography', 'habib' ),
                'subtitle' => esc_html__( 'Specify the menu font properties.', 'habib' ),
                'google'   => true,
                'font-family' => true,
                'text-align' => false,
                'font-size' => false,
                'line-height' => false,
                'color' => false,
                'font-weight' => false,
                'font-style' => false,
                'default'  => array(
                    'font-family' => 'Fira Sans'
                ),
            ),

            // menu background color
            array(
                'id'       => 'menu-bg-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu background color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for menu background.', 'habib' )
            ),

            // menu color
            array(
                'id'       => 'menu-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu font color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for menu.', 'habib' )
            ),

            // menu color
            array(
                'id'       => 'menu-hover-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu hover color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for menu hover.', 'habib' )
            ),

            // mobile menu background color
            array(
                'id'       => 'mobile-menu-bg-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mobile menu background color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for mobile menu background.', 'habib' )
            ),

            // mobile menu color
            array(
                'id'       => 'mobile-menu-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mobile menu font color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for mobile menu.', 'habib' )
            )
        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Header search
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-search',
        'title'  => esc_html__('Header Search', 'habib'),
        'subsection'       => true,
        'fields' => array(
            // header search visibility
            array(
                'id'       => 'search-visibility',
                'type'     => 'switch',
                'title'    => esc_html__('Search visibility', 'habib'),
                'subtitle' => esc_html__('Visible or Hidden search button', 'habib'),
                'on'       => esc_html__('Visible', 'habib'),
                'off'      => esc_html__('Hidden', 'habib'),
                'default'  => FALSE,
            ),

            array(
                'id'       => 'search-bg-color',
                'type'     => 'color',
                'title'    => esc_html__('Search Background Color', 'habib'),
                'desc' => esc_html__('If you want, you can change search background color.', 'habib'),
                'required' => array('search-visibility', '=', '1'),
                
            ),

            array(
                'id'       => 'tt-search-result',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Search Settings', 'habib' ),
                'required' => array('search-visibility', '=', '1'),
                'subtitle' => esc_html__( 'Check post type to show search result', 'habib' ),
                'options'  => array(
                    'post-search'         => esc_html__( 'Post', 'habib' ),
                    'tt-team'     => esc_html__( 'Team', 'habib' ),
                    'tt-portfolio'     => esc_html__( 'Portfolio', 'habib' )
                ),
                'default'  => array(
                    'post-search' => '1',
                    'tt-team'   => '0',
                    'tt-portfolio'   => '0'
                )
            )
        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Offcanvas settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-lines',
        'title'  => esc_html__('Offcanvas Menu', 'habib'),
        'subsection'       => true,
        'fields' => array(

            // header search visibility
            array(
                'id'       => 'offcanvas-visibility',
                'type'     => 'switch',
                'title'    => esc_html__('Offcanvas visibility', 'habib'),
                'subtitle' => esc_html__('Visible or Hidden search button', 'habib'),
                'on'       => esc_html__('Visible', 'habib'),
                'off'      => esc_html__('Hidden', 'habib'),
                'default'  => false,
            ),

            array(
                'id'       => 'offcanvas-bg',
                'type'     => 'color',
                'title'    => esc_html__('Offcanvas Background', 'habib'),
                'desc' => esc_html__('If you want, you can change search offcanvas background color.', 'habib'),
                'required' => array('offcanvas-visibility', '=', '1'),
            ),
        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Logo settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-slideshare',
        'title'  => esc_html__('Logo Settings', 'habib'),
        'fields' => array(
            array(
                'id'       => 'logo-type',
                'type'     => 'switch',
                'title'    => esc_html__('Logo Type', 'habib'),
                'subtitle' => esc_html__('You can set text or image logo', 'habib'),
                'on'       => esc_html__('Image Logo', 'habib'),
                'off'      => esc_html__('Text Logo', 'habib'),
                'default'  => TRUE,
            ),

            array(
                'id'       => 'text-logo',
                'type'     => 'text',
                'required' => array('logo-type', '=', '0'),
                'title'    => esc_html__('Logo Text', 'habib'),
                'subtitle' => esc_html__('Change your logo text', 'habib')
            ),

            array(
                'id'       => 'text-logo-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Logo Typography', 'habib' ),
                'subtitle' => esc_html__( 'Specify the logo font properties.', 'habib' ),
                'google'   => true,
                'text-align' => false,
                'required' => array('logo-type', '=', '0'),
                'default'  => array(
                    'color'       => '#212121',
                    'font-size'   => '24px',
                    'font-family' => 'Fira Sans',
                    'font-weight' => '600',
                    'line-height' => '80px'
                ),
            ),

            array(
                'id'       => 'logo',
                'type'     => 'media',
                'preview'  => 'true',
                'required' => array('logo-type', '=', '1'),
                'title'    => esc_html__('Site Logo.', 'habib'),
                'subtitle' => esc_html__('Change Site logo dimension: 80px &times; 80px', 'habib')
            ),

            array(
                'id'       => 'retina-logo',
                'type'     => 'media',
                'preview'  => 'true',
                'required' => array('logo-type', '=', '1'),
                'title'    => esc_html__('Retina Logo Image (High Density)', 'habib'),
                'subtitle' => esc_html__('Change Retina logo dimension: 160px &times; 160px', 'habib')
            ),
            
            array(
                'id'       => 'mobile-logo',
                'type'     => 'media',
                'preview'  => 'true',
                'required' => array('logo-type', '=', '1'),
                'title'    => esc_html__('Site Mobile Logo.', 'habib'),
                'subtitle' => esc_html__('Change site mobile logo dimension: 80px &times; 80px', 'habib')
            ),

            array(
                'id'       => 'retina-mobile-logo',
                'type'     => 'media',
                'preview'  => 'true',
                'required' => array('logo-type', '=', '1'),
                'title'    => esc_html__('Retina Mobile Logo Image (High Density)', 'habib'),
                'subtitle' => esc_html__('Change retina mobile logo dimension: 160px &times; 160px', 'habib')
            ),
            
            array(
                'id'             => 'logo-margin',
                'type'           => 'spacing',
                'output'         => array('.navbar-brand'),
                'mode'           => 'margin',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => esc_html__('Margin Option', 'habib'),
                'subtitle'       => esc_html__('You can change logo margin if needed.', 'habib'),
                'desc'           => esc_html__('Change top, right, bottom and left value in px, e.g: 10', 'habib')
            )
        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Page header image settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-picture',
        'title'  => esc_html__('Page Header Settings', 'habib'),
        'fields' => array(

            array(
                'id'       => 'page-header-visibility',
                'type'     => 'select',
                'title'    => esc_html__('Page header visibility', 'habib'),
                'subtitle' => esc_html__('Visible or Hidden all page header section', 'habib'),
                'options'  => array(
                    'header-section-show' => esc_html__('Page Header Section Show', 'habib'),
                    'header-section-hide' => esc_html__('Page Header Section Hide', 'habib')
                ),
                'desc'     => esc_html__('Will show/hide background image, title and breadcrumb', 'habib'),
                'default'  => 'header-section-show'
            ),

            array(
                'id'       => 'page-header-height-xlg',
                'type'     => 'text',
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'title'    => esc_html__('Enter page header height for Extra large screen', 'habib'),
                'subtitle' => esc_html__('This is optional field. If you would like to increase page header height then enter height by px. ', 'habib'),
                'default'  => '470px'
            ),

            array(
                'id'       => 'page-header-height-lg',
                'type'     => 'text',
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'title'    => esc_html__('Enter page header height for large screen', 'habib'),
                'subtitle' => esc_html__('This is optional field. If you would like to increase page header height then enter height by px. ', 'habib'),
                'default'  => '470px'
            ),

            array(
                'id'       => 'page-header-height-md',
                'type'     => 'text',
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'title'    => esc_html__('Enter page header height for medium screen', 'habib'),
                'subtitle' => esc_html__('This is optional field. If you would like to increase page header height then enter height by px. ', 'habib'),
                'default'  => '400px'
            ),

            array(
                'id'       => 'page-header-height-sm',
                'type'     => 'text',
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'title'    => esc_html__('Enter page header height for small screen', 'habib'),
                'subtitle' => esc_html__('This is optional field. If you would like to increase page header height then enter height by px. ', 'habib'),
                'default'  => '300px'
            ),

            array(
                'id'       => 'page-header-height-xs',
                'type'     => 'text',
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'title'    => esc_html__('Enter page header height for mobile screen', 'habib'),
                'subtitle' => esc_html__('This is optional field. If you would like to increase page header height then enter height by px. ', 'habib'),
                'default'  => '250px'
            ),

            array(
                'id'       => 'tt-page-title',
                'type'     => 'switch',
                'title'    => esc_html__('Page title', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'subtitle' => esc_html__('Show or Hide page title', 'habib'),
                'on'       => esc_html__('Show', 'habib'),
                'off'      => esc_html__('Hide', 'habib'),
                'default'  => TRUE,
            ),

            array(
                'id'       => 'tt-breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__('Breadcrumb', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'subtitle' => esc_html__('Show or Hide Your website Breadcrumb', 'habib'),
                'on'       => esc_html__('Show', 'habib'),
                'off'      => esc_html__('Hide', 'habib'),
                'default'  => FALSE,
            ),

            array(
                'id'       => 'tt-image-overlay',
                'type'     => 'switch',
                'title'    => esc_html__('Image Overlay', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'subtitle' => esc_html__('Show or Hide image overlay', 'habib'),
                'on'       => esc_html__('Show', 'habib'),
                'off'      => esc_html__('Hide', 'habib'),
                'default'  => TRUE,
            ),

            array(
                'id'       => 'overlay-style',
                'type'     => 'select',
                'title'    => esc_html__('Choose overlay style', 'habib'),
                'options'  => array(
                    'default-style' => esc_html__('Default Style', 'habib'),
                    'bottom-to-top-overlay' => esc_html__('Bottom To Top', 'habib')
                ),
                'required' => array('tt-image-overlay', '=', '1'),
                'desc'     => esc_html__('Choose image overlay style', 'habib'),
                'default'  => 'default-style'
            ),

            array(
                'id'       => 'page_header_color',
                'type'     => 'background',
                'output'   => array('.page-header-section'),
                'title'    => esc_html__('Background color', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'subtitle' => esc_html__('Select background color for page header, N.B: You have to remove all image to apply the changes', 'habib'),
                'background-repeat' => false,
                'background-attachment' => false,
                'background-position' => false,
                'background-image' => false,
                'background-size' => false,
                'preview' => false,
            ),

            array(
                'id'             => 'page-header-margin',
                'type'           => 'spacing',
                'output'         => array('.header-transparent .page-header-section', '.header-default .page-header-section'),
                'mode'           => 'margin',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => esc_html__('Page Header Margin Option', 'habib'),
                'subtitle'       => esc_html__('You can change page header margin if needed.', 'habib'),
                'desc'           => esc_html__('Change top, right, bottom and left value in px, e.g: 10', 'habib')
            ),

            array(
                'id'             => 'page-header-padding',
                'type'           => 'spacing',
                'output'         => array('.header-transparent .page-header-section', '.header-default .page-header-section'),
                'mode'           => 'padding',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => esc_html__('Page Header Padding Option', 'habib'),
                'subtitle'       => esc_html__('You can change page header padding if needed.', 'habib'),
                'desc'           => esc_html__('Change top, right, bottom and left value in px, e.g: 10', 'habib')
            ),

            array(
                'id'       => 'page-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Page Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),

            array(
                'id'       => 'product-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Product Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),

            array(
                'id'       => 'portfolio-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Portfolio Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),

            array(
                'id'       => 'blog-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Blog Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),

            array(
                'id'       => 'author-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Author Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),
            array(
                'id'       => 'category-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Category Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),

            array(
                'id'       => 'tag-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Tag Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),
            
            array(
                'id'       => 'search-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Search Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),
            array(
                'id'       => 'archive-header-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('Archive Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            ),
            array(
                'id'       => 'header-404-image',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('404 Header Background.', 'habib'),
                'required' => array('page-header-visibility', '=', 'header-section-show'),
                'desc'     => esc_html__('Upload image from media library, dimension: 1920px x 450px', 'habib')
            )
        )
    ));

    
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Presets settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-brush',
        'title'  => esc_html__('Preset color', 'habib'),
        'fields' => array(
            array(
                'id'       => 'body-bg-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Body background color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for the theme body background (default: #ffffff).', 'habib' ),
                'default'  => '#ffffff',
            ),

            array(
                'id'       => 'accent-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Site Accent Color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for the theme accent color (default: #17a2b8).', 'habib' ),
                'default'  => '#17a2b8',
            ),

            array(
                'id'       => 'link-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Site Link Color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for all link (default: #17a2b8).', 'habib' ),
                'default'  => '#f26343',
            ),

            array(
                'id'       => 'section-title-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Section title color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for section title (default: #2f2f2f).', 'habib' ),
                'default'  => '#2f2f2f',
            )
        )
    ));

    
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Typography
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-font',
        'title'  => esc_html__('Typography', 'habib'),
        'fields' => array(
            
            // body typography
            array(
                'id'       => 'body-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font', 'habib' ),
                'subtitle' => esc_html__( 'Specify the body font properties.', 'habib' ),
                'google'   => true,
                'text-align' => false,
                'default'  => array(
                    'color'       => '#212121',
                    'font-size'   => '16px',
                    'font-family' => 'Merriweather',
                    'font-weight' => '400',
                    'line-height' => '30px'
                ),
            ),


            // Heading all typography
            array(
                'id'       => 'heading-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading Font', 'habib' ),
                'subtitle' => esc_html__( 'This settings for all heading font (h1, h2, h3, h4, h5, h6)', 'habib' ),
                'google'   => true,
                'all_styles' => true,
                'text-align' => false,
                'font-size' => false,
                'line-height' => false,
                'default'  => array(
                    'color'       => '#212121',
                    'font-family' => 'Fira Sans',
                    'font-weight' => '700'
                ),
            ),

            // only H1 typography
            array(
                'id'       => 'h1-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'H1 (Heading one)', 'habib' ),
                'subtitle' => esc_html__( 'This settings only for H1', 'habib' ),
                'font-family' => false,
                'google'   => false,
                'text-align' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'font-weight' => false,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '48px',
                    'line-height' => '58px'
                ),
            ),


            // only H2 typography
            array(
                'id'       => 'h2-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'H2 (Heading two)', 'habib' ),
                'subtitle' => esc_html__( 'This settings only for H2', 'habib' ),
                'font-family' => false,
                'google'   => false,
                'text-align' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'font-weight' => false,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '30px',
                    'line-height' => '40px'
                ),
            ),


            // only H3 typography
            array(
                'id'       => 'h3-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'H3 (Heading three)', 'habib' ),
                'subtitle' => esc_html__( 'This settings only for H3', 'habib' ),
                'font-family' => false,
                'google'   => false,
                'text-align' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'font-weight' => false,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '26px',
                    'line-height' => '36px'
                ),
            ),

            // only H4 typography
            array(
                'id'       => 'h4-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'H4 (Heading four)', 'habib' ),
                'subtitle' => esc_html__( 'This settings only for H4', 'habib' ),
                'font-family' => false,
                'google'   => false,
                'text-align' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'font-weight' => false,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '22px',
                    'line-height' => '30px'
                ),
            ),

            // only H5 typography
            array(
                'id'       => 'h5-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'H5 (Heading five)', 'habib' ),
                'subtitle' => esc_html__( 'This settings only for H5', 'habib' ),
                'font-family' => false,
                'google'   => false,
                'text-align' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'font-weight' => false,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '18px',
                    'line-height' => '26px'
                ),
            ),

            // only H6 typography
            array(
                'id'       => 'h6-typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'H6 (Heading six)', 'habib' ),
                'subtitle' => esc_html__( 'This settings only for H6', 'habib' ),
                'font-family' => false,
                'google'   => false,
                'text-align' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'font-weight' => false,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '16px',
                    'line-height' => '25px'
                ),
            ),

        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Blog settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-file-edit',
        'title'  => esc_html__('Blog Settings', 'habib'),
        'fields' => array(

            array(
                'id'       => 'blog-page-header',
                'type'     => 'switch',
                'title'    => esc_html__('Blog page header visibility', 'habib'),
                'subtitle' => esc_html__('Show/Hide page header from blog', 'habib'),
                'on'       => esc_html__('Show', 'habib'),
                'off'      => esc_html__('Hide', 'habib'),
                'default'  => TRUE
            ),

            array(
                'id'       => 'blog-title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Page Title', 'habib'),
                'required' => array('blog-page-header', '=', true),
                'subtitle' => esc_html__('Enter Blog page title here, if leave blank then site title will appear', 'habib')
            ),

            array(
                'id'       => 'blog-sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__('Blog sidebar setting', 'habib'),
                'subtitle' => esc_html__('Select blog sidebar', 'habib'),
                'options'  => array(
                    'no-sidebar'    => array(
                        'alt' => 'No sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'left-sidebar'  => array(
                        'alt' => 'Left sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'right-sidebar'
            ),

            array(
                'id'       => 'single-sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__('Blog Details sidebar setting', 'habib'),
                'subtitle' => esc_html__('Select blog details sidebar layout', 'habib'),
                'options'  => array(
                    'no-sidebar'    => array(
                        'alt' => 'No sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'left-sidebar'  => array(
                        'alt' => 'Left sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'right-sidebar'
            ),

            array(
                'id'       => 'blog-style',
                'type'     => 'image_select',
                'title'    => esc_html__('Blog Layout Style', 'habib'),
                'options'  => array(
                    'default'    => array(
                        'alt' => 'Default',
                        'img' => get_template_directory_uri() . '/images/default.png'
                    ),
                    'creative'  => array(
                        'alt' => 'Creative',
                        'img' => get_template_directory_uri() . '/images/creative.png'
                    )
                ),
                'default'  => 'default'
            ),

            array(
                'id'       => 'blog-column',
                'type'     => 'select',
                'title'    => esc_html__('Article Per Row', 'habib'),
                'subtitle' => esc_html__('Change number of article per row', 'habib'),
                'desc' => esc_html__('NB. Column 3 will work when (Blog sidebar layout = No sidebar) selected.', 'habib'),
                'options'  => array(
                    '1' => 'Column 1',
                    '2' => 'Column 2',
                    '3' => 'Column 3',
                ),
                'default'  => '1'
            ),

            array(
                'id'       => 'tt-post-meta',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Post meta options', 'habib' ),
                'subtitle' => esc_html__( 'Check to show post meta', 'habib' ),
                'options'  => array(
                    'post-author'       => esc_html__( 'Post Author', 'habib' ),
                    'author-img'       => esc_html__( 'Author Image', 'habib' ),
                    'post-category'     => esc_html__( 'Post Category', 'habib' ),
                    'post-date'         => esc_html__( 'Post Date', 'habib' ),
                    'post-comment' => esc_html__( 'Post Comment', 'habib' ),
                    'post-like' => esc_html__( 'Post Like', 'habib' )
                ),
                'default'  => array(
                    'post-author'  => '0',
                    'author-img'  => '0',
                    'post-category'   => '1',
                    'post-date' => '1',
                    'post-comment' => '0',
                    'post-like' => '0'
                )
            ),
            array(
                'id'       => 'tt-share-button',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Share button', 'habib' ),
                'subtitle' => esc_html__( 'Check to show share button', 'habib' ),
                'options'  => array(
                    'facebook' => esc_html__( 'Facebook', 'habib' ),
                    'twitter'  => esc_html__( 'Twitter', 'habib' ),
                    'google'   => esc_html__( 'Google+', 'habib' ),
                    'linkedin' => esc_html__( 'Linkedin', 'habib' ),
                    'pinterest' => esc_html__( 'Pinterest', 'habib' ),
                    'xing' => esc_html__( 'Xing', 'habib' ),
                ),
                'default'  => array(
                    'facebook' => '1',
                    'twitter'  => '1',
                    'google'   => '1',
                    'linkedin' => '1',
                    'pinterest' => '1',
                    'xing' => '1'
                )
            ),
            array(
                'id'       => 'blog-page-nav',
                'type'     => 'switch',
                'title'    => esc_html__('Blog Pagination or Navigation', 'habib'),
                'subtitle' => esc_html__('Blog pagination style, posts pagination or newer / older posts', 'habib'),
                'on'       => esc_html__('Pagination', 'habib'),
                'off'      => esc_html__('Navigation', 'habib'),
                'default'  => TRUE
            ),

            array(
                'id'       => 'blog-overlay',
                'type'     => 'switch',
                'title'    => esc_html__('Blog overlay visibility', 'habib'),
                'subtitle' => esc_html__('You may visible or disable blog overaly', 'habib'),
                'on'       => esc_html__('Visible', 'habib'),
                'off'      => esc_html__('Disable', 'habib'),
                'default'  => TRUE
            ),

            
            array(
                'id'       => 'blog-excerpt',
                'type'     => 'switch',
                'title'    => esc_html__('Show or hide blog excerpt', 'habib'),
                'subtitle' => esc_html__('You may show or hide blog excerpt form you blog', 'habib'),
                'on'       => esc_html__('Show', 'habib'),
                'off'      => esc_html__('Hide', 'habib'),
                'default'  => true
            ),

            //Heading # 01
            array(
                'id'    => 'info_headding',
                'type'  => 'info',
                'class' => 'redux-heading',
                'title' => __('Color Settings', 'habib'),
            ),

            array(
                'id'       => 'blog-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog body background color', 'habib' ),
                'subtitle' => esc_html__( 'Pick a color for blog body background. Default color is: #e9edf0', 'habib' ),
            ),

            array(
                'id'       => 'blog-article-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog article background color', 'habib' ),
                'subtitle' => esc_html__( 'Pick a color for blog article background. Default color is #ffffff', 'habib' ),
            ),

            array(
                'id'       => 'blog-sidebar-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog sidebar background color', 'habib' ),
                'subtitle' => esc_html__( 'Pick a color for blog sidebar background. Default color is #ffffff', 'habib' ),
            ),

            array(
                'id'       => 'blog-overlay-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog overlay background color', 'habib' ),
                'subtitle' => esc_html__( 'Pick a color for blog overlay background. Default color is #f35c4c', 'habib' ),
            ),

        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Page settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-file-edit',
        'title'  => esc_html__('Page Settings', 'habib'),
        'fields' => array(

            array(
                'id'       => 'page-sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__('Page Sidebar', 'habib'),
                'subtitle' => esc_html__('Select page sidebar', 'habib'),
                'options'  => array(
                    'no-sidebar'    => array(
                        'alt' => 'No sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'left-sidebar'  => array(
                        'alt' => 'Left sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'right-sidebar'
            )
        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // TT Portfolio Settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el el-camera',
        'title'  => esc_html__('Portfolio Settings', 'habib'),
        'fields' => array(

            array(
                'id'       => 'tools_we_used_text',
                'type'     => 'text',
                'title'    => esc_html__('Tools we used', 'habib'),
                'default' => esc_html__('Tools we used', 'habib'),
                'subtitle' => esc_html__('You may change Tools we used', 'habib')
            ),

            array(
                'id'       => 'next_portfolio_visibility',
                'type'     => 'switch',
                'title'    => esc_html__('Show or Hide Next Post Link', 'habib'),
                'subtitle' => esc_html__('You may visible or disable next post link form portfolio details page.', 'habib'),
                'on'       => esc_html__('Visible', 'habib'),
                'off'      => esc_html__('Disable', 'habib'),
                'default'  => TRUE
            ),

            array(
                'id'       => 'what_next_title',
                'type'     => 'text',
                'title'    => esc_html__('What\'s next Text', 'habib'),
                'default' => esc_html__('What\'s next', 'habib'),
                'subtitle' => esc_html__('You may change what\'s next Text', 'habib'),
                'required' => array('next_portfolio_visibility', '=', '1'),
            ),

            array(
                'id'       => 'next_font_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Font Color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for font color, default color is #ffffff.', 'habib' ),
                'required' => array('next_portfolio_visibility', '=', '1'),
            )
        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Shop settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    if (class_exists('WooCommerce')) :
        Redux::setSection( $opt_name, array(
            'icon'   => 'el-icon-shopping-cart',
            'title'  => esc_html__('Shop Settings', 'habib'),
            'fields' => array(

                array(
                    'id'       => 'shop-sidebar',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Shop Sidebar', 'habib'),
                    'subtitle' => esc_html__('Select shop sidebar', 'habib'),
                    'options'  => array(
                        'no-sidebar'    => array(
                            'alt' => 'No sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                        ),
                        'left-sidebar'  => array(
                            'alt' => 'Left sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                        ),
                        'right-sidebar' => array(
                            'alt' => 'Right sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        )
                    ),
                    'default'  => 'right-sidebar'
                ),

                array(
                    'id'       => 'shopping-cart-visibility',
                    'type'     => 'switch',
                    'title'    => esc_html__('Shopping cart visibility', 'habib'),
                    'subtitle' => esc_html__('Show or hide shopping cart icon from navigation', 'habib'),
                    'on'       => esc_html__('Show', 'habib'),
                    'off'      => esc_html__('Hide', 'habib'),
                    'default'  => false,
                ),

                array(
                    'id'       => 'product-per-page',
                    'type'     => 'text',
                    'title'    => esc_html__('Product per page', 'habib'),
                    'subtitle' => esc_html__('Change number of products per page', 'habib'),
                    'default'  => '6'
                ),

                array(
                    'id'       => 'product-column',
                    'type'     => 'select',
                    'title'    => esc_html__('Product per row', 'habib'),
                    'subtitle' => esc_html__('Change number of products per row', 'habib'),
                    'options'  => array(
                        '2' => 'Column 2',
                        '3' => 'Column 3',
                        '4' => 'Column 4'
                    ),
                    'default'  => '3'
                )
            )
        ));
    endif;


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Preloader settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-repeat-alt',
        'title'  => esc_html__('Preloader Settings', 'habib'),
        'fields' => array(
            array(
                'id'       => 'page-preloader',
                'type'     => 'switch',
                'title'    => esc_html__('Page Preloader', 'habib'),
                'subtitle' => esc_html__('You can enable or disable page preloader from here.', 'habib'),
                'on'       => esc_html__('Enable', 'habib'),
                'off'      => esc_html__('Disable', 'habib'),
                'default'  => TRUE,
            ),

            array(
                'id'       => 'loader-bg-color',
                'type'     => 'color',
                'required' => array( 'page-preloader', '=', '1' ),
                'title'    => esc_html__( 'Preloader background color', 'habib' ),
                'subtitle' => esc_html__( 'Pick color for preloader background (default: #ffffff).', 'habib' ),
                'default'  => '#ffffff',
            ),

            array(
                'id'       => 'preloader-slider-bg',
                'type'     => 'color',
                'required' => array( 'page-preloader', '=', '1' ),
                'title'    => esc_html__( 'Preloader slide BG', 'habib' ),
                'subtitle' => esc_html__( 'Select preloader slide background. Default color is: #101a87', 'habib' ),
            )
        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // 404 page settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-repeat-alt',
        'title'  => esc_html__('404 Settings', 'habib'),
        'fields' => array(

            array(
                'id'       => 'page404-bg',
                'type'     => 'select',
                'title'    => esc_html__('404 background', 'habib'),
                'subtitle' => esc_html__('Choose 404 page background', 'habib'),
                'options'  => array(
                    'default' => esc_html__('Default', 'habib'),
                    'dark-404' => esc_html__('Dark Background', 'habib'),
                    'blue-404' => esc_html__('Blue Background', 'habib'),
                    'blue-light-404' => esc_html__('Blue-light Background', 'habib'),
                    'white-404' => esc_html__('White Background', 'habib'),
                    'off-white-404' => esc_html__('Off-white Background', 'habib'),
                    'theme-404' => esc_html__('Theme Background', 'habib'),
                ),
                'default' => 'default'
            ),
           

            array(
                'id'       => 'img-404',
                'type'     => 'media',
                'preview'  => 'true',
                'title'    => esc_html__('404 Image', 'habib'),
                'subtitle' => esc_html__('Upload 404 png image from media library.', 'habib')
            ),
        )
    ));


    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Footer settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-photo',
        'title'  => esc_html__('Footer Settings', 'habib'),
        'fields' => array(

            // footer style
            array(
                'id'       => 'footer-style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Footer styles', 'habib' ),
                'subtitle' => esc_html__( 'Select Footer Style.', 'habib' ),
                'options'  => array(
                    'footer-multipage'   => array(
                        'alt' => esc_html__('Footer multipage', 'habib'),
                        'img' => get_template_directory_uri() . '/images/footer-multipage.jpg'
                    ),
                    'footer-onepage'   => array(
                        'alt' => esc_html__('Footer onepage', 'habib'),
                        'img' => get_template_directory_uri() . '/images/footer-onepage.jpg'
                    ),
                    'footer-copyright'   => array(
                        'alt' => esc_html__('Footer copyright', 'habib'),
                        'img' => get_template_directory_uri() . '/images/footer-copyright.jpg'
                    ),
                    'no-footer'   => array(
                        'alt' => esc_html__('No Footer', 'habib'),
                        'img' => get_template_directory_uri() . '/images/no-footer.jpg'
                    )
                ),
                'default'  => 'footer-multipage'
            ),

            array(
                'id'       => 'footer-logo',
                'type'     => 'media',
                'preview'  => 'true',
                'required' => array('footer-style', '=', array('footer-onepage')),
                'title'    => esc_html__('Footer Logo.', 'habib'),
                'subtitle' => esc_html__('Change footer logo dimension: 150px &times; 30px', 'habib')
            ),

            array(
                'id'       => 'footer-two-title',
                'type'     => 'text',
                'required' => array('footer-style', '=', array('footer-onepage')),
                'title'    => esc_html__('Onepage Footer Title', 'habib'),
                'subtitle' => esc_html__('Write onepage footer title here.', 'habib'),
                'default'   => 'Marconi Digital Agency'
            ),

            array(
                'id'       => 'footer-two-text',
                'type'     => 'editor',
                'required' => array('footer-style', '=', array('footer-onepage')),
                'title'    => esc_html__('Onepage Footer Text', 'habib'),
                'subtitle' => esc_html__('Write onepage footer text here.', 'habib'),
                'default'   => 'Intrinsicly enable standards compliant manufactured products vis-a-vis transparent opportunities. Assertively network enabled process improvements vis-a-vis compelling markets. Interactively iterate sticky iterate .'
            ),

            array(
                'id'       => 'footer-copyright-year',
                'type'     => 'text',
                'required' => array('footer-style', '=', array('footer-onepage', 'footer-copyright')),
                'title'    => esc_html__('Copyright Year', 'habib'),
                'default'   => date('Y'),
                'subtitle' => esc_html__('Enter copyright year. e.g. 2019', 'habib')
            ),

            // footer background color

            array(
                'id'       => 'background-option',
                'type'     => 'select',
                'required' => array('footer-style', '=', array('footer-onepage')),
                'title'    => esc_html__('Select Background Options', 'habib'),
                'options'  => array(
                    'one-color-bg' => 'One Color Background',
                    'gradient-bg' => 'Gradient Background',
                ),
                'default'  => 'gradient-bg',
                'subtitle' => esc_html__('Select background options', 'habib'),
            ),

            array(
                'id'       => 'onepage-footer-bg',
                'type'     => 'color',
                'required' => array('background-option', '=', array('one-color-bg')),
                'title'    => esc_html__( 'Footer Background', 'habib' ),
                'subtitle' => esc_html__( 'Pick color as footer background.', 'habib' ),
                'default'  => '#f7872c'
            ),

            array(
                'id'       => 'onepage-footer-gradient',
                'type'     => 'color',
                'required' => array('background-option', '=', array('gradient-bg')),
                'title'    => esc_html__( 'Footer Gradient One', 'habib' ),
                'subtitle' => esc_html__( 'Choose first footer gradient color.', 'habib' ),
                'default'  => '#f7872c'
            ),

            array(
                'id'       => 'onepage-footer-gradient2',
                'type'     => 'color',
                'required' => array('background-option', '=', array('gradient-bg')),
                'title'    => esc_html__( 'Footer Gradient Two', 'habib' ),
                'subtitle' => esc_html__( 'Choose second footer gradient color.', 'habib' ),
                'default'  => '#f15f46'
            ),

            array(
                'id'       => 'footer-copyright-bg',
                'type'     => 'color',
                'required' => array('footer-style', '=', array('footer-multipage', 'footer-onepage', 'footer-copyright')),
                'title'    => esc_html__( 'Footer Copyright Background', 'habib' ),
                'subtitle' => esc_html__( 'You can change footer copyright background color', 'habib' ),
            ),

            array(
                'id'       => 'footer-copyright-color',
                'type'     => 'color',
                'required' => array('footer-style', '=', array('footer-multipage', 'footer-onepage', 'footer-copyright')),
                'title'    => esc_html__( 'Footer Copyright Font Color', 'habib' ),
                'subtitle' => esc_html__( 'You can change footer copyright font color', 'habib' ),
            ),

            array(
                'id'       => 'social-icon-visibility',
                'type'     => 'switch',
                'title'    => esc_html__('Social icon visibility', 'habib'),
                'subtitle' => esc_html__('Shor or hide social icon from footer', 'habib'),
                'on'       => esc_html__('Show', 'habib'),
                'off'      => esc_html__('Hide', 'habib'),
                'default'  => FALSE,
            ),
            
            array(
                'id'       => 'facebook-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Facebook Link', 'habib'),
                'subtitle' => esc_html__('Enter facebook page or profile link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'twitter-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Twitter Link', 'habib'),
                'subtitle' => esc_html__('Enter twitter link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'youtube-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Youtube Link', 'habib'),
                'subtitle' => esc_html__('Enter youtube chanel link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'pinterest-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Pinterest Link', 'habib'),
                'subtitle' => esc_html__('Enter pinterest link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'flickr-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Flickr Link', 'habib'),
                'subtitle' => esc_html__('Enter flicker link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'linkedin-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Linkedin Link', 'habib'),
                'subtitle' => esc_html__('Enter linkedin profile link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'vimeo-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Vimeo Link', 'habib'),
                'subtitle' => esc_html__('Enter vimeo chanel link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'instagram-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Instagram Link', 'habib'),
                'subtitle' => esc_html__('Enter instagram page or profile link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'dribbble-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Dribbble Link', 'habib'),
                'subtitle' => esc_html__('Enter dribbble profile link. Leave blank to hide icon.', 'habib'),
            ),
            array(
                'id'       => 'behance-link',
                'type'     => 'text',
                'required' => array('social-icon-visibility', '=', '1'),
                'title'    => esc_html__('Behance Link', 'habib'),
                'subtitle' => esc_html__('Enter behance profile link. Leave blank to hide icon.', 'habib'),
            ),

            array(
                'id'       => 'footer-text',
                'type'     => 'editor',
                'title'    => esc_html__('Footer Copyright Text', 'habib'),
                'subtitle' => esc_html__('Write footer copyright text here.', 'habib')
            )
        )
    ));