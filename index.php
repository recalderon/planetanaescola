<?php
/**
 * Template Name: Blog
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header();

get_template_part( 'template-parts/titulopagina');

?>

<section id="primary" class="content-area">
    <div id="main" class="site-main" role="main">
        <div class="container">
			<div class="row">
				<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					the_posts_navigation();
				?>
			</div>
        </div>
    </div>
</section>

<?php
get_footer(); ?>