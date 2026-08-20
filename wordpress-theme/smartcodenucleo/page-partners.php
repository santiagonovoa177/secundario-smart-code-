<?php
/**
 * Template Name: Partners
 *
 * @package smartcodenucleo
 */

get_header();
?>

<main class="scn-main scn-page">
	<div class="scn-container">
		<header class="scn-page-header">
			<h1><?php scn_text( 'partners_title' ); ?></h1>
			<p class="subtitle"><?php scn_text( 'partners_subtitle' ); ?></p>
		</header>

		<div class="scn-cards scn-cards--partners">
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<div class="scn-card scn-card--media">
					<div class="scn-card__bg" style="background-image:url('<?php scn_url( "partner_{$i}_image" ); ?>')"></div>
				</div>
			<?php endfor; ?>
		</div>

		<p class="scn-cta-line"><?php scn_text( 'partners_cta' ); ?></p>
	</div>
</main>

<?php
get_footer();
