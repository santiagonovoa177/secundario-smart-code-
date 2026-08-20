<?php
namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget_Text_Media extends Widget_Base {

	public function get_name() {
		return 'scn-text-media';
	}

	public function get_title() {
		return 'SCN Texto + Imagen';
	}

	protected function register_controls() {
		$d = function_exists( 'scn_defaults' ) ? scn_defaults() : array();
		$this->start_controls_section( 'content', array( 'label' => 'Contenido' ) );
		$this->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['home_section_title'] ?? '', 'label_block' => true ) );
		$this->add_control( 'lead', array( 'label' => 'Lead', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['home_lead'] ?? '' ) );
		$this->add_control(
			'text',
			array(
				'label'   => 'Texto (párrafos separados por línea vacía)',
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => trim( ( $d['home_p1'] ?? '' ) . "\n\n" . ( $d['home_p2'] ?? '' ) . "\n\n" . ( $d['home_p3'] ?? '' ) ),
				'rows'    => 8,
			)
		);
		$this->scn_image_control( 'image', 'Imagen', $d['home_side_image'] ?? '' );
		$this->add_control( 'button_label', array( 'label' => 'Botón — texto', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Contact' ) );
		$this->scn_url_control( 'button_url', 'Botón — enlace', home_url( '/contact/' ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s    = $this->get_settings_for_display();
		$img  = $this->scn_img_url( $s['image'] );
		$pars = preg_split( "/\n\s*\n/", (string) ( $s['text'] ?? '' ) );
		?>
		<section class="scn-section">
			<div class="scn-container scn-split">
				<div>
					<?php if ( $img ) : ?>
						<div class="scn-side-image-wrap" style="max-width:28rem;aspect-ratio:1;overflow:hidden">
							<img
								src="<?php echo esc_url( $img ); ?>"
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
					<?php if ( ! empty( $s['title'] ) ) : ?><h2><?php echo esc_html( $s['title'] ); ?></h2><?php endif; ?>
					<?php if ( ! empty( $s['lead'] ) ) : ?><p class="lead"><?php echo esc_html( $s['lead'] ); ?></p><?php endif; ?>
					<?php foreach ( $pars as $p ) : ?>
						<?php if ( trim( $p ) ) : ?><p><?php echo nl2br( esc_html( trim( $p ) ) ); ?></p><?php endif; ?>
					<?php endforeach; ?>
					<?php if ( ! empty( $s['button_label'] ) ) : ?>
						<a class="btn btn-ghost" href="<?php echo esc_url( $this->scn_link_url( $s['button_url'] ) ); ?>"><?php echo esc_html( $s['button_label'] ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
