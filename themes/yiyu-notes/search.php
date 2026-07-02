<?php
/** Search results. @package Yiyu_Notes */
get_header();
?>
<header class="page-header">
	<div class="site-shell page-header-inner">
		<p class="eyebrow">Search</p>
		<h1><?php printf( esc_html__( '“%s”的搜索结果', 'yiyu-notes' ), esc_html( get_search_query() ) ); ?></h1>
	</div>
</header>
<div class="site-shell archive-list">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part( 'template-parts/post', 'card' ); endwhile; the_posts_pagination( array( 'prev_text' => '←', 'next_text' => '→' ) ); else : ?>
		<p class="empty-state">没有找到相关内容，可以换一个关键词试试。</p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
