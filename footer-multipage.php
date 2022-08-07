<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; ?>

<footer class="footer-section footer-multi-wrapper">
   
    <?php if (is_active_sidebar('maacuni-footer-sidebar' ) ): ?>
        <div class="footer-widget-wrapper">
            <div class="container">
                <div class="row tt-sidebar-wrapper footer-sidebar" role="complementary">
                    <?php dynamic_sidebar('maacuni-footer-sidebar' );?>
                </div>
            </div> <!-- .container -->
        </div>
    <?php endif; ?>

    <div class="footer-copyright-wrap <?php echo esc_attr(maacuni_option('social-icon-visibility') == true ? '' : 'text-center');?>">
        <div class="container d-lg-flex">
            <div class="copyright flex-grow-1">
                        <p>Developed by Habib</p>
                       
            </div> <!-- .copyright -->

            <?php if (maacuni_option('social-icon-visibility')) : ?>
                <div class="social-links-wrap text-right">
                    <?php get_template_part('template-parts/social', 'icons');?>
                </div> <!-- /social-links-wrap -->
            <?php endif; ?>

        </div> <!-- .container -->
    </div> <!-- .footer-copyright -->
</footer> <!-- .footer-section -->