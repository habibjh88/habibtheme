<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); 
	$page_sidebar = habib_option('page-sidebar', false, 'right-sidebar');
	$grid_column = 'col-lg-10 offset-lg-1';
	
	if (is_active_sidebar('habib-page-sidebar') && $page_sidebar != 'no-sidebar') :
		$grid_column ='col-md-12 col-lg-8';
	endif;
?>
<div class="page-wrapper content-wrapper">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr($grid_column); ?>">
				<div id="main" class="posts-content" role="main">
					
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'page' );
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endwhile; // End of the loop. ?>

				</div> <!-- .posts-content -->
			</div> <!-- .col-## -->

			<!-- Page sidebar -->
			<?php get_sidebar('page'); ?>

		</div> <!-- .row -->	
	</div> <!-- .container -->
</div> <!-- .content-wrapper -->
<?php get_footer();