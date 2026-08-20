<?php
$title = $section['title'] ?? '';
$video = $section['video'] ?? '';
$poster = $section['poster'] ?? '';
$cta1_label = $section['cta1_label'] ?? '';
$cta1_url = $section['cta1_url'] ?? '';
$cta2_label = $section['cta2_label'] ?? '';
$cta2_url = $section['cta2_url'] ?? '';
?>
<section class="scn-hero">
	<?php if ( $video ) : ?>
		<video class="scn-hero__video" autoplay muted loop playsinline preload="auto">
			<source src="<?php echo esc_url( $video ); ?>" type="video/mp4" />
		</video>
	<?php elseif ( $poster ) : ?>
		<img class="scn-hero__video" src="<?php echo esc_url( $poster ); ?>" alt="" width="1920" height="1080" decoding="async" />
	<?php endif; ?>
	<div class="scn-hero__overlay"></div>
	<div class="scn-hero__content">
		<img src="<?php echo esc_url( scn_logo_url() ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="scn-hero__logo" />
		<?php if ( $title ) : ?><h1><?php echo esc_html( $title ); ?></h1><?php endif; ?>
		<div class="scn-hero__actions">
			<?php if ( $cta1_label ) : ?>
				<a class="btn btn-primary" href="<?php echo esc_url( home_url( $cta1_url ) ); ?>"><?php echo esc_html( $cta1_label ); ?></a>
			<?php endif; ?>
			<?php if ( $cta2_label ) : ?>
				<a class="btn btn-ghost" href="<?php echo esc_url( home_url( $cta2_url ) ); ?>"><?php echo esc_html( $cta2_label ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
