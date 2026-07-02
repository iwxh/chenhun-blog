<?php
/**
 * Template Name: 关于我
 * Template Post Type: page
 * @package Yiyu_Notes
 */
get_header();
$email  = get_theme_mod( 'yiyu_notes_contact_email', 'kinghh826@gmail.com' );
$github = get_theme_mod( 'yiyu_notes_github_username', 'iwxh' );
?>
<article class="site-shell about-page">
	<header class="about-intro">
		<p class="eyebrow">About</p>
		<h1>关于我</h1>
		<p>你好，我是kinghh。这个人网站，用来存放我在技术、生活各种碎片化的内容。</p>
	</header>
	<section class="about-section">
		<h2>我是谁</h2>
		<div class="about-copy">
			<p>热爱生活，记录生活，千万北漂人中的其中一个。</p>
		</div>
	</section>
	<section class="about-section">
		<h2>这里会记录</h2>
		<div class="about-copy">
			<ul>
				<li>服务器和网站搭建过程</li>
				<li>WordPress、宝塔、MySQL、Docker 等技术折腾</li>
				<li>Java 和工作中遇到的一些问题</li>
				<li>AI 工具在实际工作和生活中的使用</li>
				<li>独立站、普通人做项目的尝试</li>
				<li>北京生活中的观察和感受</li>
				<li>相机、镜头、三脚架和日常拍摄记录</li>
				<li>阶段性的复盘、迷茫和重新选择</li>
			</ul>
		</div>
	</section>
	<section class="about-section">
		<h2>为什么做这个站</h2>
		<div class="about-copy">
			<p>我折腾过太多东西，很多过程如果只留在聊天记录、截图和临时笔记里，很快就会散掉。所以我想把这些过程慢慢整理下来。</p>
			<p>如果你也正在折腾网站、服务器、AI 工具、个人项目，或者只是想看看一个普通人如何一步步试错，这里也许能给你一点参考。</p>
			<p><strong>晨昏之间，慢慢记录。</strong></p>
		</div>
	</section>
	<section class="about-section">
		<h2>联系</h2>
		<div class="about-copy">
			<div class="contact-note">
				<ul class="contact-list">
					<li><a class="contact-link" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo yiyu_notes_icon( 'email' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><span class="contact-label">邮箱</span><br><span class="contact-value"><?php echo esc_html( antispambot( $email ) ); ?></span></span></a></li>
					<li><a class="contact-link" href="<?php echo esc_url( 'https://github.com/' . rawurlencode( $github ) ); ?>" rel="me noopener" target="_blank"><?php echo yiyu_notes_icon( 'github' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><span class="contact-label">GitHub</span><br><span class="contact-value"><?php echo esc_html( $github ); ?></span></span></a></li>
				</ul>
			</div>
		</div>
	</section>
</article>
<?php get_footer(); ?>
