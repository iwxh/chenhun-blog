<?php
/** Default page. @package Yiyu_Notes */
get_header();
while ( have_posts() ) : the_post();
?>
<article class="single-wrap">
	<header class="entry-header"><p class="eyebrow">Page</p><h1><?php the_title(); ?></h1></header>
	<div class="entry-content"><?php the_content(); ?></div>
</article>
<?php endwhile; get_footer(); ?>
