<?php
/** Comments are shown only when WordPress already allows them. @package Yiyu_Notes */
if ( post_password_required() ) { return; }
?>
<section class="comments-area">
	<?php if ( have_comments() ) : ?><h2><?php echo esc_html( get_comments_number() ); ?> 条评论</h2><ol class="comment-list"><?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true ) ); ?></ol><?php the_comments_navigation(); endif; ?>
	<?php if ( comments_open() ) { comment_form(); } ?>
</section>
