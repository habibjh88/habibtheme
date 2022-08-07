<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header();
    $single_sidebar = maacuni_option('single-sidebar', false, 'right-sidebar');
    $single_post_header = maacuni_option('blog-single-page-header', false, false);
    $header_page_options = maacuni_option('page-header-visibility', false, true);
    $blog_style = maacuni_option('blog-style', false, 'default');
    $grid_column = 'col-12';

    if ($single_sidebar == 'left-sidebar' || $single_sidebar == 'right-sidebar') :
        $grid_column = (is_active_sidebar('maacuni-blog-sidebar')) ? 'col-md-12 col-lg-8' : $grid_column;
    endif;

    if(($single_sidebar == 'no-sidebar' || ! is_active_sidebar('maacuni-blog-sidebar')) && $blog_style == 'default') {
        $grid_column = 'col-lg-10 offset-lg-1';
    }

    $is_header = "";
    if($single_post_header && $header_page_options == 'header-section-show'){
        $is_header = 'title-hidden';
    }
?>

<div class="blog-wrapper content-wrapper <?php echo esc_attr($single_post_header ? '' : 'pt-100') ?>">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr($grid_column); ?>">
                <div id="main" class="posts-content <?php echo esc_attr($is_header) ?>" role="main">
                    <?php 
                        while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

                            <?php  
                                $offset_class = "";
                                if($blog_style == 'default'){
                                    $offset_class = '';
                                }
                                else if($single_sidebar == 'no-sidebar'){
                                    $offset_class = 'offset-lg-2';
                                }
                            ?>

                            <div class="<?php echo esc_attr($offset_class) ?>">
                                <?php 
                                    if (get_the_author_meta( 'description' )) :
                                        get_template_part( 'author-bio' ); 
                                    endif;

                                    maacuni_post_navigation(); 
                                
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                    endif; 
                                ?>
                            </div><?php 
                        endwhile; // End of the loop. 
                    ?>
                </div> <!-- .posts-content -->
            </div> <!-- col-## -->

            <!-- Sidebar -->   
            <?php get_sidebar(); ?>

        </div> <!-- .row -->
    </div> <!-- .container -->
</div> <!-- .content-wrapper -->

<?php get_footer();