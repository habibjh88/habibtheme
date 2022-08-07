<?php
/*
Front Page
*/

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header('two');

?>
    <div class="main-wrapper">
        <div class="container">

            <div class="row home-portfolio">

                <?php
                $args     = array(
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'posts_per_page' => - 1,

                );
                $wp_query = new WP_Query( $args );

                if ( $wp_query->have_posts() ) {
                    while ( $wp_query->have_posts() ) : $wp_query->the_post();

                        ?>
                        <div class="col-sm-6 mb-30">
                            <?php get_template_part( 'template-parts/content' ); ?>
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