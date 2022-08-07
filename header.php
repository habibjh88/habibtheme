<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
    <?php wp_head(); ?>
</head>

<body id="home" <?php body_class(); ?> data-spy="scroll" data-target=".navbar" data-offset="100">

    <?php if (maacuni_option('page-preloader', false, true)) : ?>
        <div id="preloader" style="background-color: <?php echo esc_attr(maacuni_option('loader-bg-color', false, '#ffffff'));?>">
            <div id="status">
                <span></span>
                <span></span>
            </div>

            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>

        <?php 
            $tt_load_bg = maacuni_option('preloader-slider-bg', false, '#101a87');
            if($tt_load_bg){
                $tt_load_bg = 'background-color:'. $tt_load_bg.';';
            }
        ?>
        <div class="tt-load-animation-wrapper"></div>
        <div class="tt-load-animation"></div>
    <?php endif; ?>
    
    <div class="site-wrapper">

        <?php do_action('maacuni_before_site_wrapper'); ?>

        <?php 
        $tt_header_style = maacuni_option('header-style', false, 'header-default');

        $page_header = "";
        if (function_exists('rwmb_meta')) : 
            $page_header = rwmb_meta('maacuni_header_style');
        endif;

        if ($page_header == 'inherit-theme-option' || empty($page_header)) :
            if ($tt_header_style == 'header-left-menu') :
                get_header('left-menu');
            elseif ($tt_header_style == 'no-header') :
            else :
                get_header('default');
            endif;
        elseif ($page_header == 'header-left-menu') :
            get_header('left-menu');
        elseif($page_header == 'no-header') :
        else :
            get_header('default');
        endif; ?>

<?php get_template_part( 'page', 'header' );