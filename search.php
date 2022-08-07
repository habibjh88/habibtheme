<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header();
	$blog_column = habib_option('blog-column', false, 1);
	$blog_sidebar = habib_option('blog-sidebar', false, 'right-sidebar');
	$blog_page_header = habib_option('blog-page-header', false, true);
	$grid_column = 'col-12';
	
	if ($blog_sidebar != 'no-sidebar') :
		$grid_column = (is_active_sidebar('maacuni-blog-sidebar')) ? 'col-md-12 col-lg-8' : $grid_column;
	endif;

	if(($blog_sidebar == 'no-sidebar' || ! is_active_sidebar('maacuni-blog-sidebar')) && $blog_column == 1) {
		$grid_column = 'col-lg-10 offset-lg-1';
	}
?>

<div class="blog-wrapper content-wrapper">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr($grid_column); ?>">
				<div id="main" class="posts-content" role="main">
					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							/*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
							get_template_part( 'template-parts/content', 'search' );
							?>

						<?php endwhile; ?>

						<?php if ( habib_option( 'blog-page-nav', false, true ) ) {
							echo habib_posts_pagination();
						} else {
							habib_posts_navigation();
						} ?>

					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>
				</div><!-- .posts-content -->
			</div> <!-- .col-## -->

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</div> <!-- .row -->
	</div> <!-- .container -->
</div> <!-- .blog-wrapper -->

<?php get_footer(); ?>