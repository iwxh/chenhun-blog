# 晨昏札记 · Yuki Elegant 生产配置

生产站使用 WordPress 官方主题包：

- Yuki `1.4.17`（父主题）
- Yuki Elegant `1.0.2`（子主题）

官方来源：

- `https://downloads.wordpress.org/theme/yuki.1.4.17.zip`
- `https://downloads.wordpress.org/theme/yuki-elegant.1.0.2.zip`

站点自身的首页、文章排版、分类入口和页脚样式由
`mu-plugins/chenhun-yuki-production.php` 提供。它不会修改官方主题源码，升级主题时不会覆盖这些配置。

部署适配层：

```bash
install -o www-data -g www-data -m 0644 \
  deploy/wordpress/mu-plugins/chenhun-yuki-production.php \
  /path/to/wordpress/html/wp-content/mu-plugins/chenhun-yuki-production.php
```

生产切换前必须同时备份数据库、整个 WordPress 目录和 Nginx 配置。需要回滚时，先恢复数据库和 WordPress 文件，再重载 Nginx；也可以在数据库备份完好的前提下先切回 `yiyu-notes` 主题进行应急恢复。
