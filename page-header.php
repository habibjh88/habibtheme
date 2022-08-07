<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

$tt_page_template = basename( get_page_template_slug() );

$page_header_visibility = NULL;

$header_page_options = maacuni_option('page-header-visibility', false, true);
$blog_page_header = maacuni_option('blog-page-header', false, true);

if (function_exists('rwmb_meta')) :
    $page_header_visibility = rwmb_meta('maacuni_page_header_visibility');
endif;

if(!is_404() && !is_single()) :
	if ($page_header_visibility == 'header-inherite-option' || $page_header_visibility == 'header-section-show' || $page_header_visibility == NULL) :
		if ($header_page_options == 'header-section-show' || $page_header_visibility == 'header-section-show') :
			
			if ( is_page() && $tt_page_template != 'template-home.php') : 
				get_template_part( 'template-parts/page-header', 'section' );
			endif;

			if ( !is_page() ) : 
				if ($blog_page_header) {
					get_template_part( 'template-parts/page-header', 'section' );
				} elseif(is_post_type_archive( ) || is_tax() || is_archive() || is_search() || is_category() || is_tag() || is_author()){
					get_template_part( 'template-parts/page-header', 'section' );
				}
			endif;
		endif;
	endif;
endif;