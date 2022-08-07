<?php
/*
Front Page
*/

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

get_header('two');

?>
    <div class="main-wrapper">
        <div class="container">

            <div class="row">
                <div class="header2-main-menu">

                    <?php wp_nav_menu(apply_filters('habib_primary_wp_nav_menu', array(
                        'container' => false,
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
                        'walker' => new habib_Navwalker(),
                        'fallback_cb' => false
                    ))); ?>

                </div>
            </div>

            <div class="row justify-content-center home-portfolio">

                <?php
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,

                );
                $wp_query = new WP_Query($args);

                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-30">
                            <?php get_template_part('template-parts/content'); ?>
                        </div>
                    <?php
                    endwhile;
                }
                ?>
            </div>
        </div>
    </div>
<?php

get_footer('two'); 