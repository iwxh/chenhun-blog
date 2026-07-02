<?php
/** Compact category filters. @package Yiyu_Notes */
$categories = get_categories( array( 'hide_empty' => true, 'number' => 12 ) );
?>
<nav class="site-shell filter-nav" aria-label="<?php esc_attr_e( '文章分类筛选', 'yiyu-notes' ); ?>">
	<a class="<?php echo is_home() ? 'is-current' : ''; ?>" href="<?php echo esc_url( yiyu_notes_posts_url() ); ?>">全部</a>
	<?php foreach ( $categories as $category ) : ?>
		<a class="<?php echo is_category( $category->term_id ) ? 'is-current' : ''; ?>" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
	<?php endforeach; ?>
</nav>
