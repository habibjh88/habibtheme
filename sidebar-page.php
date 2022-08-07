<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

$page_sidebar = maacuni_option( 'page-sidebar', false, 'right-sidebar' );

if ( $page_sidebar == 'right-sidebar' and is_active_sidebar( 'maacuni-page-sidebar' ) ) : ?>
	<div class="col-lg-4 col-md-12">
		<div class="tt-sidebar-wrapper right-sidebar" role="complementary">
			<?php dynamic_sidebar( 'maacuni-page-sidebar' ); ?>
		</div>
	</div>
<?php elseif ( $page_sidebar == 'left-sidebar' and is_active_sidebar( 'maacuni-page-sidebar' ) ) : ?>
	<div class="col-lg-4 col-md-12 order-lg-first order-md-last">
		<div class="tt-sidebar-wrapper left-sidebar" role="complementary">
			<?php dynamic_sidebar( 'maacuni-page-sidebar' ); ?>
		</div>
	</div>
<?php endif;