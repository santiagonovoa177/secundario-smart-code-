<?php
namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget_Partners extends Widget_Base {

	public function get_name() {
		return 'scn-partners';
	}

	public function get_title() {
		return 'SCN Partners';
	}

	protected function register_controls() {
		$d = function_exists( 'scn_defaults' ) ? scn_defaults() : array();
		$this->start_controls_section( 'content', array( 'label' => 'Contenido' ) );
		$this->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['partners_title'] ?? '' ) );
		$this->add_control( 'subtitle', array( 'label' => 'Subtítulo', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['partners_subtitle'] ?? '' ) );
		$this->add_control( 'cta', array( 'label' => 'CTA', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['partners_cta'] ?? '', 'label_block' => true ) );
		$this->scn_image_control( 'image1', 'Imagen 1', $d['partner_1_image'] ?? '' );
		$this->scn_image_control( 'image2', 'Imagen 2', $d['partner_2_image'] ?? '' );
		$this->scn_image_control( 'image3', 'Imagen 3', $d['partner_3_image'] ?? '' );
		$this->end_controls_section();
	}

	protected function render() {
		$s      = $this->get_settings_for_display();
		$images = array_filter(
			array(
				$this->scn_img_url( $s['image1'] ),
				$this->scn_img_url( $s['image2'] ),
				$this->scn_img_url( $s['image3'] ),
			)
		);
		?>
		<section class="scn-section scn-page">
			<div class="scn-container">
				<header class="scn-page-header">
					<?php if ( ! empty( $s['title'] ) ) : ?><h2><?php echo esc_html( $s['title'] ); ?></h2><?php endif; ?>
					<?php if ( ! empty( $s['subtitle'] ) ) : ?><p class="subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p><?php endif; ?>
				</header>
				<div class="scn-cards scn-cards--partners">
					<?php foreach ( $images as $img ) : ?>
						<div class="scn-card scn-card--media">
							<div class="scn-card__bg" style="background-image:url('<?php echo esc_url( $img ); ?>')"></div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if ( ! empty( $s['cta'] ) ) : ?><p class="scn-cta-line"><?php echo esc_html( $s['cta'] ); ?></p><?php endif; ?>
			</div>
		</section>
		<?php
	}
}
