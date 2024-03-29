<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Adds custom classes to the array of body classes.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'habib_body_classes' ) ) :

	function habib_body_classes( $classes ) {

		// header style classes
		$page_header = $transparent_opt = '';
		if (function_exists('rwmb_meta')) :
			$page_header = rwmb_meta('habib_header_style');
			$transparent_opt = rwmb_meta('habib_header_transparent');
		endif;

		if ($page_header == 'inherit-theme-option' || empty($page_header)) {
			$classes[] = habib_option('header-style', false, 'header-default');
		} else {
			$classes[] = $page_header;
		}

		$header_page_options = habib_option('page-header-visibility', false, true);
		$blog_page_header = habib_option('blog-page-header', false, true);
		
		$page_header_visibility = "";
	    if (function_exists('rwmb_meta')) : 
	        $page_header_visibility = rwmb_meta('habib_page_header_visibility');
		endif;

		if ($page_header_visibility == 'header-inherite-option' || $page_header_visibility == 'header-section-show' || $page_header_visibility == NULL) :
			if ($header_page_options == 'header-section-show' || $page_header_visibility == 'header-section-show') :
				if ( is_page() && !is_single()) : 
					$classes[] = 'header-section-show';
				endif;
			endif;

			if ( !is_page() ) : 
				if ($blog_page_header) {
					$classes[] = 'header-section-show';
				} elseif(is_post_type_archive( ) || is_tax() || is_archive() || is_search() || is_category() || is_tag() || is_author()){
					$classes[] = 'header-section-show';
				} else {
					if (!is_single()) {
						$classes[] = 'header-section-hide';
					}
				}
			endif;
		endif;
		
		$classes[] = habib_option('overlay-style', false, 'default-style');
		
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) :
			$classes[ ] = 'group-blog';
		endif;

		// blog layout class
		$blog_sidebar = habib_option('blog-sidebar', false, 'right-sidebar');
		if ($blog_sidebar == 'left-sidebar') :
			$classes[ ] = 'blog-left-sidebar';
		elseif($blog_sidebar == 'right-sidebar') :
			$classes[ ] = 'blog-right-sidebar';
		elseif($blog_sidebar == 'no-sidebar') :
			$classes[ ] = 'blog-no-sidebar';
		endif;

		$single_sidebar = habib_option('single-sidebar', false, 'right-sidebar');
		$header_sticky = habib_option('sticky-menu-visibility', false, true);

		if($single_sidebar != 'no-sidebar' && is_active_sidebar('habib-blog-sidebar')  && is_single()){
			$classes[ ] = 'has-single-sidebar';
		}

		if($header_sticky){
			$classes[ ] = 'tt-menu-sticky';
		}

		$body_bg = "";
        if (function_exists('rwmb_meta')) : 
			$body_bg = rwmb_meta('habib_page_bg_color');
			
			if(!empty($body_bg) && $body_bg != 'inherit') :
				if($body_bg == 'body_bg_white'){
					$classes[ ] = "body-bg-white";
				} elseif($body_bg == 'body_bg_dark'){
					$classes[ ]  = "body-bg-dark";
				} elseif($body_bg == 'body_bg_theme'){
					$classes[ ]  = "body-bg-theme";
				} elseif($body_bg == 'body_bg_blue'){
					$classes[ ]  = "body-bg-blue";
				} elseif($body_bg == 'body_bg_blue_light'){
					$classes[ ]  = "body-bg-blue-light";
				} elseif($body_bg == 'body_bg_off_white'){
					$classes[ ]  = "body-bg-off-white";
				} 
			endif;
		endif;
		
		$bg_404 = habib_option('page404-bg', false, false);
		if(is_404() && $bg_404 != 'default'){
			$classes[ ] = $bg_404;
		}

		if(habib_option('rtl')){
			$classes[ ] = 'is-rtl';
		}
		
		return $classes;
	}
	add_filter( 'body_class', 'habib_body_classes' );

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'habib_page_menu_args' ) ) :
	function habib_page_menu_args( $args ) {
		$args[ 'show_home' ] = TRUE;
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'habib_page_menu_args' );
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Page break button in editor
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'habib_wp_page_pagination' ) ) :

	function habib_wp_page_pagination( $mce_buttons ) {
		if ( get_post_type() == 'post' or get_post_type() == 'page' ) {
			$pos = array_search( 'wp_more', $mce_buttons, TRUE );
			if ( $pos !== FALSE ) {
				$buttons     = array_slice( $mce_buttons, 0, $pos + 1 );
				$buttons[ ]  = 'wp_page';
				$mce_buttons = array_merge( $buttons, array_slice( $mce_buttons, $pos + 1 ) );
			}
		}

		return $mce_buttons;
	}

	add_filter( 'mce_buttons', 'habib_wp_page_pagination' );

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Redux News Flash Remove 
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! class_exists( 'reduxNewsflash' ) ):
	class reduxNewsflash {
		public function __construct( $parent, $params ) {
		}
	}
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Redux Ads Remove
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

add_filter( 'redux/' . 'habib_theme_option' . '/aURL_filter', '__return_empty_string' );


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Remove WooCommerce action
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open', 10);
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close', 5);
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart', 10);


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Change number of products per row
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'habib_product_per_row' ) ) :

	function habib_product_per_row() {
		$product_per_row = 3;

		if (habib_option('product-column')) :
			return habib_option('product-column', false, true); // products per row
		else :
			return $product_per_row;
		endif;
	}
	
	add_filter('loop_shop_columns', 'habib_product_per_row');

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Product per page
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (!function_exists('habib_shop_per_page')) :
	function habib_shop_per_page(){
		$product_per_page = 6;

		if (habib_option('product-per-page')) :
			return habib_option('product-per-page', false, true); // products per page
		else :
			return $product_per_page;
		endif;
	}
	add_filter( 'loop_shop_per_page', 'habib_shop_per_page');
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Change shop thumbnail image size
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'habib_shop_thumbnail_image_size' ) ):

    function habib_shop_thumbnail_image_size( $size ) {
        $size[ 'width' ]  = 60;
        $size[ 'height' ] = 60;
        $size[ 'crop' ]   = 1;

        return $size;
    }

    add_filter( 'woocommerce_get_image_size_shop_thumbnail', 'habib_shop_thumbnail_image_size' );

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Change shop catalog image size
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'habib_shop_catalog_image_size' ) ):

    function habib_shop_catalog_image_size( $size ) {
        $size[ 'width' ]  = 300;
        $size[ 'height' ] = 380;
        $size[ 'crop' ]   = 1;

        return $size;
    }

    add_filter( 'woocommerce_get_image_size_shop_catalog', 'habib_shop_catalog_image_size' );
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Wishlist button
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if(!function_exists('habib_wishlist_btn')) {
    function habib_wishlist_btn() {
        if(!class_exists('YITH_WCWL_Shortcode')){
            return;
        }
        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
    }
}

if( get_option('yith_wcwl_button_position') == 'shortcode' ) {
    add_action( 'woocommerce_after_add_to_cart_button', 'habib_wishlist_btn', 30 );
}

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Wishlist button
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if( !function_exists('habib_wishlist_text')):
    function habib_wishlist_text(){
        return '<i class="fas fa-heart" aria-hidden="true"></i>';
    }
    add_filter('yith-wcwl-browse-wishlist-label', 'habib_wishlist_text');
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Cart contents update when products are added to the cart via AJAX
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('habib_header_add_to_cart_fragment')) :
    function habib_header_add_to_cart_fragment( $fragments ) {
        ob_start(); ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'habib' ); ?>"><i class="fas fa-shopping-basket"></i><span class="cart-count"><?php echo intval(WC()->cart->get_cart_contents_count()); ?></span></a>
        <?php
        $fragments['a.cart-contents'] = ob_get_clean();
        return $fragments;
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'habib_header_add_to_cart_fragment' );
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Wishlist update count
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('habib_update_wishlist_count')) :
	function habib_update_wishlist_count(){
	    if( function_exists( 'YITH_WCWL' ) ){
	        wp_send_json( YITH_WCWL()->count_products() );
	    }
	}
	add_action( 'wp_ajax_update_wishlist_count', 'habib_update_wishlist_count' );
	add_action( 'wp_ajax_nopriv_update_wishlist_count', 'habib_update_wishlist_count' );
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Woocommerce sidebar
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('habib_shop_sidebar')) {
	function habib_shop_sidebar(){
		get_sidebar('shop');
	}
	
	add_action('woocommerce_sidebar', 'habib_shop_sidebar');
}


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// AJAX Quick View
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('habib_product_quick_view')) :
	function habib_product_quick_view() {
	    if(empty($_POST['prodid'])) {
	        echo esc_html__('Error: Absent product id', 'habib');
	        die();
	    }

	    $args = array(
	        'p' => (int) $_POST['prodid'],
	        'post_type' => 'product'
	    );

	    $the_query = new WP_Query( $args );
	    if ( $the_query->have_posts() ) {
	        while ( $the_query->have_posts() ) : $the_query->the_post();

	        get_template_part( 'template-parts/product-quick', 'view' );

	        endwhile;
	        wp_reset_postdata();
	    } else {
	        echo esc_html__('No product were found!', 'habib');
	    }
	    die();
	}
	add_action('wp_ajax_habib_product_quick_view', 'habib_product_quick_view');
	add_action('wp_ajax_nopriv_habib_product_quick_view', 'habib_product_quick_view');
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Before cart markup
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'habib_before_cart_div' ) ):

    function habib_before_cart_div( ) {
        echo '<div class="habib-shop habib-cart">';
    }

    add_action( 'woocommerce_before_cart', 'habib_before_cart_div' );
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  after cart markup
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'habib_after_cart_div' ) ):

    function habib_after_cart_div( ) {
        echo '</div>';
    }

    add_action( 'woocommerce_after_cart', 'habib_after_cart_div' );
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Filter the "read more" excerpt string link to the post.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('habib_excerpt_more')) :
	function habib_excerpt_more( $more ) {
		echo esc_html(get_the_excerpt());
	    return sprintf( '<a class="more-link" href="%1$s">%2$s</a>',
	        get_permalink( get_the_ID() ),
	        esc_html__( 'Read More', 'habib' )
	    );
	}
	add_filter( 'the_excerpt', 'habib_excerpt_more' );
endif;