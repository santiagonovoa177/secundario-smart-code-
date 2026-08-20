<?php
$title = $section['title'] ?? '';
$lead = $section['lead'] ?? '';
$text = $section['text'] ?? '';
$image = $section['image'] ?? '';
$button_label = $section['button_label'] ?? '';
$button_url = $section['button_url'] ?? '';
$paragraphs = preg_split( "/\n\s*\n/", (string) $text );
?>
<section class="scn-section">
	<div class="scn-container scn-split">
		<div>
			<?php if ( $image ) : ?>
				<div class="scn-side-image-wrap" style="max-width:28rem;aspect-ratio:1;overflow:hidden">
					<img
						src="<?php echo esc_url( $image ); ?>"
						alt=""
						class="scn-side-image"
						width="448"
						height="448"
						decoding="async"
						loading="lazy"
						style="max-width:28rem;max-height:28rem;width:100%;height:100%;object-fit:contain"
						onload="this.classList.add('is-ready')"
					/>
				</div>
			<?php endif; ?>
		</div>
		<div>
			<?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
			<?php if ( $lead ) : ?><p class="lead"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
			<?php foreach ( $paragraphs as $p ) : ?>
				<?php if ( trim( $p ) ) : ?><p><?php echo nl2br( esc_html( trim( $p ) ) ); ?></p><?php endif; ?>
			<?php endforeach; ?>
			<?php if ( $button_label ) : ?>
				<a class="btn btn-ghost" href="<?php echo esc_url( home_url( $button_url ) ); ?>"><?php echo esc_html( $button_label ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>

