<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;
$image404 = habib_option('img-404', 'url');

get_header(); ?>
<div class="error-page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="error-message">
				    <h3><?php esc_html_e( 'Page Not Found!', 'habib' ); ?></h3>
				    <p><?php esc_html_e( 'Sorry, we couldn\'t find the content you were looking for.', 'habib' ); ?></p>
					<a class="btn btn-primary" href="<?php echo esc_url(home_url('/'));?>">
						<?php esc_html_e( 'Go Back Home', 'habib' ); ?>
					</a>
				</div> <!-- /notfound-page -->
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div><!-- /.container -->
</div> <!-- /.content-wrapper -->
<?php get_footer();
