<?php
/** Personal homepage. @package Yiyu_Notes */
get_header();

$hero_title = get_theme_mod( 'yiyu_notes_hero_title', '晨昏札记' );
$hero_desc  = get_theme_mod( 'yiyu_notes_hero_description', '在清晨与黄昏之间，记录生活片段、日常思考、和技术尝试。' );
$email      = get_theme_mod( 'yiyu_notes_contact_email', 'kinghh826@gmail.com' );
$github     = get_theme_mod( 'yiyu_notes_github_username', 'iwxh' );
$categories = array(
    array( '随笔札记', 'notes', '放一些没有明确分类，但值得留下的想法。' ),
	array( '随口吐槽', 'ai-tools', '闲言碎语，无厘头，毫无逻辑的情绪片段' ),
	array( '技术折腾', 'tech', '记录服务器、代码、数据库、工具和各种问题排查。' ),
	array( '独立站记录', 'indie-web', '记录从域名、服务器、备案到内容优化的过程。' ),
	array( '城市生活', 'city-life', '记录城市里的观察、压力、选择和感受。' ),
	array( '摄影设备', 'photography', '记录相机、镜头、配件和日常拍摄体验。' ),
	
);
$sticky_ids = array_slice( get_option( 'sticky_posts', array() ), 0, 5 );
?>
<section class="hero">
	<div class="site-shell hero-grid">
		<div>
			<p class="eyebrow">Personal notes · 晨昏之间</p>
			<h1><?php echo esc_html( $hero_title ); ?></h1>
			<p class="hero-lead"><?php echo esc_html( $hero_desc ); ?></p>
			<div class="button-row">
				<a class="button" href="<?php echo esc_url( yiyu_notes_posts_url() ); ?>"><?php esc_html_e( '查看文章', 'yiyu-notes' ); ?></a>
				<a class="button button-quiet" href="<?php echo esc_url( yiyu_notes_about_url() ); ?>"><?php esc_html_e( '关于我', 'yiyu-notes' ); ?></a>
			</div>
		</div>
		<aside class="record-card" aria-label="<?php esc_attr_e( '站点说明', 'yiyu-notes' ); ?>">
			<span class="record-card-label">MORNING TO DUSK</span>
			<blockquote>“晨昏之间，慢慢记录。<br>有开始，也有重来。”</blockquote>
			<time datetime="<?php echo esc_attr( wp_date( 'Y-m' ) ); ?>"><?php echo esc_html( wp_date( 'Y.m' ) ); ?> · 持续更新</time>
		</aside>
	</div>
</section>

<section class="home-section">
	<div class="site-shell about-strip">
		<h2>你好，欢迎访问 
		<br><br>
		kinghh的blog。
		<br><br>
		晨昏札记
		</h2>
		<div class="about-strip-copy">
			<p>一个99年程序员在大浪淘沙的时代，提前布局自己的人生危机，当前时代不允许任何人原地踏步。</p>
			<p>普通程序员在危机下的自我拯救，也期待新的时代Ai会让我们走的越来越远。</p>
			<p>千里之行始于足下</p>
			<p>钱塘江上潮信来，今日方知我是我</p>
			<p>愿我们跳脱世俗，抵达自己心中圣地</p>
			<div class="intro-actions">
				<a class="button button-quiet" href="<?php echo esc_url( yiyu_notes_about_url() ); ?>">查看完整介绍</a>
				<div class="contact-links" aria-label="联系方式">
					<a class="contact-link" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo yiyu_notes_icon( 'email' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><span class="contact-label">邮箱</span><br><span class="contact-value"><?php echo esc_html( antispambot( $email ) ); ?></span></span></a>
					<a class="contact-link" href="<?php echo esc_url( 'https://github.com/' . rawurlencode( $github ) ); ?>" rel="me noopener" target="_blank"><?php echo yiyu_notes_icon( 'github' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><span class="contact-label">GitHub</span><br><span class="contact-value"><?php echo esc_html( $github ); ?></span></span></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="home-section" id="latest-posts">
	<div class="site-shell">
		<div class="section-head">
			<div><h2 class="section-title">最近写下的</h2><p class="section-note">新的尝试、踩坑和生活片段。</p></div>
			<a class="text-link" href="<?php echo esc_url( yiyu_notes_posts_url() ); ?>">全部文章 →</a>
		</div>
		<div class="post-grid">
			<?php
			$latest = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 6, 'ignore_sticky_posts' => true ) );
			if ( $latest->have_posts() ) :
				while ( $latest->have_posts() ) :
					$latest->the_post();
					get_template_part( 'template-parts/post', 'card' );
				endwhile;
			else :
				?>
				<p class="empty-state">文章正在整理中。第一篇记录，会从这里开始。</p>
			<?php endif; wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<section class="home-section">
	<div class="site-shell">
		<div class="section-head"><div><h2 class="section-title">沿着这些方向</h2><p class="section-note">技术与生活并不分家，它们共同组成日常。</p></div></div>
		<div class="category-grid">
			<?php foreach ( $categories as $index => $category ) : ?>
				<a class="category-card" href="<?php echo esc_url( yiyu_notes_category_url( $category[1] ) ); ?>">
					<span class="category-index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
					<strong><?php echo esc_html( $category[0] ); ?></strong>
					<small><?php echo esc_html( $category[2] ); ?></small>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php if ( $sticky_ids ) : ?>
	<section class="home-section">
		<div class="site-shell">
			<div class="section-head"><div><h2 class="section-title">值得再读一遍</h2><p class="section-note">一些认真整理过的记录。</p></div></div>
			<div class="featured-list">
				<?php
				$featured = new WP_Query( array( 'post__in' => $sticky_ids, 'orderby' => 'post__in', 'posts_per_page' => 5, 'ignore_sticky_posts' => true ) );
				$i = 1;
				while ( $featured->have_posts() ) : $featured->the_post();
					?>
					<a class="featured-item" href="<?php the_permalink(); ?>"><span class="featured-number"><?php echo esc_html( sprintf( '%02d', $i++ ) ); ?></span><strong><?php the_title(); ?></strong><span>阅读 →</span></a>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php get_footer(); ?>
