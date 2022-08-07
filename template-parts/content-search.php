<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; ?>

<?php $page_template = get_post_meta(get_queried_object_id(), '_wp_page_template', true); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content blog-search">
		<div class="entry-header">
			<div class="entry-meta">
				<?php maacuni_post_meta(); ?>
			</div><!-- .entry-meta -->

			<?php if ( is_single() ) :
				the_title( '<h2 class="entry-title">', '</h2>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif; ?>
		</div>

		<div class="post-content">
			<?php if (is_single() || !has_excerpt()) :
				the_content( esc_html__( 'Read More', 'maacuni' ) );
			else :
				the_excerpt();
			endif;

			wp_link_pages(array(
	            'before'      => '<div class="page-pagination"><span class="page-links-title">' . esc_html__('Pages:', 'maacuni') . '</span>',
	            'after'       => '</div>',
	            'link_before' => '<span>',
	            'link_after'  => '</span>',
	        )); ?>
		</div>
    </div><!-- .entry-content -->

    <?php if (is_single()): ?>

		<footer class="entry-footer">
	    	<div class="post-tags">
		    	<?php $tags_list = get_the_tag_list('', esc_html__(', ', 'maacuni'));
		            if ($tags_list) : ?>
		                <span class="tags-links">
		                	<i class="fas fa-tags"></i><?php printf(esc_html__('%1$s', 'maacuni'), $tags_list); ?>
		                </span>
		        	<?php endif; 
		        ?>
		    </div> <!-- .post-tags -->

		    <?php 
				if(function_exists('maacuni_blog_post_share')) {
					maacuni_blog_post_share();
				}
			?>
		</footer>
	<?php endif; ?>
</article><!-- #post-## -->