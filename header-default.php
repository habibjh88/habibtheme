<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;
?>

<div class="header-wrapper standard-menu navbar-fixed-top">
    
    <?php get_template_part('template-parts/header', 'top'); ?>

    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <?php get_template_part('template-parts/site', 'logo' );?>


            <?php $menu_alignment = maacuni_option('menu-alignment', false, 'justify-content-end'); ?>

            <div class="collapse navbar-collapse <?php echo esc_attr($menu_alignment); ?>">
                
                <?php wp_nav_menu( apply_filters( 'maacuni_primary_wp_nav_menu', array(
                    'container'      => false,
                    'theme_location' => 'primary',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
                    'walker'         => new Maacuni_Navwalker(),
                    'fallback_cb'    => false
                ))); ?>

            </div>

            <div class="nav-attr d-flex flex-row align-items-center">
                <?php get_template_part('template-parts/header', 'cart' );?>

                <?php if (maacuni_option('search-visibility')): ?>
                    <div class="header-search">
                        <a href="#">
                            <i class="fas fa-search search-open"></i>
                            <i class="fas fa-times search-close"></i>
                        </a>
                    </div>
                <?php endif; ?>
                
                <?php if (maacuni_option('offcanvas-visibility', false, false)): ?>
                    <div class="side-menu"><a href="#"><i class="fas fa-bars"></i></a></div>
                <?php else : ?>
                    <div class="side-menu d-block d-lg-none"><a href="#"><i class="fas fa-bars"></i></a></div>
                <?php endif; ?>
            </div>
            
        </div>

        <?php get_template_part('template-parts/offcanvas', 'contents'); ?>
    </nav>

    <?php if (maacuni_option('search-visibility')): ?>
        <?php get_template_part('template-parts/header', 'search'); ?>
    <?php endif; ?>

</div> <!-- .header-wrapper -->