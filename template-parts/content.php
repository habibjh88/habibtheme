<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

$cline_name = $live_link = $themeforest_link = $description = $role = $theme_type = $dev_link = "";
if ( function_exists( 'rwmb_meta' ) ) :
    $cline_name       = rwmb_meta( 'cline_name' );
    $live_link        = rwmb_meta( 'live_link' );
    $dev_link        = rwmb_meta( 'dev_link' );
    $themeforest_link = rwmb_meta( 'themeforest_link' );
    $description      = rwmb_meta( 'description' );
    $role             = rwmb_meta( 'role' );
    $theme_type       = rwmb_meta( 'theme_type' );
endif;

$thumb_size = 'portfolio-thumb';
if ( is_single() ) {
    $thumb_size = 'thumbnail-large';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) :
        // $thumb_url = get_the_post_thumbnail_url( get_the_ID(), $thumb_size );
        ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail( $thumb_size ); ?>
            <div class="overlay"></div>
            <div class="portfolio-info">
                <?php if ( $cline_name ) : ?>
                    <p><strong>Author: </strong>
                        <?php
                        echo wp_kses( $cline_name, array(
                            'a' => array(
                                'href'   => array(),
                                'title'  => array(),
                                'target' => array()
                            )
                        ) );
                        ?>
                    </p>
                <?php endif; ?>

                <?php if ( $role ) : ?>
                    <p>
                        <strong>Role: </strong> <?php echo esc_html( $role ); ?>
                    </p>
                <?php endif; ?>

                <p class="visit-link">
                    <strong>Visit: </strong>
                    <?php if ( $live_link ) : ?>
                        <a href="<?php echo esc_url( $live_link ); ?>" target="_blank">Live Preview</a>
                    <?php endif; ?>

                    <?php if ( $themeforest_link ) : ?>
                        <a href="<?php echo esc_url( $themeforest_link ); ?>" target="_blank">Themeforest</a>
                    <?php endif; ?>

                    <?php if ( $dev_link ) : ?>
                        <a href="<?php echo esc_url( $dev_link ); ?>" target="_blank">Development Site</a>
                    <?php endif; ?>
                </p>

                <?php if ( $description ) : ?>
                    <p class="d-none d-md-block"><strong>Desc:</strong>
                        <?php echo wp_kses( $description, array(
                            'a' => array(
                                'href'   => array(),
                                'title'  => array(),
                                'target' => array()
                            )
                        ) );
                        ?> </p>
                <?php endif; ?>
            </div>
        </div>

    <?php endif; ?>


    <div class="inner-content">
        <div class="post-title">
            <h2>
                <a href="<?php echo esc_url( $live_link ); ?>"><?php the_title(); ?></a>
                <?php if ( 'themeforest' == $theme_type ) : ?>
                    <span class="themeforest">ThemeForest Item</span>
                <?php elseif('live' == $theme_type) : ?>
                    <span class="live-project">Live Project</span>
                <?php elseif('developing' == $theme_type) : ?>
                    <span class="developing">Developing...</span>
                <?php endif; ?>
            </h2>
        </div>
    </div>
</article><!-- #post-## -->