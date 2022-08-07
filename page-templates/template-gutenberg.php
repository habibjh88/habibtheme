<?php
/*
Template Name: Gutenberg Template
*/

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); ?>
<div class="single-post gutenberg-page-template">

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="entry-content">
					
					<?php while ( have_posts() ) : the_post(); ?>

						<?php the_content(); ?>

					<?php endwhile; // End of the loop. ?>
				</div>
				
			</div> <!-- .col-## -->

		</div> <!-- .row -->	
	</div> <!-- .container -->

</div>
<?php get_footer(); ?>