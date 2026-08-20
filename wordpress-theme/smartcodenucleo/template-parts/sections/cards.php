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
		<div class="scn-cards">
			<?php foreach ( $items as $item ) : ?>
				<article class="scn-card">
					<div class="scn-card__bg" style="background-image:url('<?php echo esc_url( $item['image'] ?? '' ); ?>')"></div>
					<div class="scn-card__body">
						<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
						<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

