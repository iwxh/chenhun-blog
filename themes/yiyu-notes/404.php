<?php
/** Not found. @package Yiyu_Notes */
get_header();
?>
<section class="site-shell page-header"><div class="page-header-inner"><p class="eyebrow">404</p><h1>这一页暂时找不到</h1><p>可能是链接发生了变化，也可能这篇记录还没写完。</p><div class="button-row"><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">返回首页</a><a class="button button-quiet" href="<?php echo esc_url( yiyu_notes_posts_url() ); ?>">查看文章</a></div></div></section>
<?php get_footer(); ?>
