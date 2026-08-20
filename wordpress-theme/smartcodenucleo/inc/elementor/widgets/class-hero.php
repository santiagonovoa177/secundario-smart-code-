<?php
namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget_Hero extends Widget_Base {

	public function get_name() {
		return 'scn-hero';
	}

	public function get_title() {
		return 'SCN Hero';
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	protected function register_controls() {
		$d = function_exists( 'scn_defaults' ) ? scn_defaults() : array();

		$this->start_controls_section( 'content', array( 'label' => 'Contenido' ) );
		$this->add_control(
			'title',
			array(
				'label'   => 'Título',
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => $d['hero_title'] ?? '',
			)
		);
		$this->scn_image_control( 'poster', 'Poster / imagen de fondo', $d['hero_poster'] ?? '' );
		$this->add_control(
			'video',
			array(
				'label'       => 'URL del video (mp4)',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => $d['hero_video'] ?? '',
				'label_block' => true,
			)
		);
		$this->add_control( 'cta1_label', array( 'label' => 'Botón 1 — texto', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'About Us' ) );
		$this->scn_url_control( 'cta1_url', 'Botón 1 — enlace', home_url( '/about-us/' ) );
		$this->add_control( 'cta2_label', array( 'label' => 'Botón 2 — texto', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Contact' ) );
		$this->scn_url_control( 'cta2_url', 'Botón 2 — enlace', home_url( '/contact/' ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s      = $this->get_settings_for_display();
		$poster = $this->scn_img_url( $s['poster'] );
		$video  = $s['video'] ?? '';
		?>
		<section class="scn-hero">
			<?php if ( $video ) : ?>
				<?php /* No poster: ball.webp flash at intrinsic size during soft-nav. */ ?>
				<video class="scn-hero__video" autoplay muted loop playsinline preload="auto">
					<source src="<?php echo esc_url( $video ); ?>" type="video/mp4" />
				</video>
			<?php elseif ( $poster ) : ?>
				<img class="scn-hero__video" src="<?php echo esc_url( $poster ); ?>" alt="" width="1920" height="1080" decoding="async" />
			<?php endif; ?>
			<div class="scn-hero__overlay"></div>
			<div class="scn-hero__content">
				<img src="<?php echo esc_url( scn_logo_url() ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="scn-hero__logo" />
				<?php if ( ! empty( $s['title'] ) ) : ?><h1><?php echo esc_html( $s['title'] ); ?></h1><?php endif; ?>
				<div class="scn-hero__actions">
					<?php if ( ! empty( $s['cta1_label'] ) ) : ?>
						<a class="btn btn-primary" href="<?php echo esc_url( $this->scn_link_url( $s['cta1_url'] ) ); ?>"><?php echo esc_html( $s['cta1_label'] ); ?></a>
					<?php endif; ?>
					<?php if ( ! empty( $s['cta2_label'] ) ) : ?>
						<a class="btn btn-ghost" href="<?php echo esc_url( $this->scn_link_url( $s['cta2_url'] ) ); ?>"><?php echo esc_html( $s['cta2_label'] ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
