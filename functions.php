<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// MAACUNI FUNCTIONS AND DEFINITIONS
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if ( ! defined( 'habib_THEME_NAME' ) ) {
    define( 'habib_THEME_NAME', wp_get_theme()->get( 'Name' ) );
}


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// admin-init, metabox, tt-navwalker, jetpack
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
require get_template_directory() . "/admin/admin-init.php";
require get_template_directory() . "/inc/metabox.php";
require get_template_directory() . "/inc/tt-navwalker.php";
require get_template_directory() . "/inc/tt-mobile-navwalker.php";


if (!function_exists('habib_theme_setup')) :

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Sets up theme defaults and registers support for various WordPress features.
// Note that this function is hooked into the after_setup_theme hook, which
// runs before the init hook. The init hook is too late for some features, such
// as indicating support for post thumbnails.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    function habib_theme_setup(){
       
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Make theme available for translation.
        // Translations can be filed in the /languages/ directory.
        // If you're building a theme based on maacuni, use a find and replace
        // to change 'maacuni' to the name of your theme in all the template files
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        load_theme_textdomain('maacuni', get_template_directory() . '/languages');
        

        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Add default posts and comments RSS feed links to head.
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support('automatic-feed-links');


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Supporting title tag
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support('title-tag');


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Supporting custom header
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support('custom-header');

        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Supporting custom background
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support('custom-background');



        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Gutenberg support
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support(
            'gutenberg',
            array( 'wide-images' => true )
        );

        add_theme_support( 'align-wide' );
        
        // responsive-embeds
        add_theme_support( 'responsive-embeds' );


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Enable support for Post Thumbnails on posts and pages.
        // See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-          
        add_theme_support('post-thumbnails');


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // default post thumbnail size
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        set_post_thumbnail_size(1170);
        add_image_size('thumbnail-large', 1170, 585, TRUE);

        // portfolio thumb size
        add_image_size('portfolio-thumb', 770, 500, TRUE);



        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // This theme uses wp_nav_menu() in one locations.
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        register_nav_menus(array(
           'primary' => esc_html__('Primary Menu', 'maacuni')
        ) );


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Switch default core markup for search form, comment form, and comments
        // to output valid HTML5.
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ));


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Enable support for Post Formats.
        // See: https://codex.wordpress.org/Post_Formats
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-           
        add_theme_support('post-formats', array('aside', 'status', 'image', 'audio', 'video', 'gallery', 'quote', 'link', 'chat' ));

    }

    add_action('after_setup_theme', 'habib_theme_setup');

endif; // habib_theme_setup


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Set the content width in pixels, based on the theme's design and stylesheet.
// Priority 0 to make it available to lower priority callbacks.
// @global int $content_width
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (!function_exists('habib_content_width')) :
    function habib_content_width() {
        $GLOBALS['content_width'] = apply_filters( 'habib_content_width', 1170 );
    }
    add_action( 'after_setup_theme', 'habib_content_width', 0 );
endif;
    

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Register widget area.
// @link https://codex.wordpress.org/Function_Reference/register_sidebar
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (!function_exists('habib_widgets_init')) :

    function habib_widgets_init() {

    	do_action('habib_before_register_sidebar');

        register_sidebar( apply_filters( 'habib_blog_sidebar', array(
            'name'          => esc_html__('Blog Sidebar', 'maacuni'),
            'id'            => 'maacuni-blog-sidebar',
            'description'   => esc_html__('Appears in the blog sidebar.', 'maacuni'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )));

        register_sidebar( apply_filters( 'habib_page_sidebar', array(
            'name'          => esc_html__('Page Sidebar Area', 'maacuni'),
            'id'            => 'maacuni-page-sidebar',
            'description'   => esc_html__('Appears in the Page sidebar.', 'maacuni'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )));

        if (habib_option('offcanvas-visibility')) {
            register_sidebar( apply_filters( 'habib_toggle_menu_sidebar', array(
                'name'          => esc_html__('Offcanvas Sidebar', 'maacuni'),
                'id'            => 'maacuni-toogle-menu-sidebar',
                'description'   => esc_html__('This widget created for offcanvas sidebar only', 'maacuni'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )));
        }
        
        register_sidebar( apply_filters( 'habib_footer_sidebar', array(
            'name'          => esc_html__('Footer Sidebar Area', 'maacuni'),
            'id'            => 'maacuni-footer-sidebar',
            'description'   => esc_html__('Appears in the footer', 'maacuni'),
            'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6 widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )));
        
        if (class_exists('WooCommerce')) {
            register_sidebar( apply_filters( 'habib_shop_sidebar', array(
                'name'          => esc_html__('Shop Sidebar Area', 'maacuni'),
                'id'            => 'maacuni-shop-sidebar',
                'description'   => esc_html__('Appears in the shop sidebar sidebar.', 'maacuni'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )));
        }

        do_action('habib_after_register_sidebar');
    }

    add_action('widgets_init', 'habib_widgets_init');
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Load Google Font If Redux framework is not activated.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('habib_fonts_url')) :
    function habib_fonts_url() {
        $font_url = '';

        $montserrat = esc_html_x( 'on', 'Montserrat font: on or off', 'maacuni' );
        $merriweather = esc_html_x( 'on', 'Merriweather font: on or off', 'maacuni' );

        if ( 'off' !== $montserrat || 'off' !== $merriweather) {
            $font_families = array();

            if ( 'off' !== $montserrat ) {
                $font_families[] = 'Catamaran:300,400,700,800';
            }

            if ( 'off' !== $merriweather ) {
                $font_families[] = 'Merriweather:400';
            }

            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
        }

        return esc_url_raw( $font_url );
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Enqueue scripts and styles.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (!function_exists('habib_scripts')) :
    
    function habib_scripts() {

        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Styles
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        if (! habib_option( 'body-typography' )) :
            wp_enqueue_style('maacuni-google-fonts', habib_fonts_url(), array(), NULL);
        endif;
        
        wp_enqueue_style('fontawesome-all', get_template_directory_uri() . '/css/fontawesome-all.min.css', array(), '5.0.11');
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.1');
        wp_enqueue_style('maacuni-flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css', array(), '1.0.0');
        wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), NULL);
        wp_enqueue_style('highlight', get_template_directory_uri() . '/css/dracula.min.css', array(), NULL);
        wp_register_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), NULL);
        wp_register_style('swiper', get_template_directory_uri() . '/css/swiper.min.css', array(), NULL);
        wp_register_style('owl-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css', array(), NULL);

//        if(! is_front_page()) {
//            wp_enqueue_style('maacuni-stylesheet', get_stylesheet_uri());
//        } else {
//        }
        wp_enqueue_style('style-css', get_template_directory_uri() . '/css/style.css', array(), NULL);


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // scripts
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        wp_enqueue_script('popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('inview', get_template_directory_uri() . '/js/jquery.inview.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), NULL, TRUE);
        wp_register_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), NULL, TRUE);
        wp_register_script('swiper', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'), NULL, TRUE);
        
        wp_register_script('vide', get_template_directory_uri() . '/js/jquery.vide.min.js', array('jquery'), NULL, TRUE);
        if (habib_option('news-feed-visibility', false, true)) :
            wp_enqueue_script('news-ticker', get_template_directory_uri() . '/js/jquery.news-ticker.min.js', array('jquery'), NULL, TRUE);
        endif;
        wp_enqueue_script( 'jquery-masonry' );
        wp_enqueue_script('highlight', get_template_directory_uri() . '/js/highlight.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('tt-sticky', get_template_directory_uri() . '/js/tt-sticky.js', array('jquery'), NULL, TRUE);

        if(! is_front_page()) {
            wp_enqueue_script('maacuni-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), NULL, TRUE);
        } else {
            wp_enqueue_script('maacuni-scripts', get_template_directory_uri() . '/js/scripts2.js', array('jquery'), NULL, TRUE);
        }


        wp_localize_script( 'maacuni-scripts', 'maacuniJSObject', apply_filters( 'habib_js_object', array(
            'ajaxurl'                => admin_url( 'admin-ajax.php' ),
            'is_front_page'          => is_front_page(),
            'habib_news_ticker'    => habib_option('news-feed-visibility', false, true),
		) ) );

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    add_action('wp_enqueue_scripts', 'habib_scripts');
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Support editor style
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-  

if (!function_exists('habib_editor_styles')) :
    function habib_editor_styles() {
        wp_enqueue_style('maacuni-google-fonts', habib_fonts_url(), array(), NULL);
        wp_enqueue_style( 'maacuni-editor-style', get_template_directory_uri() . '/css/editor-style.css');
    }
endif;
add_action( 'enqueue_block_editor_assets', 'habib_editor_styles', 999 );


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Custom template tags for this theme.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
require get_template_directory() . "/inc/template-tags.php";

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Custom functions that act independently of the theme templates.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
require get_template_directory() . "/inc/extras.php";


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Load Jetpack compatibility file.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
require get_template_directory() . "/inc/jetpack.php";