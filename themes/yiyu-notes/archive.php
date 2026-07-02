<?php
/** Taxonomy and date archives. @package Yiyu_Notes */
get_header();
?>
<header class="page-header">
	<div class="site-shell page-header-inner">
		<p class="eyebrow">Archive</p>
		<h1><?php the_archive_title(); ?></h1>
		<?php the_archive_description( '<div class="section-note">', '</div>' ); ?>
	</div>
</header>
<?php get_template_part( 'template-parts/archive', 'filters' ); ?>
<div class="site-shell archive-list">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part( 'template-parts/post', 'card' ); endwhile; the_posts_pagination( array( 'prev_text' => '←', 'next_text' => '→' ) ); else : ?>
		<p class="empty-state">这里还没有内容。</p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
