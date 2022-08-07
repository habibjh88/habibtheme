<?php
add_action('wp_ajax_nopriv_maacuni_portfolio_ajax', 'maacuni_more_post_ajax');
add_action('wp_ajax_maacuni_portfolio_ajax', 'maacuni_more_post_ajax');
 
if (!function_exists('maacuni_more_post_ajax')) {
    function maacuni_more_post_ajax(){

        $ppp = (isset($_POST['perpage'])) ? $_POST['perpage'] : 3;
        $offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
        $taxonomies = (isset($_POST['taxonomies'])) ? $_POST['taxonomies'] : '';
        $font_color = (isset($_POST['font_color'])) ? $_POST['font_color'] : '';
        $portfolio_overlay = (isset($_POST['portfolio_overlay'])) ? $_POST['portfolio_overlay'] : '';
        $link_btn_color = (isset($_POST['link_btn_color'])) ? $_POST['link_btn_color'] : '';
        $portfolio_layout = (isset($_POST['portfolio_layout'])) ? $_POST['portfolio_layout'] : '';
        $grid_column = (isset($_POST['grid_column'])) ? $_POST['grid_column'] : 4;
        $layout_style = (isset($_POST['layout_style'])) ? $_POST['layout_style'] : '';
        $filter_visibility = (isset($_POST['filter_visibility'])) ? $_POST['filter_visibility'] : '';
        $filter_text = (isset($_POST['filter_text'])) ? $_POST['filter_text'] : '';
        $content_limit = (isset($_POST['content_limit'])) ? $_POST['content_limit'] : 7;
        $spacing = (isset($_POST['spacing'])) ? $_POST['spacing'] : '';
        $thumb_size = (isset($_POST['thumb_size'])) ? $_POST['thumb_size'] : 'maacuni-thumbnail-portrait';
        $animation_bg_opt = (isset($_POST['animation_bg_opt'])) ? $_POST['animation_bg_opt'] : '';
        $animation_bg = (isset($_POST['animation_bg'])) ? $_POST['animation_bg'] : '';
        $title_border = (isset($_POST['title_border'])) ? $_POST['title_border'] : '';
        $description_show_hide = (isset($_POST['description_show_hide'])) ? $_POST['description_show_hide'] : '';
        $title_show_hide = (isset($_POST['title_show_hide'])) ? $_POST['title_show_hide'] : '';
        $single_show_hide = (isset($_POST['single_show_hide'])) ? $_POST['single_show_hide'] : '';
        $category_show_hide = (isset($_POST['category_show_hide'])) ? $_POST['category_show_hide'] : '';
        $link_show_hide = (isset($_POST['link_show_hide'])) ? $_POST['link_show_hide'] : '';

        
        $args = array(
            'post_type'      => 'tt-portfolio',
            'post_status'    => 'publish',
            'posts_per_page' => $ppp,
            'offset'         => $offset
        );

        if (!empty($taxonomies)) :
            $args = wp_parse_args(
                array(
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'tt-portfolio-cat',
                            'field'    => 'term_id',
                            'terms'    => explode(',', $taxonomies)
                        )
                    )
                )
            , $args );
        endif;
 
        $loop = new WP_Query($args);
        $portfolio_overlay_bg = $tt_font_color = $portfolio_inner_bg = "";

        if($portfolio_overlay){
            $portfolio_overlay_bg = 'background-color:'.$portfolio_overlay.';';
        }

        if($portfolio_overlay && $portfolio_layout == 'left-right'){
            $portfolio_inner_bg = 'background-color:'.$portfolio_overlay.';';
        }
        if($font_color){
            $tt_font_color = 'color:'.$font_color.';';
        }
        
        if($link_btn_color){
            $link_btn_color = 'color:'.$link_btn_color.'; border-color:'.$link_btn_color.';';
        }

        if ($loop -> have_posts()) :
            $portfolio_count = 1;
            while ($loop -> have_posts()) : $loop -> the_post(); 

                $terms = wp_get_post_terms( get_the_ID(), 'tt-portfolio-cat' );
                $term = array();

                if (! empty( $terms ) && ! is_wp_error( $terms )) :
                    foreach ( $terms as $t ) :
                        $term[ ] = $t->slug;
                    endforeach;
                endif;
             
                $default_layout_size = "";
                if('default-size' == $layout_style){
                    $thumb_size = 'maacuni-thumbnail-portrait';
                    if (1 == $portfolio_count % 4) {
                        $default_layout_size = "item-1";
                    } elseif(2 == $portfolio_count % 4){
                        $default_layout_size = "item-2";
                    } elseif(3 == $portfolio_count % 4){
                        $default_layout_size = "item-3";
                    } elseif(0 == $portfolio_count % 4){
                        $default_layout_size = "item-4";
                    }
                } ?>
                <div class="portfolio-item <?php echo esc_attr('different-size' != $layout_style ? 'tt-item' : '') ?>  col-lg-<?php echo esc_attr($grid_column .' '.implode( ' ', $term ).' '.$default_layout_size);?> col-md-6 col-xs-12">
                    <div class="portfolio-inner text-center">
                    
                        <div class="portfolio-thumb clearfix">
                            <?php the_post_thumbnail($thumb_size, array('alt' => get_the_title(), 'class' => 'img-fluid')); ?>

                            <?php if($portfolio_layout != 'left-right') : ?>
                                <div class="portfolio-overlay" style="<?php echo esc_attr($portfolio_overlay_bg) ?>">
                                    
                                    <?php if($link_show_hide == 'show' && $portfolio_layout == 'title-bottom') : ?>
                                        <div class="portfolio-links">
                                            <?php
                                                $tt_attachment_id = get_post_thumbnail_id(get_the_ID());
                                                $tt_image_attr = wp_get_attachment_image_src($tt_attachment_id, 'full' );
                                            ?>
                                                <a class="image-link" href="<?php echo esc_url($tt_image_attr[0]); ?>">
                                                    <i class="fas fa-search-plus" style="<?php echo esc_attr($link_btn_color) ?>"></i>
                                                </a>
                                                <a class="portfolio-link" href="<?php the_permalink(); ?>">
                                                    <i class="fas fa-link" style="<?php echo esc_attr($link_btn_color) ?>"></i>
                                                </a>                         
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="portfolio-inner-content" style="<?php echo esc_attr($tt_font_color.' '.$portfolio_inner_bg) ?>">
                            
                            <?php if ($title_show_hide == 'show'): ?>
                                <h2 class="<?php echo esc_attr($title_border) ?>">
                                    <?php if ($single_show_hide == 'enable'): ?>
                                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                    <?php else:
                                        the_title();
                                    endif; ?>
                                </h2>
                            <?php endif; ?>

                            <?php if($description_show_hide == 'show') : ?>
                                <p>
                                    <?php 
                                        $trim_word = $content_limit;
                                        $portfolio_info = get_post_meta(get_the_ID(), 'maacuni_portfolio_info', false);
                                        echo wp_trim_words( implode(' ', $portfolio_info) , $trim_word, '');
                                    ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if($category_show_hide == 'show') : ?>
                                <div class="portfolio-cat">
                                    <?php tt_get_custom_taxonomy('tt-portfolio-cat') ?>
                                </div>
                            <?php endif; ?>
                        
                            <?php if($link_show_hide == 'show' && ($portfolio_layout != 'title-bottom' && $portfolio_layout != 'left-right')) : ?>
                                <div class="portfolio-links">
                                    <?php
                                        $tt_attachment_id = get_post_thumbnail_id(get_the_ID());
                                        $tt_image_attr = wp_get_attachment_image_src($tt_attachment_id, 'full' );
                                    ?>
                                    <a class="image-link" href="<?php echo esc_url($tt_image_attr[0]); ?>">
                                        <i class="fas fa-search-plus" style="<?php echo esc_attr($link_btn_color) ?>"></i>
                                    </a>
                                    <a class="portfolio-link" href="<?php the_permalink(); ?>">
                                        <i class="fas fa-link" style="<?php echo esc_attr($link_btn_color) ?>"></i>
                                    </a> 
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <?php $portfolio_count++; ?>
 
            <?php endwhile;
        endif;
 
        wp_reset_postdata();

        die();
    }
}