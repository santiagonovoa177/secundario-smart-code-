<?php
$title = $section['title'] ?? '';
$subtitle = $section['subtitle'] ?? '';
$text = $section['text'] ?? '';
$email = $section['email'] ?? '';
$button_label = $section['button_label'] ?? 'Connect';
?>
<section class="scn-section scn-page scn-contact-section">
	<div class="scn-container">
		<div class="scn-contact">
			<header class="scn-page-header">
				<?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
				<?php if ( $subtitle ) : ?><p class="subtitle"><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
			</header>
			<?php if ( $text ) : ?><p class="lead"><?php echo esc_html( $text ); ?></p><?php endif; ?>
			<?php if ( $email ) : ?>
				<p>
					<a class="accent-link" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
				</p>
			<?php endif; ?>
			<form class="scn-form" onsubmit="event.preventDefault(); alert('Thanks! We will reach out.');">
				<label class="sr-only" for="email-<?php echo esc_attr( $section['id'] ?? 'c' ); ?>">Business email</label>
				<div class="scn-form__row">
					<input id="email-<?php echo esc_attr( $section['id'] ?? 'c' ); ?>" type="email" required placeholder="Enter your business e-mail" />
					<button type="submit" class="btn btn-primary"><?php echo esc_html( $button_label ); ?></button>
				</div>
			</form>
		</div>
	</div>
</section>
