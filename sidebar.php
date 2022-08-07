<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

$blog_sidebar = maacuni_option('blog-sidebar', false, 'right-sidebar');
$single_sidebar = maacuni_option('single-sidebar', false, 'right-sidebar');

if(is_single()){
    if ( $single_sidebar == 'right-sidebar' and is_active_sidebar('maacuni-blog-sidebar')) : ?>
        <div class="col-lg-4 col-md-12">
            <div class="tt-sidebar-wrapper right-sidebar" role="complementary">
                <?php dynamic_sidebar('maacuni-blog-sidebar'); ?>
            </div>
        </div>
    <?php elseif ( $single_sidebar == 'left-sidebar' and is_active_sidebar('maacuni-blog-sidebar')) : ?>
        <div class="col-lg-4 col-md-12 order-lg-first order-md-last">
            <div class="tt-sidebar-wrapper left-sidebar" role="complementary">
                <?php dynamic_sidebar('maacuni-blog-sidebar'); ?>
            </div>
        </div>
    <?php endif;
}else{
    if ( $blog_sidebar == 'right-sidebar' and is_active_sidebar('maacuni-blog-sidebar')) : ?>
        <div class="col-lg-4 col-md-12">
            <div class="tt-sidebar-wrapper right-sidebar" role="complementary">
                <?php dynamic_sidebar('maacuni-blog-sidebar'); ?>
            </div>
        </div>
    <?php elseif ( $blog_sidebar == 'left-sidebar' and is_active_sidebar('maacuni-blog-sidebar')) : ?>
        <div class="col-lg-4 col-md-12 order-lg-first order-md-last">
            <div class="tt-sidebar-wrapper left-sidebar" role="complementary">
                <?php dynamic_sidebar('maacuni-blog-sidebar'); ?>
            </div>
        </div>
    <?php endif;
}