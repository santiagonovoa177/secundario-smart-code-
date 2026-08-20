<?php
$title = $section['title'] ?? '';
$subtitle = $section['subtitle'] ?? '';
$items = $section['items'] ?? array();
?>
<section class="scn-section scn-page">
	<div class="scn-container">
		<header class="scn-page-header">
			<?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
			<?php if ( $subtitle ) : ?><p class="subtitle"><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
		</header>
		<div class="scn-news-grid">
			<?php foreach ( $items as $item ) : ?>
				<article class="scn-news-card">
					<?php if ( ! empty( $item['image'] ) ) : ?>
						<img src="<?php echo esc_url( $item['image'] ); ?>" alt="" class="scn-news-card__img" loading="lazy" />
					<?php endif; ?>
					<div class="scn-news-card__body">
						<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
						<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
						<span><?php echo esc_html( $item['date'] ?? '' ); ?></span>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

