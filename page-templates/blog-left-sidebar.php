<?php
/*
Template Name: Blog Left Sidebar
*/

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); ?>

<div class="blog-wrapper blog-template blog-left-sidebar content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-8">
				<div id="main" class="row posts-content masonry-wrap clearfix" role="main">
					
					<?php
					// grid post $args
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
					$args  = array(
						'posts_per_page' => get_option( 'posts_per_page' ),
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'paged'          => $paged
					);
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) : 
						$maacuni_blog_post_count = 1;
						while ( $query->have_posts() ) : $query->the_post(); 
							$gird_column = 'col-md-12 col-xs-12 masonry-column'; ?>
							<div class="<?php echo esc_attr($gird_column); ?>">
								<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
							</div>
							<?php $maacuni_blog_post_count++;
						endwhile; ?>

					<?php wp_reset_postdata();

					else :
						get_template_part( 'template-parts/content', 'none' );
					endif; ?>

					
				</div><!-- .posts-content -->
				<div class="col-md-12 mt-4">
					<?php echo maacuni_list_posts_pagination(); ?>
				</div>
			</div> <!-- .col -->

			<!-- left sidebar -->
			<div class="col-lg-4 col-md-12 order-lg-first order-md-last">
	            <div class="tt-sidebar-wrapper left-sidebar" role="complementary">
	                <?php dynamic_sidebar('maacuni-blog-sidebar'); ?>
	            </div>
	        </div>

		</div> <!-- .row -->
	</div> <!-- .container -->
</div> <!-- .blog-wrapper -->
<?php get_footer();