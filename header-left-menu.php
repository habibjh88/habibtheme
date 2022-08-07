<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;


$tt_menu_bg = $tt_menu_color = $tt_icon_color = $menu_bg = $menu_color = "";

if (function_exists('rwmb_meta')) :
    $menu_bg = rwmb_meta( 'habib_left_menu_bg' );
    $menu_color = rwmb_meta( 'habib_left_menu_color' );
endif;

if($menu_bg){
    $tt_menu_bg = "background-color:".$menu_bg.';';
}
if($menu_color){
    $tt_menu_color = "color:".$menu_color.';';
    $tt_icon_color = "background-color:".$menu_color.';';
}


?>
<div class="header-wrapper full-screen-menu menu-trigger-left" style="<?php echo esc_attr($tt_menu_bg) ?>">
    <nav class="navbar">
        <?php get_template_part('template-parts/site', 'logo' );?>

        <div class="menu-trigger d-flex justify-content-center">
            <div class="menu-text" style="<?php echo esc_attr($tt_menu_color) ?>">
                <?php esc_html_e('MENU', 'maacuni'); ?>
            </div>
            <div class="menu-action">
                <span style="<?php echo esc_attr($tt_icon_color) ?>"></span>
                <span style="<?php echo esc_attr($tt_icon_color) ?>"></span>
            </div>
        </div>

        <div class="nav-attr d-flex flex-row d-block d-lg-none">
            <div class="side-menu" style="<?php echo esc_attr($tt_menu_color) ?>"><a href="#"><i class="fas fa-bars"></i></a></div>
        </div>

        <?php get_template_part('template-parts/offcanvas', 'contents'); ?>
    </nav>
    <span class="menu-border" style="<?php echo esc_attr($tt_icon_color) ?>"></span>
</div> <!-- .header-wrapper -->


<div class="menu-wrapper d-none d-lg-block">
    <?php wp_nav_menu( apply_filters( 'habib_primary_wp_nav_menu', array(
        'container'      => false,
        'theme_location' => 'primary',
        'items_wrap'     => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
        'walker'         => new habib_Navwalker(),
        'fallback_cb'    => false
    ))); ?>
</div>