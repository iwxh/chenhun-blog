<?php
/** Posts index. @package Yiyu_Notes */
get_header();
?>
<header class="page-header">
	<div class="site-shell page-header-inner">
		<p class="eyebrow">Writing</p>
		<h1><?php single_post_title(); ?></h1>
		<p>按时间留下的技术折腾、生活观察与阶段性复盘。</p>
	</div>
</header>
<?php get_template_part( 'template-parts/archive', 'filters' ); ?>
<div class="site-shell archive-list">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part( 'template-parts/post', 'card' ); endwhile; the_posts_pagination( array( 'prev_text' => '←', 'next_text' => '→' ) ); else : ?>
		<p class="empty-state">暂时还没有文章。</p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
