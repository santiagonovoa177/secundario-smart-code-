<?php
/**
 * Template Name: News
 *
 * @package smartcodenucleo
 */

get_header();
?>

<main class="scn-main scn-page">
	<div class="scn-container">
		<header class="scn-page-header">
			<h1><?php scn_text( 'news_title' ); ?></h1>
			<p class="subtitle"><?php scn_text( 'news_subtitle' ); ?></p>
		</header>

		<div class="scn-news-grid">
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<article class="scn-news-card">
					<?php scn_img( "news_{$i}_image", scn_get( "news_{$i}_title" ), 'scn-news-card__img' ); ?>
					<div class="scn-news-card__body">
						<h3><?php scn_text( "news_{$i}_title" ); ?></h3>
						<p><?php scn_text( "news_{$i}_text" ); ?></p>
						<span><?php scn_text( "news_{$i}_date" ); ?></span>
					</div>
				</article>
			<?php endfor; ?>
		</div>
	</div>
</main>

<?php
get_footer();
