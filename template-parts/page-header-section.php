<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; 

$page_title_visibility = $overlay_visibility = $breadcrumb_visibility = $header_height = $page_header_height = NULL;
$header_image = "";
if (function_exists('rwmb_meta')) :
    $overlay_visibility = rwmb_meta('habib_background_overlay');
    $page_title_visibility = rwmb_meta('habib_page_title_visibility');
    $breadcrumb_visibility = rwmb_meta('habib_page_breadcrumb_show');
endif;

if (habib_page_header_background()) :
    $header_image = 'background-image:url('.habib_page_header_background().')'.';';
endif; ?>

<div class="page-header-section" style="<?php echo esc_attr($header_image); ?>" role="banner">
    <?php if ($overlay_visibility == 'overlay_inherite_option' || $overlay_visibility == NULL) : ?>
        <?php if (habib_option('tt-image-overlay', false, true)): ?>
            <div class="tt-overlay <?php echo esc_attr(habib_option('overlay-style', false, 'default-style')) ?>"></div>
        <?php endif;
    elseif($overlay_visibility == 'bg_overlay_enable') : ?>
        <div class="tt-overlay <?php echo esc_attr(habib_option('overlay-style', false, 'default-style')) ?>"></div>
    <?php endif; ?>

    <div class="container">
        <div class="page-header">
            <?php if ($page_title_visibility == 'title-inherite-option' || $page_title_visibility == NULL) : 
                $title_visibility = habib_option('tt-page-title', false, true);
                if ($title_visibility && ! is_single()) :  ?>

                    <h2><?php echo esc_html( habib_page_header_section_title() ); ?></h2> 

                <?php endif;
               
            elseif($page_title_visibility == 'page-title-show') : 

                if (! is_single()) { ?>
                    <h2><?php echo esc_html( habib_page_header_section_title() ); ?></h2>
                <?php }

            endif; ?>

            <?php if ($breadcrumb_visibility == "breadcrumb_inherite_option" || $breadcrumb_visibility == NULL) :
                if (habib_option('tt-breadcrumb', false, false)) :
                    habib_breadcrumbs();
                endif;
            elseif($breadcrumb_visibility == "page_breadcrumb_show"):
                habib_breadcrumbs();
            endif; ?>
        </div><!-- /.page-header -->
    </div><!-- /.container -->
</div><!-- .page-header-section -->
