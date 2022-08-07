<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); ?>
<div class="portfolio-taxonomy section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="main" class="row" role="main">

                    <?php
                    // grid post $args
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                    $args  = array(
                        'post_type'      => 'tt-portfolio',
                        'posts_per_page' => 9,
                        'tt-portfolio-cat'   => $term->slug,
                        'post_status'    => 'publish',
                        'paged'          => $paged
                    );

                    $query = new WP_Query( $args ); ?>
                    <?php if ( $query->have_posts() ) : ?>

                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 mb-5 portfolio-taxonomy-item'); ?>>

                                <div class="portfolio-taxonomy-inner">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        
                                            <div class="post-thumbnail">
                                                <?php the_post_thumbnail('maacuni-thumbnail', array('alt' => get_the_title(), 'class' => 'img-fluid')); ?>
                                            </div><!-- .post-thumbnail -->
                                        
                                    <?php endif; ?>

                                    
                                    <div class="entry-content">

                                        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>

                                        <div class="portfolio-cat">
                                            <?php tt_get_custom_taxonomy('tt-portfolio-cat') ?>
                                        </div>
                                        
                                    </div><!-- .entry-content -->

                                    
                                </div>
                            </div><!-- #post-## -->

                        <?php endwhile; 
                    else : ?>
                        <p><?php esc_html_e('portfolio not found !', 'maacuni');?></p>
                    <?php endif;
                        wp_reset_postdata();
                    ?>
                </div><!-- .posts-content -->

                <div class="col-md-12 text-center">
                    <?php echo maacuni_list_posts_pagination(); ?>
                </div>
            </div> <!-- .col -->

        </div> <!-- .row -->
    </div> <!-- .container -->
</div> <!-- .blog-wrapper -->
<?php get_footer();