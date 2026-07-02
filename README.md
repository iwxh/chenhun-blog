# 晨昏札记

晨昏札记的本地开发与部署仓库。初始主题源码于 2026-07-02 从生产服务器导入。

## 仓库内容

- `themes/yiyu-notes/`：当前自定义 WordPress 子主题源码。
- `docker-compose.yml`：隔离的本地 WordPress + MySQL 开发环境。
- `deploy/docker-compose.production.yml`：服务器当前使用的宝塔 Docker Compose 配置，仅作部署参考。

文章、菜单、用户和站点设置保存在生产数据库中；图片保存在 `wp-content/uploads`。这些运行数据和真实密钥不纳入 Git。

## 本地启动

1. 复制 `.env.example` 为 `.env`，并修改其中的本地密码。
2. 运行 `docker compose up -d`。
3. 打开 `http://localhost:8080` 完成 WordPress 本地初始化。
4. 在后台安装父主题 **Blocksy**，然后启用 **晨昏札记（yiyu-notes）**。

当前主题由 PHP、CSS 和原生 JavaScript 组成，不需要前端编译。修改 `themes/yiyu-notes/` 后刷新浏览器即可查看效果。

## 发布原则

只发布 `themes/yiyu-notes/`，不要用本地数据库覆盖生产数据库，也不要把 `.env`、数据库备份或上传文件提交到 Git。

正式发布前应检查 PHP 语法、备份线上主题，并保留上一个可回滚版本。

