<?php
namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget_About extends Widget_Base {

	public function get_name() {
		return 'scn-about';
	}

	public function get_title() {
		return 'SCN Who We Are';
	}

	protected function register_controls() {
		$d = function_exists( 'scn_defaults' ) ? scn_defaults() : array();
		$this->start_controls_section( 'content', array( 'label' => 'Contenido' ) );
		$this->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['who_title'] ?? '', 'label_block' => true ) );
		$this->add_control( 'subtitle', array( 'label' => 'Subtítulo', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['who_subtitle'] ?? '' ) );
		$this->scn_image_control( 'image', 'Imagen', $d['who_image'] ?? '' );
		$this->add_control( 'text', array( 'label' => 'Texto', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => trim( ( $d['who_p1'] ?? '' ) . "\n\n" . ( $d['who_p2'] ?? '' ) ), 'rows' => 6 ) );
		$this->add_control( 'vision', array( 'label' => 'Vision', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['who_vision'] ?? '' ) );
		$this->add_control( 'mission', array( 'label' => 'Mission', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['who_mission'] ?? '' ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s    = $this->get_settings_for_display();
		$img  = $this->scn_img_url( $s['image'] );
		$pars = preg_split( "/\n\s*\n/", (string) ( $s['text'] ?? '' ) );
		?>
		<section class="scn-section scn-page">
			<div class="scn-container">
				<header class="scn-page-header">
					<?php if ( ! empty( $s['title'] ) ) : ?><h2><?php echo esc_html( $s['title'] ); ?></h2><?php endif; ?>
					<?php if ( ! empty( $s['subtitle'] ) ) : ?><p class="subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p><?php endif; ?>
				</header>
				<div class="scn-split">
					<div>
						<?php if ( $img ) : ?>
							<img src="<?php echo esc_url( $img ); ?>" alt="" class="scn-rounded" loading="lazy" />
						<?php endif; ?>
					</div>
					<div>
						<?php foreach ( $pars as $p ) : ?>
							<?php if ( trim( $p ) ) : ?><p><?php echo nl2br( esc_html( trim( $p ) ) ); ?></p><?php endif; ?>
						<?php endforeach; ?>
						<?php if ( ! empty( $s['vision'] ) ) : ?>
							<h3 class="accent-label">VISION</h3>
							<p><?php echo esc_html( $s['vision'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $s['mission'] ) ) : ?>
							<h3 class="accent-label">MISSION</h3>
							<p><?php echo esc_html( $s['mission'] ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
