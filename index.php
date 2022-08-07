<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header();
	$blog_column = maacuni_option('blog-column', false, 1);
	$blog_sidebar = maacuni_option('blog-sidebar', false, 'right-sidebar');
	$blog_page_header = maacuni_option('blog-page-header', false, true);
	$grid_column = 'col-12';
	
	if ($blog_sidebar != 'no-sidebar') :
		$grid_column = (is_active_sidebar('maacuni-blog-sidebar')) ? 'col-md-12 col-lg-8' : $grid_column;
	endif;

	if(($blog_sidebar == 'no-sidebar' || ! is_active_sidebar('maacuni-blog-sidebar')) && $blog_column == 1) {
		$grid_column = 'col-lg-10 offset-lg-1';
	}
?>

<div class="blog-wrapper content-wrapper pt-100">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr($grid_column); ?>">
				<div id="main" class="posts-content" role="main">
					<div class="row <?php echo esc_attr($blog_column != 1 ? 'masonry-wrap' : '') ?>">
						<?php 
							if ( have_posts() ) : 
								$maacuni_blog_post_count = 1; 
								
								while ( have_posts() ) : the_post(); 

										$blog_layout = "";
										if( ($blog_column == 2) || ($blog_column == 3 && $blog_sidebar != 'no-sidebar' && is_active_sidebar('maacuni-blog-sidebar')) ){
											$blog_layout = 'col-md-6 col-lg-6 col-12 masonry-column';
										} elseif($blog_column == 3 && ($blog_sidebar == 'no-sidebar' || !is_active_sidebar('maacuni-blog-sidebar'))){
											$blog_layout = 'col-md-6 col-lg-4 col-12 masonry-column';
										} else{
											$blog_layout = 'col-md-12 ';
										}
										
										if (is_sticky() && $maacuni_blog_post_count == 1): 
											$blog_layout = "col-md-12";
										endif; 

										
										?>

									<div class="<?php echo esc_attr($blog_layout); ?>">
										<?php
										/*
			                             * Include the Post-Format-specific template for the content.
			                             * If you want to override this in a child theme, then include a file
			                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			                             */
										get_template_part( 'template-parts/content', get_post_format() );
										?>
									</div>
									<?php $maacuni_blog_post_count++;
								endwhile; ?>

								
							<?php else : 
								get_template_part( 'template-parts/content', 'none' ); 
							endif; 
						?>
					</div><!-- .posts-content -->
					<div class="row">
						<div class="col-12 text-center mt-5">						
							<?php if ( maacuni_option( 'blog-page-nav', false, true ) ) {
								echo maacuni_posts_pagination();
							} else {
								maacuni_posts_navigation();
							} ?>
						</div>
					</div>
				</div><!-- .posts-content -->
			</div> <!-- .col-## -->

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</div> <!-- .row -->
	</div> <!-- .container -->
</div> <!-- .blog-wrapper -->
<?php get_footer();