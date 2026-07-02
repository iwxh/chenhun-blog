<?php
/** Required fallback template. @package Yiyu_Notes */
get_header();
?>
<header class="page-header"><div class="site-shell page-header-inner"><p class="eyebrow">Notes</p><h1><?php bloginfo( 'name' ); ?></h1></div></header>
<div class="site-shell archive-list">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part( 'template-parts/post', 'card' ); endwhile; the_posts_pagination(); else : ?><p class="empty-state">暂时没有内容。</p><?php endif; ?>
</div>
<?php get_footer(); ?>
