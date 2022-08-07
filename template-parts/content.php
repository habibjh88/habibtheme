<?php
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

$cline_name = $live_link = $themeforest_link = $description = $role = $theme_type = $dev_link = $pro_link = $wp_org_link = "";
if (function_exists('rwmb_meta')) :
    $cline_name = rwmb_meta('cline_name');
    $live_link = rwmb_meta('live_link');
    $pro_link = rwmb_meta('pro_link');
    $wp_org_link = rwmb_meta('wp_org_link');
    $dev_link = rwmb_meta('dev_link');
    $themeforest_link = rwmb_meta('themeforest_link');
    $description = rwmb_meta('description');
    $role = rwmb_meta('role');
    $theme_type = rwmb_meta('theme_type');
endif;

$thumb_size = 'portfolio-thumb';
if (is_single()) {
    $thumb_size = 'thumbnail-large';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) :
        // $thumb_url = get_the_post_thumbnail_url( get_the_ID(), $thumb_size );
        ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail($thumb_size); ?>
            <div class="overlay"></div>
            <p class="visit-link">
                <?php if ($live_link) : ?>
                    <a class="bg-info" href="<?php echo esc_url($live_link); ?>" target="_blank">Live Link</a>
                <?php endif; ?>

                <?php if ($themeforest_link) : ?>
                    <a class="bg-success" href="<?php echo esc_url($themeforest_link); ?>" target="_blank">ThemeForest
                        Link</a>
                <?php endif; ?>

                <?php if ($dev_link) : ?>
                    <a class="bg-dark" href="<?php echo esc_url($dev_link); ?>" target="_blank">Development Link</a>
                <?php endif; ?>

                <?php if ($pro_link) : ?>
                    <a class="bg-warning" href="<?php echo esc_url($pro_link); ?>" target="_blank">Pro Link</a>
                <?php endif; ?>
                <?php if ($wp_org_link) : ?>
                    <a class="bg-primary" href="<?php echo esc_url($wp_org_link); ?>" target="_blank">WordPress.org</a>
                <?php endif; ?>
            </p>

            <?php if ($description) : ?>
                <div class="description">
                    <?php echo wp_kses($description, array(
                        'a' => array(
                            'href' => array(),
                            'title' => array(),
                            'target' => array()
                        )
                    ));
                    ?> </div>
            <?php endif; ?>
        </div>

    <?php endif; ?>


    <div class="inner-content">
        <div class="post-title">
            <h2>
                <a href="<?php echo esc_url($live_link); ?>" target="_blank"><?php the_title(); ?></a>
                <?php if ('themeforest' == $theme_type) : ?>
                    <span class="themeforest">ThemeForest Item</span>
                <?php elseif ('live' == $theme_type) : ?>
                    <span class="live-project">Live Project</span>
                <?php elseif ('developing' == $theme_type) : ?>
                    <span class="developing">Developing...</span>
                <?php elseif ('wordpress' == $theme_type) : ?>
                    <span class="wordpress bg-primary">WordPress.org</span>
                <?php endif; ?>
            </h2>

            <div class="portfolio-info">
                <?php if ($role) : ?>
                    <p class="my-role">
                        <strong>My Role: </strong>
                        <span class="text-danger"><?php echo esc_html($role); ?></span>
                    </p>
                <?php endif; ?>

                <?php if ($cline_name) : ?>
                    <p><strong>Author: </strong>
                        <?php
                        echo wp_kses($cline_name, array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'target' => array()
                            )
                        ));
                        ?>
                    </p>
                <?php endif; ?>

            </div>

        </div>
    </div>
</article><!-- #post-## -->