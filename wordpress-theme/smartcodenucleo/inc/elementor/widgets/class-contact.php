<?php
namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget_Contact extends Widget_Base {

	public function get_name() {
		return 'scn-contact';
	}

	public function get_title() {
		return 'SCN Contacto';
	}

	protected function register_controls() {
		$d = function_exists( 'scn_defaults' ) ? scn_defaults() : array();
		$this->start_controls_section( 'content', array( 'label' => 'Contenido' ) );
		$this->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['connect_title'] ?? '', 'label_block' => true ) );
		$this->add_control( 'subtitle', array( 'label' => 'Subtítulo', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['connect_subtitle'] ?? '', 'label_block' => true ) );
		$this->add_control( 'text', array( 'label' => 'Texto', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['connect_text'] ?? '' ) );
		$this->add_control( 'email', array( 'label' => 'Email', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['connect_email'] ?? '' ) );
		$this->add_control( 'button_label', array( 'label' => 'Texto del botón', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Connect' ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s  = $this->get_settings_for_display();
		$id = 'email-' . $this->get_id();
		?>
		<section class="scn-section scn-page scn-contact-section">
			<div class="scn-container">
				<div class="scn-contact">
					<header class="scn-page-header">
						<?php if ( ! empty( $s['title'] ) ) : ?><h2><?php echo esc_html( $s['title'] ); ?></h2><?php endif; ?>
						<?php if ( ! empty( $s['subtitle'] ) ) : ?><p class="subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p><?php endif; ?>
					</header>
					<?php if ( ! empty( $s['text'] ) ) : ?><p class="lead"><?php echo esc_html( $s['text'] ); ?></p><?php endif; ?>
					<?php if ( ! empty( $s['email'] ) ) : ?>
						<p><a class="accent-link" href="mailto:<?php echo esc_attr( $s['email'] ); ?>"><?php echo esc_html( $s['email'] ); ?></a></p>
					<?php endif; ?>
					<form class="scn-form" onsubmit="event.preventDefault(); alert('Thanks! We will reach out.');">
						<label class="sr-only" for="<?php echo esc_attr( $id ); ?>">Business email</label>
						<div class="scn-form__row">
							<input id="<?php echo esc_attr( $id ); ?>" type="email" required placeholder="Enter your business e-mail" />
							<button type="submit" class="btn btn-primary"><?php echo esc_html( $s['button_label'] ?: 'Connect' ); ?></button>
						</div>
					</form>
				</div>
			</div>
		</section>
		<?php
	}
}
