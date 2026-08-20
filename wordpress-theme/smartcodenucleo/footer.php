<footer class="scn-footer">
	<section class="scn-footer__top">
		<div class="scn-footer__contact-row">
			<span class="scn-footer__meta-item">
				<span class="scn-footer__icon" aria-hidden="true">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s7-4.5 7-11a7 7 0 1 0-14 0c0 6.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
				</span>
				<?php scn_text( 'footer_location' ); ?>
			</span>
			<a class="scn-footer__meta-item" href="mailto:<?php scn_attr( 'connect_email' ); ?>">
				<span class="scn-footer__icon" aria-hidden="true">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 7 9-7"/></svg>
				</span>
				<?php scn_text( 'connect_email' ); ?>
			</a>
		</div>
	</section>

	<section class="scn-footer__bottom">
		<div class="scn-footer__line"></div>
		<div class="scn-social">
			<a href="<?php scn_url( 'linkedin_url' ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.5 8.5A2 2 0 1 1 6.5 4.5a2 2 0 0 1 0 4zm.25 1.75H4.25V20h2.5V10.25zM10 10.25V20h2.5v-5.1c0-1.35.96-2.15 2.12-2.15 1.1 0 1.63.75 1.63 2.15V20H19v-5.7c0-3.05-1.63-4.47-3.81-4.47-1.76 0-2.54.97-2.97 1.65h-.04v-1.23H10z"/></svg>
			</a>
			<a href="<?php scn_url( 'facebook_url' ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14 9h3V6h-3c-2.2 0-4 1.8-4 4v2H8v3h2v7h3v-7h2.6l.4-3H13v-2c0-.6.4-1 1-1z"/></svg>
			</a>
			<a href="<?php scn_url( 'twitter_url' ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M19.6 7.3c.5-.3.8-.7 1-1.2-.5.3-1 .5-1.6.6A2.5 2.5 0 0 0 12.6 8c0 .2 0 .4.1.6-2.1-.1-4-1.1-5.3-2.7-.2.4-.3.8-.3 1.2 0 .9.4 1.6 1.1 2.1-.4 0-.8-.1-1.1-.3v.1c0 1.2.9 2.2 2 2.5-.2.1-.5.1-.7.1-.2 0-.3 0-.5-.1.3 1 1.2 1.8 2.3 1.8A5 5 0 0 1 5 16.2a7.1 7.1 0 0 0 3.8 1.1c4.6 0 7.1-3.8 7.1-7.1v-.3c.5-.3.9-.8 1.2-1.3z"/></svg>
			</a>
			<a href="<?php scn_url( 'instagram_url' ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 7.2A4.8 4.8 0 1 0 12 16.8 4.8 4.8 0 0 0 12 7.2zm0 7.9a3.1 3.1 0 1 1 0-6.2 3.1 3.1 0 0 1 0 6.2zm5.1-8.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0zM12 4.5c-2 0-2.3 0-3.1.1-.8 0-1.4.2-1.9.4a3.9 3.9 0 0 0-2.2 2.2c-.2.5-.3 1.1-.4 1.9-.1.8-.1 1.1-.1 3.1s0 2.3.1 3.1c0 .8.2 1.4.4 1.9a3.9 3.9 0 0 0 2.2 2.2c.5.2 1.1.3 1.9.4.8.1 1.1.1 3.1.1s2.3 0 3.1-.1c.8 0 1.4-.2 1.9-.4a3.9 3.9 0 0 0 2.2-2.2c.2-.5.3-1.1.4-1.9.1-.8.1-1.1.1-3.1s0-2.3-.1-3.1c0-.8-.2-1.4-.4-1.9a3.9 3.9 0 0 0-2.2-2.2c-.5-.2-1.1-.3-1.9-.4-.8-.1-1.1-.1-3.1-.1zm0 1.5c2 0 2.2 0 3 .1.7 0 1.1.2 1.4.3.4.2.7.4 1 .7.3.3.5.6.7 1 .1.3.2.7.3 1.4.1.8.1 1 .1 3s0 2.2-.1 3c0 .7-.2 1.1-.3 1.4-.2.4-.4.7-.7 1-.3.3-.6.5-1 .7-.3.1-.7.2-1.4.3-.8.1-1 .1-3 .1s-2.2 0-3-.1c-.7 0-1.1-.2-1.4-.3-.4-.2-.7-.4-1-.7-.3-.3-.5-.6-.7-1-.1-.3-.2-.7-.3-1.4-.1-.8-.1-1-.1-3s0-2.2.1-3c0-.7.2-1.1.3-1.4.2-.4.4-.7.7-1 .3-.3.6-.5 1-.7.3-.1.7-.2 1.4-.3.8-.1 1-.1 3-.1z"/></svg>
			</a>
		</div>
		<p class="scn-footer__copy">© <?php echo esc_html( gmdate( 'Y' ) ); ?> Smart Code Núcleo. All rights reserved.</p>
	</section>
</footer>

<?php wp_footer(); ?>
</body>
</html>
