<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; 

$page_title_visibility = $overlay_visibility = $breadcrumb_visibility = $header_height = $page_header_height = NULL;
$header_image = "";
if (function_exists('rwmb_meta')) :
    $overlay_visibility = rwmb_meta('maacuni_background_overlay');
    $page_title_visibility = rwmb_meta('maacuni_page_title_visibility');
    $breadcrumb_visibility = rwmb_meta('maacuni_page_breadcrumb_show');
endif;

if (maacuni_page_header_background()) :
    $header_image = 'background-image:url('.maacuni_page_header_background().')'.';';
endif; ?>

<div class="page-header-section" style="<?php echo esc_attr($header_image); ?>" role="banner">
    <?php if ($overlay_visibility == 'overlay_inherite_option' || $overlay_visibility == NULL) : ?>
        <?php if (maacuni_option('tt-image-overlay', false, true)): ?>
            <div class="tt-overlay <?php echo esc_attr(maacuni_option('overlay-style', false, 'default-style')) ?>"></div>
        <?php endif;
    elseif($overlay_visibility == 'bg_overlay_enable') : ?>
        <div class="tt-overlay <?php echo esc_attr(maacuni_option('overlay-style', false, 'default-style')) ?>"></div>
    <?php endif; ?>

    <div class="container">
        <div class="page-header">
            <?php if ($page_title_visibility == 'title-inherite-option' || $page_title_visibility == NULL) : 
                $title_visibility = maacuni_option('tt-page-title', false, true);
                if ($title_visibility && ! is_single()) :  ?>

                    <h2><?php echo esc_html( maacuni_page_header_section_title() ); ?></h2> 

                <?php endif;
               
            elseif($page_title_visibility == 'page-title-show') : 

                if (! is_single()) { ?>
                    <h2><?php echo esc_html( maacuni_page_header_section_title() ); ?></h2>
                <?php }

            endif; ?>

            <?php if ($breadcrumb_visibility == "breadcrumb_inherite_option" || $breadcrumb_visibility == NULL) :
                if (maacuni_option('tt-breadcrumb', false, false)) :
                    maacuni_breadcrumbs();
                endif;
            elseif($breadcrumb_visibility == "page_breadcrumb_show"):
                maacuni_breadcrumbs();
            endif; ?>
        </div><!-- /.page-header -->
    </div><!-- /.container -->
</div><!-- .page-header-section -->
