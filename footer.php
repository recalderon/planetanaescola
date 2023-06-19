<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
	</div><!-- #content -->
</main>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
    <?php get_template_part( 'footer-widget' ); ?>
	<footer id="footer">
		<?php if(!is_user_logged_in()){?>
		<section id="cta_register" class="footer-sticky">
			<div class="bg-white py-2 px-4 small">
				<div class="d-flex flex-row align-items-center">
					<div class="flex-grow-1 text-uppercase fw-bold">
						<?php
							echo get_theme_mod( 'pne_footer--cta-message', '' );
						?>
					</div>?>
					<a class="btn btn-primary" href="<?php echo esc_url( wp_login_url() ); ?>"><?php echo get_theme_mod( 'pne_footer--cta-botao', '' ); ?></a>
				</div>
			</div>
		</section>
		<?php } ?>
		<section id="pne_footer">
			<div class="d-flex w-100 flex-row py-2 px-4">
				© <?php echo get_the_date('Y'); ?> Planeta Na Escola
			</div>
		</section>
	</footer>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>