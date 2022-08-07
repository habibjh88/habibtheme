<?php

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Single blog post navigation
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_post_navigation')) :

    function habib_post_navigation() {

        $prev_post = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next_post = get_adjacent_post(false, '', false);

        if (!$next_post && !$prev_post) :
            return;
        endif;
        ?>
        <?php do_action('habib_before_single_post_navigation' );?>
        <nav class="single-post-navigation clearfix" role="navigation">
            <div class="row">
                <?php if ($prev_post): ?>
                    <!-- Previous Post -->
                    <div class="col-md-6 col-xs-12">
                        <div class="previous-post-link">
                            <?php previous_post_link('<div class="previous">%link</div>', '<i class="fa fa-angle-left"></i>' . esc_html__( 'Previous', 'habib' )); ?>

                            <h3 class="entry-title">
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php echo wp_kses( get_the_title( $prev_post->ID ), array() ); ?></a>
                            </h3>
                        </div>
                    </div>
                <?php endif ?>
                
                <?php if ($next_post): ?>
                    <!-- Next Post -->
                    <div class="col-md-6 col-xs-12 pull-right">
                        <div class="next-post-link">
                            <?php next_post_link('<div class="next">%link</div>', esc_html__( 'Next', 'habib' ) . '<i class="fas fa-angle-right"></i>'); ?>

                            <h3 class="entry-title">
                                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo wp_kses( get_the_title( $next_post->ID ), array() ); ?></a>
                            </h3>
                        </div>
                    </div>
                <?php endif ?>
            </div> <!-- .row -->
        </nav> <!-- .single-post-navigation -->
        <?php do_action('habib_after_single_post_navigation' );?>
    <?php
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Blog posts navigation
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_posts_navigation')) :

    function habib_posts_navigation() { ?>
        <div class="blog-navigation clearfix">
            <?php if (get_next_posts_link()) : ?>
                <div class="col-xs-6 pull-left">
                    <div class="previous-page">
                        <?php next_posts_link('<i class="fas fa-long-arrow-alt-left"></i>' . esc_html__('Older Posts', 'habib')); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (get_previous_posts_link()) : ?>
                <div class="col-xs-6 pull-right">
                    <div class="next-page">
                        <?php previous_posts_link(esc_html__('Newer Posts', 'habib') . '<i class="fas fa-long-arrow-alt-right"></i>'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Blog posts pagination for default blog layout
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_posts_pagination')) :
    function habib_posts_pagination() { 
        global $wp_query;
            if ($wp_query->max_num_pages > 1) {
                $big = 999999999; // need an unlikely integer
                $items = paginate_links(array(
                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format'    => '?paged=%#%',
                    'prev_next' => true,
                    'current'   => max(1, get_query_var('paged')),
                    'total'     => $wp_query->max_num_pages,
                    'type'      => 'array',
                    'prev_text' => esc_html__('Prev.', 'habib'),
                    'next_text' => esc_html__('Next', 'habib')
                ));

                $pagination = "<ul class=\"pagination\">\n\t<li>";
                $pagination .= join("</li>\n\t<li>", $items);
                $pagination .= "</li>\n</ul>\n";

                return $pagination;
            } 
        return;
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  TT pagination
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if ( ! function_exists( 'habib_posts_pagination' ) ):
    function habib_posts_pagination($wp_query = FALSE) {

        global $wp_rewrite;
        if (!$wp_query) {
            global $wp_query;
        }

        $qobj = get_queried_object();

        $wp_query->query_vars[ 'paged' ] > 1 ? $current = $wp_query->query_vars[ 'paged' ] : $current = 1;

        $pagination = array(
            'base'      => add_query_arg('page', '%#%'),
            'format'    => '',
            'total'     => $wp_query->max_num_pages,
            'current'   => $current,
            //'show_all'  => TRUE,
            'prev_next' => TRUE,
            'type'      => 'array',
            'prev_text' => esc_html__('Prev', 'habib'),
            'next_text' => esc_html__('Next', 'habib')
        );

        if (!empty($wp_query->query_vars[ 's' ])) $pagination[ 'add_args' ] = array('s' => get_query_var('s'));
        $paginate = paginate_links($pagination);

        if (!is_null($paginate)) {
            $pagination = "<ul class=\"pagination\">\n\t<li>";
            $pagination .= join("</li>\n\t<li>", $paginate);
            $pagination .= "</li>\n</ul>\n";
            return $pagination;
        }
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Blog list style posts pagination
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if ( ! function_exists( 'habib_list_posts_pagination' ) ):

    function habib_list_posts_pagination() {
        global $query;
        if ($query->max_num_pages > 1) :
            $big   = 999999999; // need an unlikely integer
            $items = paginate_links(array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'prev_next' => TRUE,
                'current'   => max( 1, get_query_var( 'paged' ) ),
                'total'     => $query->max_num_pages,
                'type'      => 'array',
                'prev_text' => esc_html__( 'Prev.', 'habib' ),
                'next_text' => esc_html__( 'Next', 'habib' )
            ) );

            $pagination = '<ul class="pagination"><li>';
            $pagination .= join( "</li><li>", (array) $items );
            $pagination .= "</li></ul>";

            return $pagination;
        endif;

        return;
    }

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Prints HTML with meta information for the current post-date/time, author & others.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_post_meta')) :
    function habib_post_meta() { ?>
        <ul class="list-inline">
            <?php if ( habib_option( 'tt-post-meta', 'post-author', false ) && ! is_sticky()) : ?>
                <li>
                    <span class="author vcard">
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                            <?php if ( habib_option( 'tt-post-meta', 'author-img', false ) ) {
                                echo get_avatar( get_the_author_meta( 'user_email' ), 35 ); 
                            } 
                            echo esc_html(get_the_author());
                            ?>
                        </a>
                    </span>
                </li>
            <?php endif; ?>
         
            <?php if ( habib_option( 'tt-post-meta', 'post-category', TRUE ) ) : ?>
                <li>
                    <span class="posted-in">
                        <?php echo get_the_category_list(esc_html_x(', ', 'Used between list items, there is a space after the comma.', 'habib'));
                        ?>
                    </span>
                </li>
            <?php endif; ?>

            <?php if ( habib_option( 'tt-post-meta', 'post-date', TRUE ) ) : ?>
                <li>
                    <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a>
                </li>
            <?php endif; ?>
            
            <?php if ( habib_option( 'tt-post-meta', 'post-comment', TRUE ) ) : ?>
                <li>
                    <span class="post-comments-number">
                        <?php
                        comments_popup_link(
                            esc_html__('No Comment', 'habib'),
                            esc_html__('1 Comment', 'habib'),
                            esc_html__('% Comments', 'habib'), '',
                            esc_html__('Comments are Closed', 'habib')
                        ); ?>
                    </span>
                </li>
            <?php endif; ?>
            
            <?php if (function_exists('zilla_likes')) : 
                if ( habib_option( 'tt-post-meta', 'post-like', FALSE ) ) : ?>
                    <li>
                        <span class="likes">
                            <?php zilla_likes(); ?>
                        </span>
                    </li>
                <?php endif;
            endif; ?>

            <?php echo edit_post_link(esc_html__('Edit Post', 'habib'), '<li class="edit-link">', '</li>') ?>
            
        </ul>
    <?php
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Returns true if a blog has more than 1 category.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_categorized_blog')) :
    
    function habib_categorized_blog() {
        if (false === ($all_the_cool_cats = get_transient('habib_categories'))) :
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'fields'     => 'ids',
                'hide_empty' => 1,

                // We only need to know if there is more than one category.
                'number'     => 2,
            ));

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);

            set_transient('habib_categories', $all_the_cool_cats);
        endif;

        if ($all_the_cool_cats > 1) :
            // This blog has more than 1 category so habib_categorized_blog should return true.
            return true;
        else :
            // This blog has only 1 category so habib_categorized_blog should return false.
            return false;
        endif;
    }

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Breadcrumb
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_breadcrumbs')) :

    function habib_breadcrumbs(){ ?>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo esc_url(site_url()); ?>"><?php esc_html_e('Home', 'habib') ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if( is_tag() ) { ?>
                    <?php esc_html_e('Posts Tagged ', 'habib') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                    <?php } elseif (is_day()) { ?>
                    <?php esc_html_e('Posts made in', 'habib') ?> <?php echo esc_html(get_the_time('F jS, Y')); ?>
                    <?php } elseif (is_month()) { ?>
                    <?php esc_html_e('Posts made in', 'habib') ?> <?php echo esc_html(get_the_time('F, Y')); ?>
                    <?php } elseif (is_year()) { ?>
                    <?php esc_html_e('Posts made in', 'habib') ?> <?php echo esc_html(get_the_time('Y')); ?>
                    <?php } elseif (is_search()) { ?>
                    <?php esc_html_e('Search results for', 'habib') ?> <?php the_search_query() ?>
                    <?php } elseif (is_404()) { ?>
                    <?php esc_html_e('404', 'habib') ?>
                    <?php } elseif (is_single()) { ?>
                    <?php $category = get_the_category();
                    if ( $category ) { 
                        $catlink = get_category_link( $category[0]->cat_ID );
                        echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo"> /</span> ');
                    }
                    echo get_the_title(); ?>
                    <?php } elseif (is_category()) { ?>
                    <?php single_cat_title(); ?>
                    <?php } elseif (is_tax()) { ?>
                    <?php 
                    $tt_taxonomy_links = array();
                    $tt_term = get_queried_object();
                    $tt_term_parent_id = $tt_term->parent;
                    $tt_term_taxonomy = $tt_term->taxonomy;

                    while ( $tt_term_parent_id ) {
                        $tt_current_term = get_term( $tt_term_parent_id, $tt_term_taxonomy );
                        $tt_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $tt_current_term, $tt_term_taxonomy ) ) . '" title="' . esc_attr( $tt_current_term->name ) . '">' . esc_html( $tt_current_term->name ) . '</a>';
                        $tt_term_parent_id = $tt_current_term->parent;
                    }

                    if ( !empty( $tt_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $tt_taxonomy_links ) ) . ' <span class="raquo">/</span> ';

                    echo esc_html( $tt_term->name ); 
                    } elseif (is_author()) { 
                        global $wp_query;
                        $curauth = $wp_query->get_queried_object();

                        esc_html_e('Posts by: ', 'habib'); echo ' ', esc_html($curauth->nickname);

                    } elseif (is_page()) { 
                        echo get_the_title(); 
                    } elseif (is_home()) { 
                        esc_html_e('Blog', 'habib');
                    } elseif (class_exists('WooCommerce') and (is_shop())){
                        esc_html_e('Shop', 'habib');
                    } ?>  
                </li>
            </ul>
        </nav>
    <?php
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Page header section background title
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_page_header_section_title')) :
    function habib_page_header_section_title() {
        $tt_query = get_queried_object();

        if (is_archive()) :
            if (is_day()) :
                $archive_title = get_the_time('d F, Y');
                $page_header_title = sprintf(esc_html__('Archive of: %s', 'habib'), $archive_title);
            elseif (is_month()) :
                $archive_title = get_the_time('F Y');
                $page_header_title = sprintf(esc_html__('Archive of: %s', 'habib'), $archive_title);
            elseif (is_year()) :
                $archive_title = get_the_time('Y');
                $page_header_title = sprintf(esc_html__('Archive of: %s', 'habib'), $archive_title);
            endif;
        endif;

        if (is_404()) :
            $page_header_title = esc_html__('404 Not Found', 'habib');
        endif;

        if (is_search()) :
            $page_header_title = sprintf(esc_html__('Search result for: "%s"', 'habib'), get_search_query());
        endif;

        if (is_category()) :
            $page_header_title = sprintf(esc_html__('Category: %s', 'habib'), $tt_query->name);
        endif;

        if (is_tag()) :
            $page_header_title = sprintf(esc_html__('Tag: %s', 'habib'), $tt_query->name);
        endif;

        if (is_author()) :
            $page_header_title = sprintf(esc_html__('Posts of: %s', 'habib'), $tt_query->display_name);
        endif;

        if (is_tax()) {
            $page_header_title = sprintf(esc_html__('Taxonomy: %s', 'habib'), $tt_query->name);
        }

        if (is_page()) :
            $page_header_title = $tt_query->post_title;
        endif;

        if (is_home() or is_single()) :
            $page_header_title = habib_option('blog-title');
        endif;

        if (is_single()) :
            $page_header_title = get_the_title();
        endif;

        if (is_singular()) :
            $page_header_title = get_the_title();
        endif;

        if ( is_post_type_archive( ) ) {
            $page_header_title = post_type_archive_title( '', false);
        }

        if ( is_post_type_archive( 'product' ) ) {
            $page_header_title = post_type_archive_title( '', false);
        }

        if ( class_exists( 'WooCommerce' ) ) {
            if ( is_product_category() ) {
                $page_header_title = sprintf( esc_html__( 'Category: %s', 'habib' ), $tt_query->name );
            }

            if ( is_product_tag() ) {
                $page_header_title = sprintf( esc_html__( 'Tag: %s', 'habib' ), $tt_query->name );
            }
        }

        $page_header_title = apply_filters('habib_page_header_section_title', $page_header_title, $page_header_title);

        if (empty($page_header_title)) :
            $page_header_title = get_bloginfo('name');
        endif;

        return $page_header_title;
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Page header section background image
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_page_header_background')) :

    function habib_page_header_background() {
        $tt_query = get_queried_object();

        $page_header_image = false;

        if (is_archive()) :
            $page_header_image = habib_option('archive-header-image', 'url');
        endif;

        if (is_404()) :
            $page_header_image = habib_option('header-404-image', 'url');
        endif;

        if (is_search()) :
            $page_header_image = habib_option('search-header-image', 'url');
        endif;

        if (is_category()) :
            $page_header_image = habib_option('category-header-image', 'url');
        endif;

        if (is_tag()) :
            $page_header_image = habib_option('tag-header-image', 'url');
        endif;

        if (is_author()) :
            $page_header_image = habib_option('author-header-image', 'url');
        endif;

        if (is_page()) :
            
            $page_header_image = habib_option('page-header-image', 'url');
            
            if (function_exists('rwmb_meta')) :
                $single_image = rwmb_meta('habib_page_header_image', 'type=image_advanced');
            endif;

            if (!empty($single_image)) {
                foreach ($single_image as $image) {
                    $page_header_image = $image['full_url'];
                }
            }

        endif;

        if (is_single()) :

            $page_header_image = habib_option('blog-header-image', 'url');
            
            if (function_exists('rwmb_meta')) :
                $single_image = rwmb_meta('habib_page_header_image', 'type=image_advanced');
            endif;

            if (!empty($single_image)) {
                foreach ($single_image as $image) {
                    $page_header_image = $image['full_url'];
                }
            }

        endif;

        if (empty ($single_image)) :
            if (is_singular('product')) :
                $page_header_image = habib_option('product-header-image', 'url');
            endif;
            if (is_singular('tt-portfolio')) :
                $page_header_image = habib_option('portfolio-header-image', 'url');
            endif;
        endif;

        if ( class_exists( 'WooCommerce' ) ) {
            if ( is_product_category() || is_product_tag() || is_post_type_archive( 'product' )) {
                $page_header_image = habib_option('product-header-image', 'url');
            }
        }

        if (is_home()) :
            $page_header_image = habib_option('blog-header-image', 'url');
        endif;

        if (!$page_header_image) :
            $page_header_image = habib_option('blog-header-image', 'url');
        endif;

        $image_src = apply_filters('habib_page_header_background', $page_header_image, $page_header_image);

        return $image_src;
        
    }

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Comments list
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists("habib_comments_list")) :

    function habib_comments_list($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) {
            // Display trackbacks differently than normal comments.
            case 'pingback' :
            case 'trackback' :
                ?>

                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php esc_html_e('Pingback:', 'habib'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('(Edit)', 'habib'), '<span class="edit-link">', '</span>'); ?></p>

                <?php
                break;

            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment">
                    <div class="comment-author clearfix">
                        <?php
                            $get_avatar = get_avatar($comment, apply_filters('habib_post_comment_avatar_size', 48));
                            $avatar_img = habib_get_avatar_url($get_avatar);
                            //Comment author avatar
                        ?>
                        <img class="avatar" src="<?php echo esc_url($avatar_img); ?>" alt="<?php echo esc_attr(get_comment_author()); ?>">

                        <div class="comment-meta media-heading">
                            <h4>
                                <span class="author-name">
                                    <?php esc_html_e('By', 'habib'); ?>
                                    <strong><?php echo esc_html(get_comment_author()); ?></strong>
                                </span>
                                <time datetime="<?php echo get_comment_date('Y-m-d'); ?>">
                                    <?php echo get_comment_date(); ?> <?php echo get_comment_time(); ?>
                                    <?php edit_comment_link(esc_html__('Edit', 'habib'), '<small class="edit-link">', '</small>'); //edit link
                                    ?>
                                </time>
                            </h4>
                        </div> <!-- .comment-meta -->
                    </div> <!-- .comment-author -->

                    <div class="media-body">
                        <?php if ('0' == $comment->comment_approved) { ?>
                            <div class="alert alert-info">
                                <?php esc_html_e('Your comment is awaiting moderation.', 'habib'); ?>
                            </div>
                        <?php } ?>

                        <div class="comment-content">
                            <?php comment_text(); //Comment text
                            ?>
                        </div><!-- .comment-content -->

                        <span class="reply">
                            <?php comment_reply_link(array_merge($args, array(
                                'reply_text' => esc_html__('Reply', 'habib'),
                                'depth'      => $depth,
                                'max_depth'  => $args[ 'max_depth' ]
                            ))); ?>
                        </span><!-- .reply -->
                    </div>
                    <!-- .media-body -->
                </div> <!-- #comment-## -->
                <?php
                break;
        } // end comment_type check
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Fetching Avatar URL
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_get_avatar_url')) :
    function habib_get_avatar_url($get_avatar) {
        preg_match("/src='(.*?)'/i", $get_avatar, $matches);

        return $matches[ 1 ];
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Post thumbnail alt text
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (! function_exists( 'habib_alt_text' )) :
    function habib_alt_text(){
        $id = get_the_ID();
        $thumbnail_id = get_post_thumbnail_id($id);

        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

        if ($alt) :
            return $alt;
        else :
            return get_the_title();
        endif;
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Associative array to html attribute conversion
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_array2attr')) :
    function habib_array2attr($attr, $filter = '') {
        $attr = wp_parse_args($attr, array());
        if ($filter) {
            $attr = apply_filters($filter, $attr);
        }
        $html = '';
        foreach ($attr as $name => $value) {
            $html .= " $name=" . '"' . $value . '"';
        }

        return $html;
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Hex to RGB color
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_hex2rgb')) :
    
    function habib_hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);

       return $rgb[0].','.$rgb[1].','.$rgb[2];
    }

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// color modify for darken/lighten
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (!function_exists('habib_modify_color')) :
    
    function habib_modify_color( $hex, $steps ) {
        $steps = max( -255, min( 255, $steps ) );
        // Format the hex color string
        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 3 ) {
            $hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex,1,1 ), 2 ).str_repeat( substr( $hex,2,1 ), 2 );
        }
        // Get decimal values
        $r = hexdec( substr( $hex,0,2 ) );
        $g = hexdec( substr( $hex,2,2 ) );
        $b = hexdec( substr( $hex,4,2 ) );
        // Adjust number of steps and keep it inside 0 to 255
        $r = max( 0,min( 255,$r + $steps ) );
        $g = max( 0,min( 255,$g + $steps ) );  
        $b = max( 0,min( 255,$b + $steps ) );
        $r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
        $g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
        $b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );
        return '#'.$r_hex.$g_hex.$b_hex;
    }

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Get post category
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('habib_post_category_list')) :

    function habib_post_category_list() {
        $categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC'
        ) );
     
        foreach( $categories as $category ) {
            echo sprintf( 
                '<a href="%1$s">%2$s</a>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_html( $category->name )
            );
        } 
    }

endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Get Custom Taxonomy
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('tt_get_custom_taxonomy')) :
    function tt_get_custom_taxonomy($cat){
        $tt_cat = wp_get_post_terms(get_the_ID(), $cat);
        if ( $tt_cat && ! is_wp_error( $tt_cat ) ) : 
            $count = count($tt_cat);
            $increament = 0;
            foreach ($tt_cat as $term) :
                $increament++; ?>
                    <a class="links" href="<?php echo esc_url(get_term_link($term, $cat)) ?>">
                        <?php echo esc_html($term -> name); ?>
                    </a>
                <?php 
            endforeach;
        endif;
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Blog Image Croping 
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('habib_blog_thumb_size')) :
    function habib_blog_thumb_size(){
        global $habib_count_stickies;
        global $template;
        global $habib_blog_post_count;
        $template_base = basename($template);
        $blog_column = habib_option('blog-column', false, 1);
        $blog_sidebar = habib_option('blog-sidebar', false, 'right-sidebar');


        if (($blog_sidebar == 'no-sidebar' || !is_active_sidebar('habib-blog-sidebar')) && ! is_archive()) {
            if( (is_sticky() && $habib_blog_post_count == 1) ) {
                $blog_thumbnail = 'habib-thumbnail-portrait';
            } elseif (is_single() || $blog_column == 1) {
                $blog_thumbnail = 'habib-thumbnail-large';
            } elseif($blog_column == 2 ){
                $blog_thumbnail = 'habib-thumbnail-medium';
            } else{
                $blog_thumbnail = 'habib-thumbnail';
            }
        } else {
            if( (is_sticky() && $habib_blog_post_count == 1) || ($blog_column == 1 && $template_base != 'blog-grid-left-sidebar.php' && $template_base != 'blog-grid-right-sidebar.php' && $template_base != 'blog-sticky.php' && ! is_single()) || is_single()) {
                $blog_thumbnail = 'habib-thumbnail-large';
            } else if(is_archive()) {
                $blog_thumbnail = 'habib-thumbnail-large';
            } else{
                $blog_thumbnail = 'habib-thumbnail';
            }
        }

        if($template_base == 'blog-left-sidebar.php' || $template_base == 'blog-right-sidebar.php'){
            $blog_thumbnail = 'habib-thumbnail-large';
        }

        return $blog_thumbnail;
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Shortens a number and attaches K, M, B, etc. accordingly
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (! function_exists('habib_number_shorten')) {
    function habib_number_shorten($number, $precision = 3, $divisors = null) {
        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => esc_html__('K', 'habib'), // Thousand
                pow(1000, 2) => esc_html__('M', 'habib'), // Million
                pow(1000, 3) => esc_html__('B', 'habib'), // Billion
                pow(1000, 4) => esc_html__('T', 'habib'), // Trillion
                pow(1000, 5) => esc_html__('Qa', 'habib'), // Quadrillion
                pow(1000, 6) => esc_html__('Qi', 'habib') // Quintillion
            );
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return number_format($number / $divisor, $precision) . $shorthand;
    }
}