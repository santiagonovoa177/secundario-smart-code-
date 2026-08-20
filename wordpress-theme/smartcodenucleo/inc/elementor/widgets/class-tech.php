<?php
namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget_Tech extends Widget_Base {

	public function get_name() {
		return 'scn-tech';
	}

	public function get_title() {
		return 'SCN Technology';
	}

	protected function register_controls() {
		$d = function_exists( 'scn_defaults' ) ? scn_defaults() : array();
		$this->start_controls_section( 'content', array( 'label' => 'Contenido' ) );
		$this->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['tech_title'] ?? '', 'label_block' => true ) );
		$this->add_control( 'subtitle', array( 'label' => 'Subtítulo', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['tech_subtitle'] ?? '', 'label_block' => true ) );
		$this->add_control( 'lead', array( 'label' => 'Lead', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['tech_lead'] ?? '' ) );

		$repeater = new \Elementor\Repeater();
		$repeater->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXT, 'label_block' => true ) );
		$repeater->add_control( 'text', array( 'label' => 'Texto', 'type' => \Elementor\Controls_Manager::TEXTAREA ) );

		$defaults = array();
		for ( $i = 1; $i <= 3; $i++ ) {
			$defaults[] = array(
				'title' => $d[ "tech_{$i}_title" ] ?? '',
				'text'  => $d[ "tech_{$i}_text" ] ?? '',
			);
		}

		$this->add_control(
			'items',
			array(
				'label'       => 'Puntos',
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
				<?php if ( ! empty( $s['lead'] ) ) : ?><p class="scn-center lead"><?php echo esc_html( $s['lead'] ); ?></p><?php endif; ?>
				<div class="scn-tech-grid">
					<?php foreach ( $items as $item ) : ?>
						<div class="scn-tech-card">
							<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
							<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
