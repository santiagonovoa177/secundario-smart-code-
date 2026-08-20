<?php
/**
 * Front page — Elementor or dynamic sections.
 *
 * @package smartcodenucleo
 */

get_header();
?>

<main class="scn-main scn-elementor-main">
	<?php
	if ( function_exists( 'scn_is_elementor_page' ) && scn_is_elementor_page() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	} elseif ( ! scn_render_page_sections() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	}
	?>
</main>

<?php
get_footer();
