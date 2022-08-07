<?php if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
    <?php wp_head(); ?>
</head>

<body id="home" <?php body_class(); ?> data-spy="scroll" data-target=".navbar" data-offset="100">


<div class="site-wrapper">

    <?php do_action('habib_before_site_wrapper'); ?>

    <div class="side-menu">
        <span class="side-menu-button d-block d-md-none">
            <i class="fas fa-times"></i>
        </span>
        <header class="menu-header text-center">
            <div class="author-imamge">
                <img src="<?php echo get_template_directory_uri(); ?>/images/habib.jpg" alt="">
            </div>

            <div class="intro mb-2 mt-1">
                <h4>Habibur Rahaman</h4>
                <span>Sr. WordPress Developer <br>
                At <a href="https://www.radiustheme.com/">RadiusTheme</a>
                </span>
            </div>

            <div class="social-icon">
                <a class="github" target="_blank" href="https://github.com/habibjh88"><i class="fab fa-github"></i></a>
                <a class="linkedin" target="_blank" href="https://www.linkedin.com/in/habibjh88"><i
                            class="fab fa-linkedin"></i></a>
                <a class="facebook" target="_blank" href="https://facebook.com/habibjh88"><i
                            class="fab fa-facebook"></i></a>
                <a class="twitter" target="_blank" href="https://twitter.com/habibjh88"><i
                            class="fab fa-twitter"></i></a>
                <a class="mail" target="_blank" href="mailto:habibjh.me@gmail.com"><i class="fas fa-envelope"></i></a>
            </div>

            <br><br>

            <div class="intro old-company">
            <span>
                Former Sr. WordPress Developer <br> at <a href="http://byteever.com/">ByteEver</a>
                <br>
                Former Sr. Web Developer <br> at <a href="https://trendytheme.net/">TrendyTheme</a>
                </span>
            </div>
        </header>

    </div>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header ">
                    <h2 class="brand-logo"><a href="<?php echo home_url('/'); ?>">Habib's portfolio</a></h2>
                    <div class="menu-trigger">
                        <span class=""></span>
                    </div>
                </div>
            </div>
        </div>
    </div>