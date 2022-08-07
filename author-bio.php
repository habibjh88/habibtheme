<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;
?>

<div class="post-author">
    <div class="media">
        <div class="media-left">
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="media-object">
                <?php
                echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'maacuni_author_bio_avatar_size', 100 ) ); 
                ?>
            </a>
        </div>
        
        <div class="media-body">
            <div class="author-info">
                <?php 
                    $author_desc  = get_the_author_meta('description'); 
                    $kses = array(
                                'a'      => array(
                                    'href'   => array(),
                                    'title'  => array(),
                                    'target' => array()
                                ),
                                'br'     => array(),
                                'em'     => array(),
                                'strong' => array(),
                                'ul'     => array(),
                                'li'     => array(),
                                'p'      => array(),
                                'span'   => array(
                                    'class' => array()
                                )
                            )
                ?>
                <h3><?php echo get_the_author() ?></h3>
                <?php echo wp_kses($author_desc, $kses); ?>
                <?php
                /*
                 * Get author social link.
                 */
                get_template_part( 'template-parts/author-social-info');
                ?>
            </div>
        </div>
    </div> <!-- .media -->
</div> <!-- .post-author -->