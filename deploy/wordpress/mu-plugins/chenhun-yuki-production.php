<?php
/**
 * Production presentation layer for the official Yuki Elegant theme.
 *
 * Keeps site-specific copy and layout outside the third-party theme so that
 * official theme updates do not overwrite the site's customizations.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (get_option('stylesheet') !== 'yuki-elegant') {
    return;
}

if (!defined('YUKI_DISABLE_HOMEPAGE_BUILDER')) {
    define('YUKI_DISABLE_HOMEPAGE_BUILDER', true);
}

add_shortcode('chenhun_latest_posts', static function (): string {
    $query = new WP_Query(array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 6,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ));

    if (!$query->have_posts()) {
        return '<p class="chenhun-empty">暂时还没有文章。</p>';
    }

    ob_start();
    echo '<div class="chenhun-post-list">';
    while ($query->have_posts()) {
        $query->the_post();
        $categories = get_the_category();
        echo '<article class="chenhun-post-card">';
        echo '<div class="chenhun-post-meta"><time datetime="' . esc_attr(get_the_date(DATE_W3C)) . '">' . esc_html(get_the_date('Y年n月j日')) . '</time>';
        if ($categories) {
            echo '<span aria-hidden="true">·</span><a href="' . esc_url(get_category_link($categories[0])) . '">' . esc_html($categories[0]->name) . '</a>';
        }
        echo '</div>';
        echo '<h3><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h3>';
        echo '<p>' . esc_html(wp_trim_words(get_the_excerpt(), 42, '…')) . '</p>';
        echo '<a class="chenhun-read-more" href="' . esc_url(get_permalink()) . '">继续阅读 <span aria-hidden="true">→</span></a>';
        echo '</article>';
    }
    echo '</div>';
    wp_reset_postdata();

    return (string) ob_get_clean();
});

add_shortcode('chenhun_categories', static function (): string {
    $categories = get_categories(array('hide_empty' => false));
    if (!$categories) {
        return '';
    }

    $output = '<div class="chenhun-category-list">';
    foreach ($categories as $category) {
        $output .= '<a href="' . esc_url(get_category_link($category)) . '">';
        $output .= '<span>' . esc_html($category->name) . '</span>';
        $output .= '<small>' . esc_html((string) $category->count) . ' 篇</small>';
        $output .= '</a>';
    }
    $output .= '</div>';

    return $output;
});

add_action('wp_enqueue_scripts', static function (): void {
    wp_register_style('chenhun-yuki-production', false, array(), '1.0.0');
    wp_enqueue_style('chenhun-yuki-production');
    wp_add_inline_style('chenhun-yuki-production', <<<'CSS'
:root {
    --chenhun-ink: #202326;
    --chenhun-muted: #6f7479;
    --chenhun-line: #e8e4de;
    --chenhun-paper: #fffdf9;
    --chenhun-accent: #876c4f;
}
body {
    color: var(--chenhun-ink);
    background: var(--chenhun-paper);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", sans-serif;
    text-rendering: optimizeLegibility;
}
.yuki-container { max-width: 1160px; }
.chenhun-home,
.chenhun-about { max-width: 1040px; margin: 0 auto; }
.chenhun-hero { padding: clamp(3.5rem, 9vw, 7rem) 0 clamp(2.5rem, 6vw, 5rem); border-bottom: 1px solid var(--chenhun-line); }
.chenhun-kicker { margin: 0 0 1rem; color: var(--chenhun-accent); font-size: .78rem; font-weight: 700; letter-spacing: .18em; text-transform: uppercase; }
.chenhun-hero h1 { margin: 0; font-size: clamp(2.35rem, 7vw, 4.75rem); line-height: 1.08; letter-spacing: -.045em; }
.chenhun-hero p:last-child { max-width: 640px; margin: 1.4rem 0 0; color: var(--chenhun-muted); font-size: clamp(1rem, 2vw, 1.2rem); line-height: 1.9; }
.chenhun-section { padding: clamp(2.75rem, 6vw, 4.75rem) 0; }
.chenhun-section + .chenhun-section { border-top: 1px solid var(--chenhun-line); }
.chenhun-section-heading { display: flex; align-items: baseline; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; }
.chenhun-section-heading h2 { margin: 0; font-size: clamp(1.45rem, 3vw, 2rem); }
.chenhun-section-heading a { color: var(--chenhun-muted); font-size: .9rem; text-decoration: none; }
.chenhun-post-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0 2.5rem; }
.chenhun-post-card { padding: 1.65rem 0 1.8rem; border-top: 1px solid var(--chenhun-line); }
.chenhun-post-card h3 { margin: .55rem 0 .7rem; font-size: 1.28rem; line-height: 1.45; }
.chenhun-post-card h3 a { color: var(--chenhun-ink); text-decoration: none; }
.chenhun-post-card p { margin: 0 0 1rem; color: var(--chenhun-muted); font-size: .95rem; line-height: 1.75; }
.chenhun-post-meta { display: flex; flex-wrap: wrap; gap: .45rem; color: var(--chenhun-muted); font-size: .78rem; }
.chenhun-post-meta a,
.chenhun-read-more { color: var(--chenhun-accent); text-decoration: none; }
.chenhun-read-more { font-size: .88rem; font-weight: 650; }
.chenhun-category-list { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: .75rem; }
.chenhun-category-list a { display: flex; justify-content: space-between; gap: 1rem; padding: 1rem 1.1rem; color: var(--chenhun-ink); border: 1px solid var(--chenhun-line); border-radius: 10px; text-decoration: none; transition: border-color .2s ease, transform .2s ease; }
.chenhun-category-list a:hover { border-color: var(--chenhun-accent); transform: translateY(-2px); }
.chenhun-category-list small { color: var(--chenhun-muted); white-space: nowrap; }
.chenhun-about { padding: clamp(2.5rem, 7vw, 5rem) 0; }
.chenhun-about h2 { margin-top: 2.4rem; }
.chenhun-contact-list { list-style: none; padding: 0; }
.chenhun-contact-list li { margin: .65rem 0; }
.chenhun-contact-list a { color: var(--chenhun-accent); }
.yuki-article-content,
.entry-content { font-size: 17px; line-height: 1.9; }
.single .yuki-article-content,
.single .entry-content { max-width: 760px; margin-left: auto; margin-right: auto; font-size: 17px !important; line-height: 1.9 !important; }
.yuki-article-content p,
.entry-content p { margin-top: 0; margin-bottom: 1.25em; }
.yuki-article-content blockquote,
.entry-content blockquote { margin: 1.8rem 0; padding: .35rem 0 .35rem 1.25rem; color: #555; border-left: 3px solid var(--chenhun-accent); }
.yuki-article-content pre,
.entry-content pre { overflow-x: auto; padding: 1.2rem; border-radius: 8px; font-size: .88em; line-height: 1.7; }
.yuki-article-content img,
.entry-content img { height: auto; border-radius: 8px; }
.chenhun-site-info { margin-top: 2rem; padding: 1.4rem 1rem; color: var(--chenhun-muted); border-top: 1px solid var(--chenhun-line); text-align: center; font-size: .82rem; line-height: 1.8; }
.chenhun-site-info a { color: inherit; text-decoration: none; }
.chenhun-site-info a:hover { color: var(--chenhun-accent); }
.chenhun-site-info span + span::before { content: " · "; margin: 0 .35rem; }
.yuki-socials-custom,
.yuki-footer-row-top,
.yuki_footer_el_copyright { display: none !important; }
@media (max-width: 767px) {
    .chenhun-post-list { grid-template-columns: 1fr; }
    .chenhun-category-list { grid-template-columns: 1fr; }
    .chenhun-hero { padding-top: 3rem; }
    .chenhun-section-heading { align-items: flex-start; }
    .yuki-article-content,
    .entry-content { font-size: 16px !important; line-height: 1.85 !important; }
    .chenhun-site-info span { display: block; }
    .chenhun-site-info span + span::before { content: none; }
}
CSS
    );
}, 20);

add_action('wp_footer', static function (): void {
    $profile = wp_parse_args((array) get_option('chenhun_public_profile', array()), array(
        'email'  => 'kinghh826@gmail.com',
        'github' => 'iwxh',
        'icp'    => 'ICP备案号：待填写',
    ));
    ?>
    <div class="chenhun-site-info" role="contentinfo">
        <span>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?></span>
        <span><?php echo esc_html($profile['icp']); ?></span>
        <span><a href="mailto:<?php echo esc_attr(antispambot($profile['email'])); ?>"><?php echo esc_html(antispambot($profile['email'])); ?></a></span>
        <span><a href="<?php echo esc_url('https://github.com/' . rawurlencode($profile['github'])); ?>" rel="me noopener" target="_blank">GitHub: <?php echo esc_html($profile['github']); ?></a></span>
    </div>
    <?php
}, 5);
