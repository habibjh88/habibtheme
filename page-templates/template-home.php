<?php
/*
Template Name: Home
*/

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); 
	
while ( have_posts() ) : the_post(); 
	the_content(); 
endwhile; 
	
get_footer(); 