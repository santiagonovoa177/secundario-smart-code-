<?php
namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget_News extends Widget_Base {

	public function get_name() {
		return 'scn-news';
	}

	public function get_title() {
		return 'SCN News';
	}

	protected function register_controls() {
		$d = function_exists( 'scn_defaults' ) ? scn_defaults() : array();
		$this->start_controls_section( 'content', array( 'label' => 'Contenido' ) );
		$this->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $d['news_title'] ?? '', 'label_block' => true ) );
		$this->add_control( 'subtitle', array( 'label' => 'Subtítulo', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => $d['news_subtitle'] ?? '' ) );

		$repeater = new \Elementor\Repeater();
		$repeater->add_control( 'title', array( 'label' => 'Título', 'type' => \Elementor\Controls_Manager::TEXTAREA ) );
		$repeater->add_control( 'text', array( 'label' => 'Texto', 'type' => \Elementor\Controls_Manager::TEXTAREA ) );
		$repeater->add_control( 'date', array( 'label' => 'Fecha', 'type' => \Elementor\Controls_Manager::TEXT ) );
		$repeater->add_control( 'image', array( 'label' => 'Imagen', 'type' => \Elementor\Controls_Manager::MEDIA ) );

		$defaults = array();
		for ( $i = 1; $i <= 3; $i++ ) {
			$defaults[] = array(
				'title' => $d[ "news_{$i}_title" ] ?? '',
				'text'  => $d[ "news_{$i}_text" ] ?? '',
				'date'  => $d[ "news_{$i}_date" ] ?? '',
				'image' => array( 'url' => $d[ "news_{$i}_image" ] ?? '' ),
			);
		}

		$this->add_control(
			'items',
			array(
				'label'       => 'Noticias',
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
				<div class="scn-news-grid">
					<?php foreach ( $items as $item ) : ?>
						<?php $img = is_array( $item['image'] ?? null ) ? ( $item['image']['url'] ?? '' ) : ''; ?>
						<article class="scn-news-card">
							<?php if ( $img ) : ?>
								<img src="<?php echo esc_url( $img ); ?>" alt="" class="scn-news-card__img" loading="lazy" />
							<?php endif; ?>
							<div class="scn-news-card__body">
								<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
								<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
								<span><?php echo esc_html( $item['date'] ?? '' ); ?></span>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
