<?php
/**
 * Theme setup and small, dependency-free enhancements.
 *
 * @package Yiyu_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'YIYU_NOTES_VERSION', '1.3.1' );

function yiyu_notes_setup() {
	load_theme_textdomain( 'yiyu-notes', get_stylesheet_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	register_nav_menus(
		array(
			'primary' => __( '主导航', 'yiyu-notes' ),
			'footer'  => __( '页脚导航', 'yiyu-notes' ),
		)
	);
}
add_action( 'after_setup_theme', 'yiyu_notes_setup' );

function yiyu_notes_assets() {
	wp_enqueue_style( 'yiyu-notes-style', get_stylesheet_uri(), array(), YIYU_NOTES_VERSION );
	wp_enqueue_script( 'yiyu-notes-navigation', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array(), YIYU_NOTES_VERSION, true );
}
/* Blocksy enqueues its main bundle later than the default priority. Load the child last. */
add_action( 'wp_enqueue_scripts', 'yiyu_notes_assets', 100 );

function yiyu_notes_excerpt_length( $length ) {
	return is_admin() ? $length : 72;
}
add_filter( 'excerpt_length', 'yiyu_notes_excerpt_length', 20 );

function yiyu_notes_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'yiyu_notes_excerpt_more' );

function yiyu_notes_customize_register( $customizer ) {
	$customizer->add_section(
		'yiyu_notes_identity',
		array(
			'title'       => __( '晨昏札记 · 站点文案', 'yiyu-notes' ),
			'priority'    => 35,
			'description' => __( '修改首页介绍、联系邮箱和备案号。留空时使用主题默认文案。', 'yiyu-notes' ),
		)
	);

	$fields = array(
		'hero_title' => array(
			'label'   => __( '首页标题', 'yiyu-notes' ),
			'default' => '晨昏札记',
		),
		'hero_description' => array(
			'label'   => __( '首页副标题', 'yiyu-notes' ),
			'default' => '在清晨与黄昏之间，记录技术、生活和一次次真实的尝试。',
		),
		'contact_email' => array(
			'label'    => __( '公开联系邮箱', 'yiyu-notes' ),
			'default'  => 'kinghh826@gmail.com',
			'sanitize' => 'sanitize_email',
		),
		'github_username' => array(
			'label'   => __( 'GitHub 用户名', 'yiyu-notes' ),
			'default' => 'iwxh',
		),
		'icp_number' => array(
			'label'   => __( 'ICP备案号', 'yiyu-notes' ),
			'default' => 'ICP备案号：待填写',
		),
	);

	foreach ( $fields as $key => $field ) {
		$customizer->add_setting(
			'yiyu_notes_' . $key,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => isset( $field['sanitize'] ) ? $field['sanitize'] : 'sanitize_text_field',
			)
		);
		$customizer->add_control(
			'yiyu_notes_' . $key,
			array(
				'label'   => $field['label'],
				'section' => 'yiyu_notes_identity',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'yiyu_notes_customize_register' );

function yiyu_notes_category_url( $slug ) {
	$category = get_category_by_slug( $slug );
	return $category ? get_category_link( $category->term_id ) : yiyu_notes_posts_url();
}

function yiyu_notes_posts_url() {
	$page_id = (int) get_option( 'page_for_posts' );
	return $page_id ? get_permalink( $page_id ) : home_url( '/?post_type=post' );
}

function yiyu_notes_about_url() {
	$page = get_page_by_path( 'about' );
	return $page ? get_permalink( $page ) : home_url( '/about/' );
}

function yiyu_notes_fallback_menu() {
	echo '<ul class="primary-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( '首页', 'yiyu-notes' ) . '</a></li>';
	echo '<li><a href="' . esc_url( yiyu_notes_posts_url() ) . '">' . esc_html__( '文章', 'yiyu-notes' ) . '</a></li>';
	echo '<li><a href="' . esc_url( yiyu_notes_about_url() ) . '">' . esc_html__( '关于我', 'yiyu-notes' ) . '</a></li>';
	echo '</ul>';
}

function yiyu_notes_meta_description() {
	if ( is_admin() || defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}

	$description = '';
	if ( is_front_page() ) {
		$description = get_bloginfo( 'description' );
	} elseif ( is_singular() ) {
		$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', get_queried_object_id() ) ), 45 );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$description = term_description() ? wp_strip_all_tags( term_description() ) : single_term_title( '', false );
	}

	if ( $description ) {
		echo '<meta name="description" content="' . esc_attr( wp_trim_words( $description, 45 ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'yiyu_notes_meta_description', 2 );

/**
 * Return a tiny inline SVG icon without loading an icon font or library.
 *
 * @param string $name Icon name.
 * @return string
 */
function yiyu_notes_icon( $name ) {
	$icons = array(
		'email'  => '<svg class="contact-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M3 6.75A1.75 1.75 0 0 1 4.75 5h14.5A1.75 1.75 0 0 1 21 6.75v10.5A1.75 1.75 0 0 1 19.25 19H4.75A1.75 1.75 0 0 1 3 17.25V6.75Z" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="m4 7 8 6 8-6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'gmail'  => '<svg class="contact-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 18V7.5L12 13l8-5.5V18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 7.5A1.5 1.5 0 0 1 6.35 6.27L12 10.2l5.65-3.93A1.5 1.5 0 0 1 20 7.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
		'github' => '<svg class="contact-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.48v-1.87c-2.78.6-3.37-1.18-3.37-1.18-.45-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.61.07-.61 1 .07 1.53 1.03 1.53 1.03.9 1.53 2.35 1.09 2.92.83.09-.65.35-1.09.64-1.34-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.64 0 0 .84-.27 2.75 1.02A9.58 9.58 0 0 1 12 6.82a9.6 9.6 0 0 1 2.5.34c1.91-1.29 2.75-1.02 2.75-1.02.55 1.37.2 2.39.1 2.64.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.86v2.76c0 .27.18.58.69.48A10 10 0 0 0 12 2Z"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}
