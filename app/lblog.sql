SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `lblog_blog_account`;
CREATE TABLE `lblog_blog_account` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lblog_blog_account` VALUES ('1', '1', '1');


DROP TABLE IF EXISTS `lblog_blog_archives`;
CREATE TABLE `lblog_blog_archives` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `catid` int(11) NOT NULL default '0',
  `title` varchar(250) NOT NULL,
  `abstract` text,
  `content` text NOT NULL,
  `createtime` bigint(20) unsigned NOT NULL default '0',
  `is_active` enum('Y','N') NOT NULL default 'N',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Blog archives';

INSERT INTO `lblog_blog_archives` VALUES ('1', '1', '1', '欢迎使用 LBLOG！', null, '<div class=\"intro\">\r\n\r\n<p>欢迎使用 LBLOG 开始您的博客之旅！</p>\r\n\r\n<p>LBlog 是一款基于 LMLPHP 和 LMLJS 框架的开源博客兼 CMS 系统，它拥有轻量级高性能特点和更加灵活的二次开发支持。系统拥有优秀的 SEO 支持；基于 QQ 和新浪微博的账户系统；独创的异步加载让网站跑的更快！</p>\r\n\r\n<p>使用 LBLOG 可以很方便的插入代码。</p>\r\n\r\n<pre class=\"code\">\r\njava：\r\nSystem.out.println(\'hello world!\');\r\n\r\nphp：\r\necho \'hello world!\';\r\n\r\njavascript：\r\ndocument.write(\'hello world!\');\r\n</pre>\r\n\r\n<p>使用 LBLOG 可以很方便的插入视频。</p>\r\n\r\n<textarea class=\"lazyHtml hidden\">\r\n<iframe height=300 width=\"90%\" src=\"http://player.youku.com/embed/XODUzNzcwMzg4\" frameborder=0 allowfullscreen></iframe>\r\n</textarea>\r\n\r\n<p>使用 LBLOG 可以很方便的插入图片。</p>\r\n\r\n<p>\r\n<img width=\"635\" height=\"476\" src=\"http://git.oschina.net/leiminglin/images/raw/master/2014/12/IMG_20141224_122726.jpg\" osrc-bak=\"https://raw.githubusercontent.com/leiminglin/images/master/2014/12/IMG_20141224_122726.jpg\" alt=\"世纪大道午后时光-LMLPHP后院\" title=\"世纪大道午后时光-LMLPHP后院\" />\r\n</p>\r\n\r\n<p>\r\n<img width=\"635\" height=\"847\" title=\"世纪大道午后时光-LMLPHP后院\" alt=\"世纪大道午后时光-LMLPHP后院\" osrc-bak=\"https://raw.githubusercontent.com/leiminglin/images/master/2014/12/IMG_20141224_123212.jpg\" src=\"http://git.oschina.net/leiminglin/images/raw/master/2014/12/IMG_20141224_123212.jpg\">\r\n</p>\r\n\r\n<p>\r\nLBlog 将在不断的完善中，在使用过程中发现任何问题，请反馈给我们，感谢您的支持！\r\n</p>\r\n\r\n\r\n</div>', unix_timestamp(), 'Y');


DROP TABLE IF EXISTS `lblog_blog_archives_relation`;
CREATE TABLE `lblog_blog_archives_relation` (
  `id` int(11) NOT NULL auto_increment,
  `aid` int(11) NOT NULL,
  `relation_aid` int(11) NOT NULL,
  `addtime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `aid` (`aid`),
  KEY `relation_aid` (`relation_aid`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_blog_archives_statistic`;
CREATE TABLE `lblog_blog_archives_statistic` (
  `id` int(11) NOT NULL auto_increment,
  `aid` int(11) NOT NULL,
  `viewtimes` int(11) unsigned NOT NULL,
  `commenttimes` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_blog_archives_url`;
CREATE TABLE `lblog_blog_archives_url` (
  `id` int(11) NOT NULL auto_increment,
  `aid` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lblog_blog_archives_url` VALUES ('1', '1', 'Welcome_to_use_LBLOG');


DROP TABLE IF EXISTS `lblog_blog_cat`;
CREATE TABLE `lblog_blog_cat` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Blog cats';

INSERT INTO `lblog_blog_cat` VALUES ('1', 'Mood essays');


DROP TABLE IF EXISTS `lblog_blog_comment`;
CREATE TABLE `lblog_blog_comment` (
  `id` int(11) NOT NULL auto_increment,
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_active` enum('Y','N') NOT NULL default 'Y',
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_log_login`;
CREATE TABLE `lblog_log_login` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `from` enum('weibo','qq') default NULL,
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_statistic`;
CREATE TABLE `lblog_statistic` (
  `id` int(11) NOT NULL auto_increment,
  `http_host` varchar(50) NOT NULL,
  `request_uri` varchar(1024) NOT NULL,
  `remote_addr` varchar(24) NOT NULL,
  `http_user_agent` varchar(300) NOT NULL,
  `http_accept` varchar(200) NOT NULL,
  `http_accept_language` varchar(100) NOT NULL,
  `http_accept_encoding` varchar(50) NOT NULL,
  `http_referer` varchar(1024) NOT NULL,
  `createtime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_user`;
CREATE TABLE `lblog_user` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `nickname` varchar(100) default NULL,
  `source` enum('weibo','qq') default NULL,
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lblog_user` VALUES ('1', 'admin', '14e1b600b1fd579f47433b88e8d85291', 'Administrator', null, unix_timestamp());


DROP TABLE IF EXISTS `lblog_blog_user_role`;
CREATE TABLE `lblog_blog_user_role` (
  `id` int(11) NOT NULL auto_increment,
  `role_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lblog_blog_user_role` VALUES ('1', 'Administrator');


DROP TABLE IF EXISTS `lblog_blog_permission`;
CREATE TABLE `lblog_blog_permission` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `uri_regexp` varchar(1024) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_system` enum('Y','N') NOT NULL default 'N',
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_read_list', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/list/', 'View archives list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_read_post', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/post/', 'View archives post page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_add', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/save$/', 'Add new archives', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_modify', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/save\\/\\d+/', 'Modify posted archives', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_relation_read_list', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/relation$/', 'View archive relations list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_relation_add', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/relation\\/set/', 'Add archive relations', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_relation_remove', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/relation$\\/remove/', 'Remove archive relations', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'cats_read_list', '/^(?:\\/index\\.php)?\\/admin\\/cats\\/list/', 'View cats list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'cats_add', '/^(?:\\/index\\.php)?\\/admin\\/cats\\/save$/', 'Add new cats', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'cats_modify', '/^(?:\\/index\\.php)?\\/admin\\/cats\\/save\\/\\d+/', 'Modify posted cats', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'pages_read_list', '/^(?:\\/index\\.php)?\\/admin\\/pages\\/list/', 'View pages list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'pages_add', '/^(?:\\/index\\.php)?\\/admin\\/pages\\/save$/', 'Add new pages', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'pages_modify', '/^(?:\\/index\\.php)?\\/admin\\/pages\\/save\\/\\d+/', 'Modify posted pages', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'comments_read_list', '/^(?:\\/index\\.php)?\\/admin\\/comments\\/list/', 'View comments list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'comments_read_post', '/^(?:\\/index\\.php)?\\/admin\\/comments\\/post/', 'View comments post page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'comments_modify', '/^(?:\\/index\\.php)?\\/admin\\/comments\\/save\\/\\d+/', 'Modify posted comments', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'statistics_access_record_read_list', '/^(?:\\/index\\.php)?\\/admin\\/statistics\\/list/', 'View access records list page', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'images_read_list', '/^(?:\\/index\\.php)?\\/admin\\/images\\/list/', 'View images list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'images_read_post', '/^(?:\\/index\\.php)?\\/admin\\/images\\/post/', 'View images post page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'images_add', '/^(?:\\/index\\.php)?\\/admin\\/images\\/save$/', 'Add new images', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'images_modify', '/^(?:\\/index\\.php)?\\/admin\\/images\\/save\\/\\d+/', 'Modify posted images', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'images_editor_list', '/^(?:\\/index\\.php)?\\/admin\\/images\\/editorList/', 'View images list in editor', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'sessions_read_list', '/^(?:\\/index\\.php)?\\/admin\\/sessions\\/list/', 'View sessions list page', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'accounts_read_list', '/^(?:\\/index\\.php)?\\/admin\\/accounts\\/list/', 'View accounts list page', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_read', '/^(?:\\/index\\.php)?\\/admin\\/settings$/', 'View settings page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_seo', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/seo/', 'Modify seo settings', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_jscode', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/jscode/', 'Modify JavaScript code settings', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_security', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/security/', 'Modify login page uri settings', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_openid_qq', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/openid_qq/', 'Modify openid QQ settings', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_openid_weibo', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/openid_weibo/', 'Modify openid weibo settings', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_timezone', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/timezone/', 'Modify timezone settings', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_logo', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/logo/', 'Modify logo settings', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'users_read_list', '/^(?:\\/index\\.php)?\\/admin\\/users\\/list/', 'View users list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'users_role_operate', '/^(?:\\/index\\.php)?\\/admin\\/users\\/set_account/', 'Operate users role', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'roles_read_list', '/^(?:\\/index\\.php)?\\/admin\\/roles\\/list/', 'View roles list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'roles_add', '/^(?:\\/index\\.php)?\\/admin\\/roles\\/save$/', 'Add new roles', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'roles_modify', '/^(?:\\/index\\.php)?\\/admin\\/roles\\/save\\/\\d+/', 'Modify posted roles', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_read_list', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/list/', 'View permissions list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_add', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/save$/', 'Add new permissions', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_modify', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/save\\/\\d+/', 'Modify posted permissions', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_user_read', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/setting\\/user\\/\\d+/', 'View user permissions', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_role_read', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/setting\\/role\\/\\d+/', 'View role permissions', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_user_modify', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/setting_save\\/user\\/\\d+/', 'Modify user permissions', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_role_modify', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/setting_save\\/role\\/\\d+/', 'Modify role permissions', 'Y', unix_timestamp());


DROP TABLE IF EXISTS `lblog_blog_permission_user`;
CREATE TABLE `lblog_blog_permission_user` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `permissionid` int(11) NOT NULL,
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_blog_permission_role`;
CREATE TABLE `lblog_blog_permission_role` (
  `id` int(11) NOT NULL auto_increment,
  `roleid` int(11) NOT NULL,
  `permissionid` int(11) NOT NULL,
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `roleid` (`roleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_lang_en_US`;
CREATE TABLE `lblog_lang_en_US` (
  `id` int(11) NOT NULL auto_increment,
  `token` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_lang_zh_CN`;
CREATE TABLE `lblog_lang_zh_CN` (
  `id` int(11) NOT NULL auto_increment,
  `token` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Backstage management', '后台管理');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Hi,', '您好，');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Logout', '退出');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Archives', '文章归档');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Related articles', '相关文章');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Article Comments', '文章评论');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Access Record', '访问记录');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'User', '用户');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Role', '角色');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Account', '账号');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Session', '会话');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Permission', '权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Setting', '设置');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Article Categories', '文章分类');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Name', '名称');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'EditComment', '编辑评论');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'EditArticle', '编辑文章');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'ArticleID', '文章编号');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Home', '家');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Welcome!', '欢迎！');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Post', '发布');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Edit', '编辑');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'ID', '编号');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Title', '标题');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Author', '作者');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'IsActive', '是否激活');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'CreatedTime', '创建时间');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Action', '处理');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'PostArticle', '发布文章');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'CatID', '分类编号');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'UserID', '用户编号');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Content', '内容');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Yes', '是');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'No', '否');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Submit', '提交');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Set to related', '设为相关');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Add', '添加');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Article', '文章');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Remove', '移除');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Revert', '撤销');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Comment', '评论');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Domain', '域名');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'URI', '统一资源标识');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'RemoteAddr', '远程地址');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Referrer', '引用');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Relation', '关系');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Cat', '分类');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Statistic', '统计');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Access', '访问');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'AccessRecord', '访问记录');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Email', '邮箱');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'NickName', '昵称');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Source', '来源');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Please select', '请选择');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Save', '保存');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'UserPermission', '用户权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'RolePermission', '角色权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'UriRegExp', '统一资源标识正则');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Description', '描述');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'SEO', '搜索引擎优化');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Site name', '网站名称');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Site keywords', '网站关键词');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Site meta-infomation', '网站元信息');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Security', '安全');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Login page uri', '登录页地址');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'ExpiresTime', '过期时间');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'RoleID', '角色编号');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'RoleName', '角色名称');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'JavaScript Code', 'JavaScript 代码');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Config', '配置');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Callback', '回调');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Previous page', '上一页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Next page', '下一页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Admin', '管理员');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Timezone', '时区');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Please select file', '请选择文件');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Page', '页面');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'PostPage', '新建页面');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'EditPage', '编辑页面');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'PostPermission', '新建权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'EditPermission', '编辑权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Image', '图片');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Path', '路径');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Type', '类型');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Size', '大小');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'PostImage', '提交图片');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'EditImage', '编辑图片');

INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View archives list page', '查看文章列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View archives post page', '查看文章发布页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Add new archives', '添加新文章');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify posted archives', '修改已有文章');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View archive relations list page', '查看文章关系列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Add archive relations', '添加文章关系');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Remove archive relations', '移除文章关系');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View cats list page', '查看分类列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Add new cats', '添加新分类');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify posted cats', '修改已有分类');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View pages list page', '查看页面列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Add new pages', '添加新页面');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify posted pages', '修改已有页面');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View comments list page', '查看评论列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View comments post page', '查看评论发布页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify posted comments', '修改已有评论');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View access records list page', '查看统计列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View settings page', '查看设置页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify seo settings', '修改SEO设置');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify login page uri settings', '修改登录页URI');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify JavaScript code settings', '修改JavaScript代码');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify openid QQ settings', '修改开放认证QQ设置');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify openid weibo settings', '修改开放认证微博设置');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify timezone settings', '修改时区设置');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify logo settings', '修改LOGO设置');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View users list page', '查看用户列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Operate users role', '操作用户权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View roles list page', '查看角色列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Add new roles', '添加新角色');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify posted roles', '修改已有角色');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View permissions list page', '查看权限列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View user permissions', '查看用户权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View role permissions', '查看角色权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify user permissions', '修改用户权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify role permissions', '修改角色权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Add new permissions', '添加新权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify posted permissions', '修改已有权限');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View sessions list page', '查看会话列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View accounts list page', '查看账号列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View images post page', '查看图片列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View images list page', '查看图片列表页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View images post page', '查看图片提交页');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Add new images', '添加新图片');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'Modify posted images', '修改已有图片');
INSERT INTO `lblog_lang_zh_CN` VALUES (default, 'View images list in editor', '编辑器中查看图片列表');


DROP TABLE IF EXISTS `lblog_user_qq`;
CREATE TABLE `lblog_user_qq` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `accesstoken` varchar(50) NOT NULL,
  `userinfo` text,
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_user_weibo`;
CREATE TABLE `lblog_user_weibo` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `weiboid` varchar(50) NOT NULL,
  `accesstoken` varchar(50) NOT NULL,
  `userinfo` text,
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_config`;
CREATE TABLE `lblog_config` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `data` text NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lblog_config` VALUES (default, 'SITE_NAME', 'LBlog');
INSERT INTO `lblog_config` VALUES (default, 'SITE_KEYWORDS', '开源博客系统-LBLOG');
INSERT INTO `lblog_config` VALUES (default, 'SITE_DESCRIPTION', 'LBLOG博客系统是一款轻量级的博客兼CMS建站系统,基于LMLPHP框架,丰富的模板和雄厚的社区技术支持,为自由快速建站而生,让网站轻盈而高速.');
INSERT INTO `lblog_config` VALUES (default, 'JAVASCRIPT_CODE', 'deferred.then(function(){\r\n/*google analytics sample begin*/\r\n(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){\r\n(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\r\nm=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\r\n})(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');\r\nga(\'create\', \'UA-76336948-1\', \'auto\');\r\nga(\'send\', \'pageview\');\r\n/*cnzz statistic sample*/\r\nlml.loadJs(\'//s4.cnzz.com/z_stat.php?id=1254164850&web_id=1254164850\');\r\ndeferred.promise();\r\n});');
INSERT INTO `lblog_config` VALUES (default, 'OPENID_QQ_CONFIG', '{\"appid\":\"\",\"appkey\":\"\",\"callback\":\"http://{your_domain}/user/oauth\",\"scope\":\"get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo,check_page_fans,add_t,add_pic_t,del_t,get_repost_list,get_info,get_other_info,get_fanslist,get_idolist,add_idol,del_idol,get_tenpay_addr\",\"errorReport\":true,\"storageType\":\"file\",\"host\":\"localhost\",\"user\":\"root\",\"password\":\"root\",\"database\":\"test\"}');
INSERT INTO `lblog_config` VALUES (default, 'OPENID_WEIBO_CONFIG_APPKEY', '');
INSERT INTO `lblog_config` VALUES (default, 'OPENID_WEIBO_CONFIG_SECRETKEY', '');
INSERT INTO `lblog_config` VALUES (default, 'OPENID_WEIBO_CONFIG_CALLBACK', 'http://{your_domain}/user/oauthweibo');


DROP TABLE IF EXISTS `lblog_file_image`;
CREATE TABLE `lblog_file_image` (
  `id` int(11) NOT NULL auto_increment,
  `hash` varchar(50) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) unsigned NOT NULL default '0',
  `origin_name` varchar(100) NOT NULL default '',
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_file_image_deleted`;
CREATE TABLE `lblog_file_image_deleted` (
  `id` int(11) NOT NULL auto_increment,
  `image_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) unsigned NOT NULL default '0',
  `origin_name` varchar(100) NOT NULL default '',
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `image_createtime` bigint(20) unsigned NOT NULL default '0',
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_page`;
CREATE TABLE `lblog_page` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `uri_regexp` varchar(255) NOT NULL default '',
  `content` text NOT NULL default '',
  `createtime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lblog_mall_cat`;
CREATE TABLE `lblog_mall_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` bigint(20) unsigned NOT NULL DEFAULT '0',
  `updatetime` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='mall cat';


DROP TABLE IF EXISTS `lblog_mall_goods`;
CREATE TABLE `lblog_mall_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `origin_price` double(10,2) NOT NULL DEFAULT '0.00',
  `price` double(10,2) NOT NULL DEFAULT '0.00',
  `abstract` text NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `images` text NOT NULL,
  `createtime` bigint(20) unsigned NOT NULL DEFAULT '0',
  `updatetime` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`),
  KEY `updatetime` (`updatetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='mall goods';


DROP TABLE IF EXISTS `lblog_mall_goods_cat`;
 CREATE TABLE `lblog_mall_goods_cat` (
  `good_id` int(11) NOT NULL DEFAULT '0',
  `good_cat_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` bigint(20) unsigned NOT NULL DEFAULT '0',
  `updatetime` bigint(20) unsigned NOT NULL DEFAULT '0',
  KEY `good_id` (`good_id`),
  KEY `good_cat_id` (`good_cat_id`),
  KEY `status` (`status`),
  KEY `updatetime` (`updatetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='mall goods cat';
