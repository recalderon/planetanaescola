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

if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
    <?php get_template_part( 'footer-widget' ); ?>
	<footer  role="contentinfo">
		<section id="cta_register">
			<div class="bg-white py-2 px-4 small">
				<div class="d-flex flex-row align-items-center">
					<div class="flex-grow-1 text-uppercase fw-bold">
						<?php
							$settings = pods('configuracoes_de_tema');
							$texto = $settings->field('cta_left');
							echo $texto;
						?>
					</div>
					<?php $botao = $settings->field('cta_right_button');?>
					<button type="button" class="btn btn-primary btn-sm"><?php echo $botao; ?></button>
				</div>
			</div>
		</section>
		<section id="footer">
			<div class="d-flex w-100 flex-row py-2 px-4">
				© <?php echo get_the_date('Y'); ?> Planeta Na Escola
			</div>
		</section>
	</footer>
<?php endif; ?>

</div><!-- #content -->

<?php wp_footer(); ?>
</body>
</html>