<?php
$title = $section['title'] ?? '';
$subtitle = $section['subtitle'] ?? '';
$cta = $section['cta'] ?? '';
$images = array_filter( array( $section['image1'] ?? '', $section['image2'] ?? '', $section['image3'] ?? '' ) );
?>
<section class="scn-section scn-page">
	<div class="scn-container">
		<header class="scn-page-header">
			<?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
			<?php if ( $subtitle ) : ?><p class="subtitle"><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
		</header>
		<div class="scn-cards scn-cards--partners">
			<?php foreach ( $images as $img ) : ?>
				<div class="scn-card scn-card--media">
					<div class="scn-card__bg" style="background-image:url('<?php echo esc_url( $img ); ?>')"></div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if ( $cta ) : ?><p class="scn-cta-line"><?php echo esc_html( $cta ); ?></p><?php endif; ?>
	</div>
</section>

