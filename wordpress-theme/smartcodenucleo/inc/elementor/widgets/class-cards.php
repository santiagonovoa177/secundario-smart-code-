<?php
namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget_Cards extends Widget_Base {

	public function get_name() {
		return 'scn-cards';
	}

	public function get_title() {
		return 'SCN Tarjetas';
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	protected function register_controls() {
		$d = function_exists( 'scn_defaults' ) ? scn_defaults() : array();
		$this->start_controls_section( 'content', array( 'label' => 'Contenido' ) );
		$this->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['solutions_title'] ?? 'About Us', 'label_block' => true ) );
		$this->add_control( 'subtitle', array( 'label' => 'Subtítulo', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['solutions_subtitle'] ?? '' ) );

		$repeater = new \Elementor\Repeater();
		$repeater->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXT, 'label_block' => true ) );
		$repeater->add_control( 'text', array( 'label' => 'Texto', 'type' => \Elementor\Controls_Manager::TEXTAREA ) );
		$repeater->add_control( 'image', array( 'label' => 'Imagen', 'type' => \Elementor\Controls_Manager::MEDIA ) );

		$defaults = array();
		for ( $i = 1; $i <= 6; $i++ ) {
			$defaults[] = array(
				'title' => $d[ "sol_{$i}_title" ] ?? "Card $i",
				'text'  => $d[ "sol_{$i}_text" ] ?? '',
				'image' => array( 'url' => $d[ "sol_{$i}_image" ] ?? '' ),
			);
		}

		$this->add_control(
			'items',
			array(
				'label'       => 'Tarjetas',
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => $defaults,
				'title_field' => '{{{ title }}}',
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$items = $s['items'] ?? array();
		?>
		<section class="scn-section scn-page">
			<div class="scn-container">
				<header class="scn-page-header">
					<?php if ( ! empty( $s['title'] ) ) : ?><h2><?php echo esc_html( $s['title'] ); ?></h2><?php endif; ?>
					<?php if ( ! empty( $s['subtitle'] ) ) : ?><p class="subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p><?php endif; ?>
				</header>
				<div class="scn-cards">
					<?php foreach ( $items as $item ) : ?>
						<?php $img = is_array( $item['image'] ?? null ) ? ( $item['image']['url'] ?? '' ) : ''; ?>
						<article class="scn-card">
							<div class="scn-card__bg" style="background-image:url('<?php echo esc_url( $img ); ?>')"></div>
							<div class="scn-card__body">
								<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
								<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
