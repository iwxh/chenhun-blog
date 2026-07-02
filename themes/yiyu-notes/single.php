<?php
/** Single post. @package Yiyu_Notes */
get_header();
while ( have_posts() ) : the_post();
?>
<article <?php post_class( 'single-wrap' ); ?>>
	<header class="entry-header">
		<div class="entry-meta"><?php the_category( ' · ' ); ?><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></div>
		<h1><?php the_title(); ?></h1>
		<?php if ( has_excerpt() ) : ?><p class="hero-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
	</header>
	<div class="entry-content"><?php the_content(); wp_link_pages(); ?></div>
	<?php if ( has_tag() ) : ?><div class="entry-tags" aria-label="<?php esc_attr_e( '文章标签', 'yiyu-notes' ); ?>"><?php the_tags( '', '' ); ?></div><?php endif; ?>
	<?php
	$previous = get_previous_post();
	$next     = get_next_post();
	if ( $previous || $next ) :
	?>
	<nav class="post-navigation" aria-label="<?php esc_attr_e( '相邻文章', 'yiyu-notes' ); ?>">
		<div><?php if ( $previous ) : ?><a href="<?php echo esc_url( get_permalink( $previous ) ); ?>"><span class="nav-kicker">上一篇</span><?php echo esc_html( get_the_title( $previous ) ); ?></a><?php endif; ?></div>
		<div class="nav-next"><?php if ( $next ) : ?><a href="<?php echo esc_url( get_permalink( $next ) ); ?>"><span class="nav-kicker">下一篇</span><?php echo esc_html( get_the_title( $next ) ); ?></a><?php endif; ?></div>
	</nav>
	<?php endif; ?>
	<p class="back-home"><a class="button button-quiet" href="<?php echo esc_url( home_url( '/' ) ); ?>">返回首页</a></p>
	<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
</article>
<?php endwhile; get_footer(); ?>
