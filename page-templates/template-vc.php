<?php
/*
Template Name: Visual Composer Template
*/

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); ?>

<div class="vc-content-wrapper">
	<?php 
		while ( have_posts() ) : the_post(); 
			the_content(); 
		endwhile; // End of the loop. 
	?>
</div>
<?php get_footer();