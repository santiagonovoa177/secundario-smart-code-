<?php
/**
 * Default page — Elementor or dynamic sections.
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
	} elseif ( scn_render_page_sections() ) {
		// Custom sections fallback.
	} else {
		while ( have_posts() ) {
			the_post();
			?>
			<div class="scn-page">
				<div class="scn-container">
					<header class="scn-page-header">
						<h1><?php the_title(); ?></h1>
					</header>
					<div class="entry-content"><?php the_content(); ?></div>
					<p class="scn-center" style="margin-top:2rem">
						<a class="btn btn-primary" href="<?php echo esc_url( admin_url( 'post.php?post=' . get_the_ID() . '&action=elementor' ) ); ?>">
							Editar con Elementor
						</a>
					</p>
				</div>
			</div>
			<?php
		}
	}
	?>
</main>

<?php
get_footer();
