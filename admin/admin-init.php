<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Getting theme option data
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( !function_exists('habib_option')) :
    
    function habib_option($index = FALSE, $index2 = FALSE, $default = NULL) {
        global $habib_theme_option;

        if (empty($index)) {
            return $habib_theme_option;
        }

        if ($index2) {
            $result = (isset($habib_theme_option[ $index ]) and isset($habib_theme_option[ $index ][ $index2 ])) ? $habib_theme_option[ $index ][ $index2 ] : $default;
        } else {
            $result = isset($habib_theme_option[ $index ]) ? $habib_theme_option[ $index ] : $default;
        }

        if ($result == '1' or $result == '0') {
            return $result;
        }

        if (is_string($result) and empty($result)) {
            return $default;
        }

        return $result;
    }

endif;

// Load the themes options
require get_template_directory() . "/admin/theme-options-config.php";