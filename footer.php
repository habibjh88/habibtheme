<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; ?>


            <?php
                $tt_footer_style = maacuni_option('footer-style', false, 'footer-multipage');

                $page_footer = $footer_font_color = "";
                if (function_exists('rwmb_meta')) : 
                    $page_footer = rwmb_meta('maacuni_footer_style');
                    $footer_font_color = rwmb_meta('maacuni_footer_font_color');
                endif; ?>

                <?php if('inherit' != $footer_font_color) : ?>
                    <div class="tt-footer <?php echo esc_attr($footer_font_color) ?>">
                <?php endif; ?>

                    <?php 
                        if(!is_404()) :
                            if ($page_footer == 'inherit-theme-option' || empty($page_footer)) :
                                if ($tt_footer_style == 'footer-onepage') :
                                    get_footer('onepage');
                                elseif ($tt_footer_style == 'footer-copyright') :
                                    get_footer('copyright');
                                elseif ($tt_footer_style == 'no-footer') :
                                else :
                                    get_footer('multipage');
                                endif;
                            elseif($page_footer == 'footer-onepage') :
                                get_footer('onepage'); 
                            elseif ($page_footer == 'footer-copyright') :
                                get_footer('copyright');
                            elseif($page_footer == 'no-footer') :
                            else :
                                get_footer('multipage');
                            endif; 
                        endif; 
                    ?>

                <?php if('inherit' != $footer_font_color) : ?>
                    </div>
                <?php endif; ?>

                <?php do_action('maacuni_after_site_wrapper'); ?>

            </div> <!-- .site-wrapper -->
        <?php wp_footer(); ?>
    </body>
</html>