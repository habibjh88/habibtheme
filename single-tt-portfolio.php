<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); 

?>
<div class="single-portfolio-page">
    <?php 
        while ( have_posts() ) : the_post(); 

            $portfolio_info = $portfolio_link_label = $portfolio_link_text = $portfolio_link = $tool_logo = $slides = "";
            if (function_exists('rwmb_meta')) :
                $slides = rwmb_meta('maacuni_portfolio_gallery','type=image_advanced');
                $portfolio_info = rwmb_meta( 'maacuni_portfolio_info' );
                $portfolio_link_label = rwmb_meta( 'maacuni_portfolio_link_label' );
                $portfolio_link_text = rwmb_meta( 'maacuni_portfolio_link_text' );
                $portfolio_link = rwmb_meta( 'maacuni_portfolio_link' );
                $tool_logo = rwmb_meta( 'maacuni_tool_logo' );
            endif; 
            ?>

            <header>
                <?php if($slides) : ?>
                    <div id="carouselExampleControls" class="carousel slide portfolio-single-slider carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                        <?php foreach($slides as $slide): ?>
                                <?php 
                                    $img_src = wp_get_attachment_image_src($slide['ID'], 'maacuni-portfolio-large'); 
                                ?>
                                    <div class="carousel-item">
                                        <div class="portfolio-thumbnail item" style="background-image:url('<?php echo esc_attr($img_src[0]) ?>')"></div>
                                    </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <?php
                        $portfolio_thumb = get_the_post_thumbnail_url(null, 'maacuni-portfolio-large');
                        if($portfolio_thumb){
                            $portfolio_thumb = "background-image: url(".esc_url($portfolio_thumb).")";
                        }else{
                            $portfolio_thumb = "";
                        }
                    ?>
                    <div class="portfolio-thumbnail" style="<?php echo esc_attr($portfolio_thumb) ?>"></div>
                <?php endif; ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portfolio-info">
                                <?php if($slides) : ?>
                                    <div class="row">
                                        <div class="col-md-4 offset-md-8">
                                            <div class="tt-animation bg-dark">
                                                <div class="tt-animation-inner">
                                                    <div class="slider-indicator">
                                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                            <i class="fas fa-chevron-left"></i>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                            <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                

                                
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <?php the_content(); 
            
            if(maacuni_option('next_portfolio_visibility', false, true)) : 
                $next_post = get_next_post();
                if (!empty( $next_post )):
                    $post_info = get_post_meta($next_post->ID, 'maacuni_portfolio_info', false);
                    $what_next_title = maacuni_option('what_next_title');
                    $what_next_color = $what_next_bg_color = "";
                    if(maacuni_option('next_font_color')){
                        $what_next_color = "color: ".maacuni_option('next_font_color').';';
                        $what_next_bg_color = "background-color: ".maacuni_option('next_font_color').';';
                    }

                    ?>
                    <div class="next-portfolio-wrapper" style="<?php echo esc_attr($what_next_color) ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 offset-md-2">

                                    <div class="next-portfolio-inner" >  
                                        <?php if($what_next_title) : ?>       
                                            <span><?php echo esc_html($what_next_title) ?></span>
                                        <?php endif; ?>
                                    
                                        <h2><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" style="<?php echo esc_attr($what_next_color) ?>"><?php echo esc_attr( $next_post->post_title ); ?></a></h2>

                                        <?php if(! empty($post_info)) : ?>
                                            <div class="next-portfolio-info">
                                                <span class="line" style="<?php echo esc_attr($what_next_bg_color) ?>"></span>
                                                <p><?php echo esc_html(implode(" ",$post_info)); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; 
            endif;
            
        endwhile; // End of the loop. 
    ?>

</div>

<?php get_footer(); ?>