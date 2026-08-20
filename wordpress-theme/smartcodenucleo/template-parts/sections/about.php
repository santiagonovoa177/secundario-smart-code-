<?php
$title = $section['title'] ?? '';
$subtitle = $section['subtitle'] ?? '';
$image = $section['image'] ?? '';
$text = $section['text'] ?? '';
$vision = $section['vision'] ?? '';
$mission = $section['mission'] ?? '';
$paragraphs = preg_split( "/\n\s*\n/", (string) $text );
?>
<section class="scn-section scn-page">
	<div class="scn-container">
		<header class="scn-page-header">
			<?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
			<?php if ( $subtitle ) : ?><p class="subtitle"><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
		</header>
		<div class="scn-split">
			<div>
				<?php if ( $image ) : ?>
					<img src="<?php echo esc_url( $image ); ?>" alt="" class="scn-rounded" loading="lazy" />
				<?php endif; ?>
			</div>
			<div>
				<?php foreach ( $paragraphs as $p ) : ?>
					<?php if ( trim( $p ) ) : ?><p><?php echo nl2br( esc_html( trim( $p ) ) ); ?></p><?php endif; ?>
				<?php endforeach; ?>
				<?php if ( $vision ) : ?>
					<h3 class="accent-label">VISION</h3>
					<p><?php echo esc_html( $vision ); ?></p>
				<?php endif; ?>
				<?php if ( $mission ) : ?>
					<h3 class="accent-label">MISSION</h3>
					<p><?php echo esc_html( $mission ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

