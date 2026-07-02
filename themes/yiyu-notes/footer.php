<?php
/** Site footer. @package Yiyu_Notes */
$email  = get_theme_mod( 'yiyu_notes_contact_email', 'kinghh826@gmail.com' );
$github = get_theme_mod( 'yiyu_notes_github_username', 'iwxh' );
$icp    = get_theme_mod( 'yiyu_notes_icp_number', 'ICP备案号：待填写' );
?>
</main>
<footer class="site-footer">
	<div class="site-shell">
		<div class="footer-main">
			<div>
				<p class="footer-title"><?php bloginfo( 'name' ); ?></p>
				<p class="footer-description">记录技术、生活与日常尝试。晨昏之间，慢慢沉淀。</p>
			</div>
			<div class="footer-links">
				<a class="button button-quiet" href="<?php echo esc_url( yiyu_notes_about_url() ); ?>">关于我</a>
				<a class="contact-link" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo yiyu_notes_icon( 'email' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span class="contact-value"><?php echo esc_html( antispambot( $email ) ); ?></span></span></a>
				<a class="contact-link" href="<?php echo esc_url( 'https://github.com/' . rawurlencode( $github ) ); ?>" rel="me noopener" target="_blank"><?php echo yiyu_notes_icon( 'github' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span class="contact-value"><?php echo esc_html( $github ); ?></span></span></a>
			</div>
		</div>
		<div class="footer-meta">
			<span>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
			<span><?php echo esc_html( $icp ); ?></span>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
