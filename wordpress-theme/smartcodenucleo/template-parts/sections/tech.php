<?php
$title = $section['title'] ?? '';
$subtitle = $section['subtitle'] ?? '';
$lead = $section['lead'] ?? '';
$items = $section['items'] ?? array();
?>
<section class="scn-section scn-page">
	<div class="scn-container">
		<header class="scn-page-header">
			<?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
			<?php if ( $subtitle ) : ?><p class="subtitle"><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
		</header>
		<?php if ( $lead ) : ?><p class="scn-center lead"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
		<div class="scn-tech-grid">
			<?php foreach ( $items as $item ) : ?>
				<div class="scn-tech-card">
					<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
					<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

