<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

$shop_sidebar = maacuni_option('shop-sidebar', false, 'right-sidebar');

if ( $shop_sidebar == 'right-sidebar' and is_active_sidebar('maacuni-shop-sidebar')) : ?>
    <div class="col-lg-4 col-md-12">
        <div class="tt-sidebar-wrapper right-sidebar" role="complementary">
            <?php dynamic_sidebar('maacuni-shop-sidebar'); ?>
        </div>
    </div>
<?php elseif ( $shop_sidebar == 'left-sidebar' and is_active_sidebar('maacuni-shop-sidebar')) : ?>
    <div class="col-lg-4 col-md-12 order-lg-first order-md-last">
        <div class="tt-sidebar-wrapper left-sidebar" role="complementary">
            <?php dynamic_sidebar('maacuni-shop-sidebar'); ?>
        </div>
    </div>
<?php endif;