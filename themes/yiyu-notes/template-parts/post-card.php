<?php
/** Reusable article card. @package Yiyu_Notes */
?>
<article <?php post_class( 'post-card' ); ?>>
	<div class="post-card-meta">
		<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<?php the_category( ' · ' ); ?>
	</div>
	<div>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="post-card-excerpt"><?php the_excerpt(); ?></div>
	</div>
	<a class="post-card-more" href="<?php the_permalink(); ?>"><?php esc_html_e( '阅读更多 →', 'yiyu-notes' ); ?></a>
</article>
