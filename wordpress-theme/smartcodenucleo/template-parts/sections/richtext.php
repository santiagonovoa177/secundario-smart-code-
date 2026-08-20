<?php
$title = $section['title'] ?? '';
$text = $section['text'] ?? '';
?>
<section class="scn-section scn-page">
	<div class="scn-container">
		<?php if ( $title ) : ?>
			<header class="scn-page-header">
				<h2><?php echo esc_html( $title ); ?></h2>
			</header>
		<?php endif; ?>
		<div class="entry-content scn-center" style="max-width:48rem;margin:0 auto;color:rgba(255,255,255,.85);line-height:1.7">
			<?php echo nl2br( esc_html( $text ) ); ?>
		</div>
	</div>
</section>

