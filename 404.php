<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;
$image404 = maacuni_option('img-404', 'url');

get_header(); ?>
<div class="error-page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="error-message">
					<?php if($image404)  : ?>
					<img src="<?php echo esc_url($image404); ?>" alt="<?php esc_attr_e('404', 'maacuni'); ?>">
					<?php else : ?>
				    	<img class="img-1" src="<?php echo get_template_directory_uri() . "/images/404.png" ?>" alt="<?php esc_attr_e('404', 'maacuni'); ?>">
					<?php endif; ?>

				    <h3><?php esc_html_e( 'Page Not Found!', 'maacuni' ); ?></h3>

				    <p><?php esc_html_e( 'Sorry, we couldn\'t find the content you were looking for.', 'maacuni' ); ?></p>

					<a class="btn btn-primary" href="<?php echo esc_url(home_url('/'));?>">
						<?php esc_html_e( 'Go Back Home', 'maacuni' ); ?>
					</a>
				</div> <!-- /notfound-page -->
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div><!-- /.container -->
</div> <!-- /.content-wrapper -->
<?php get_footer();
