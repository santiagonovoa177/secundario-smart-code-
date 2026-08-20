<?php
/**
 * Template Name: Elementor — Ancho completo
 *
 * @package smartcodenucleo
 */

get_header();
?>

<main class="scn-main scn-elementor-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
