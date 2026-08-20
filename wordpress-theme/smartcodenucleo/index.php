<?php
/**
 * Fallback index.
 *
 * @package smartcodenucleo
 */

get_header();
?>

<main class="scn-main scn-page">
	<div class="scn-container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>
				</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
