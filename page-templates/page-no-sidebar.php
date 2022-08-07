<?php
/*
Template Name: Page No Sidebar
*/

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); ?>

<div class="page-wrapper content-wrapper page-no-sidebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
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
		</div> <!-- .row -->	
	</div> <!-- .container -->
</div> <!-- .content-wrapper -->
<?php get_footer(); ?>