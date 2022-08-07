<h1 class="navbar-brand">
    <a href="<?php echo esc_url(site_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
        
        <?php 

            $text_logo_color = $text_logo_fontsize = $text_logo_font_family = $text_logo_font_weight = $text_logo_line_height = "";
            $text_logo_typography = habib_option('text-logo-typography', false, false);


            if($text_logo_typography['color']){
                $text_logo_color = 'color: '.$text_logo_typography['color'].';';
            }
            if($text_logo_typography['font-size']){
                $text_logo_fontsize = 'font-size: '.$text_logo_typography['font-size'].';';
            }
            if($text_logo_typography['font-family']){
                $text_logo_font_family = 'font-family: '.$text_logo_typography['font-family'].';';
            }
            if($text_logo_typography['font-weight']){
                $text_logo_font_weight = 'font-weight: '.$text_logo_typography['font-weight'].';';
            }
            if($text_logo_typography['line-height']){
                $text_logo_line_height = 'line-height: '.$text_logo_typography['line-height'].';';
            }

            if (habib_option('logo-type', false, 'logo')) : 

                // site logo
                $fallback_logo = habib_option('logo', 'url', get_template_directory_uri() . '/images/logo.jpg');
                $fallback_retina_logo = get_template_directory_uri() . '/images/logo2x.png';

                $default_logo = habib_option('logo', 'url', $fallback_logo);
                $default_ratina_logo = habib_option('retina-logo', 'url', $fallback_retina_logo);

                // site logo
                $site_logo = $default_logo;
                $site_mobile_logo = $default_logo;


                // mobile logo option
                if (habib_option('mobile-logo')) :
                    $site_mobile_logo = habib_option('mobile-logo', 'url', $fallback_logo);
                endif;


                // site retina logo
                $site_retina_logo = $default_ratina_logo;
                $site_retina_mobile_logo = $default_ratina_logo;

                if (habib_option('retina-mobile-logo', 'url')) :
                    $site_retina_mobile_logo = habib_option('retina-mobile-logo', 'url', $fallback_retina_logo);
                endif;


                // site logo display
                if (function_exists('rwmb_meta') && rwmb_meta('habib_page_logo', 'type=image_advanced')) :
                    $page_logo = rwmb_meta('habib_page_logo', 'type=image_advanced');
                    foreach ($page_logo as $logo) : 
                        $img_src = wp_get_attachment_image_src( $logo['ID'], 'full'); ?>
                        <img class="site-logo d-none d-sm-block" src="<?php echo esc_url($img_src['0']) ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
                    <?php endforeach;
                else : ?>
                    <img class="site-logo d-none d-sm-block" src="<?php echo esc_url($site_logo) ?>" srcset="<?php echo esc_url($site_logo) ?> 1x, <?php echo esc_url($site_retina_logo) ?> 2x" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
                <?php endif;


                // mobile logo display
                if (function_exists('rwmb_meta') && rwmb_meta('habib_page_mobile_logo', 'type=image_advanced')) :
                    $page_mobile_logo = rwmb_meta('habib_page_mobile_logo', 'type=image_advanced');
                    foreach ($page_mobile_logo as $logo) : 
                        $img_src = wp_get_attachment_image_src( $logo['ID'], 'full'); ?>
                        <img class="mobile-logo d-block d-sm-none" src="<?php echo esc_url($img_src['0']) ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
                    <?php endforeach;
                else : ?>
                    <img class="mobile-logo d-block d-sm-none" src="<?php echo esc_url($site_mobile_logo) ?>" srcset="<?php echo esc_url($site_mobile_logo) ?> 1x, <?php echo esc_url($site_retina_mobile_logo) ?> 2x" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
                <?php endif;

            else : ?>
                <span class="text-logo" style="<?php echo esc_attr($text_logo_color .' '. $text_logo_fontsize .' '. $text_logo_font_family .' '. $text_logo_font_weight .' '. $text_logo_line_height) ?>">
                    <?php if (habib_option('text-logo')) : ?>
                        <?php echo esc_html(habib_option('text-logo')); ?>
                    <?php else : ?>
                        <?php echo esc_html(get_bloginfo('name')); ?>
                    <?php endif; ?>
                </span><?php 
            endif; 
        ?>
    </a>
</h1>