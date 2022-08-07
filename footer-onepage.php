<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; 

$has_copyright_color = "";

if(maacuni_option('footer-copyright-color')){
    $has_copyright_color = 'has-copyright-color';
}
?>

<footer class="footer-section footer-onepage-wrapper <?php echo esc_attr($has_copyright_color); ?>">
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onepage-footer-inner text-center">
                    <div class="footer-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            <img src="<?php echo esc_url(maacuni_option('footer-logo', 'url', get_template_directory_uri() . '/images/footer-logo.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
                        </a>
                    </div> <!-- .footer-logo -->
                    
                    <div class="footer-text">
                        <?php if(maacuni_option('footer-two-title')) : ?>
                            <h2><?php echo esc_html(maacuni_option('footer-two-title')); ?></h2>
                        <?php endif; ?>
                        
                        <?php echo wp_kses(maacuni_option('footer-two-text'), array(
                            'a'          => array(
                                'href'   => array(),
                                'title'  => array(),
                                'target' => array()
                            ),
                            'br'     => array(),
                            'em'     => array(),
                            'strong' => array(),
                            'ul'     => array(),
                            'li'     => array(),
                            'p'      => array(),
                            'span'   => array(
                                'class' => array()
                            )
                            ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .footer-logo-wrapper -->

    <div class="footer-copyright-wrap">
        <div class="container d-sm-flex">
            <div class="copyright flex-grow-1">
                <?php if (maacuni_option('footer-text', false, false)) :
                    echo wp_kses(maacuni_option('footer-text'), array(
                        'a'      => array(
                            'href'   => array(),
                            'title'  => array(),
                            'target' => array()
                        ),
                        'br'     => array(),
                        'em'     => array(),
                        'strong' => array(),
                        'ul'     => array(),
                        'li'     => array(),
                        'p'      => array(),
                        'span'   => array(
                            'class' => array()
                        )
                    ));
                    else : ?>
                    <span><?php printf(esc_html__('Designed by %1$s', 'maacuni'),
                            "<a href='#'>".esc_html__('Habib', 'maacuni')."</a>"); ?></span>
                <?php endif; ?>

                <?php if ( function_exists( 'the_privacy_policy_link' ) ) :
                    the_privacy_policy_link( '&nbsp|', '' );
                endif; ?>
            </div> <!-- .copyright -->

            <?php if (maacuni_option('social-icon-visibility')) : ?>
                <div class="social-links-wrap">
                    <?php get_template_part('template-parts/social', 'icons');?>
                </div> <!-- /social-links-wrap -->
            <?php endif; ?>

            <?php $copy_right_year = maacuni_option("footer-copyright-year"); ?>
            <p class="copyright-year"><?php echo esc_html($copy_right_year ? $copy_right_year : date('Y')) ?></p>
        </div> <!-- .container -->
    </div> <!-- .footer-copyright -->
</footer> <!-- .footer-section -->