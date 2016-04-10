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

INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_read_list', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/list/', 'view archives list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_read_post', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/post/', 'view archives post page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_add', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/save$/', 'add new archives', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_modify', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/save\\/\\d+/', 'modify posted archives', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_relation_read_list', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/relation$/', 'view archive relations list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_relation_add', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/relation\\/set/', 'add archive relations', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'archives_relation_remove', '/^(?:\\/index\\.php)?\\/admin\\/archives\\/relation$\\/remove/', 'remove archive relations', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'cats_read_list', '/^(?:\\/index\\.php)?\\/admin\\/cats\\/list/', 'view cats list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'cats_add', '/^(?:\\/index\\.php)?\\/admin\\/cats\\/save$/', 'add new cats', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'cats_modify', '/^(?:\\/index\\.php)?\\/admin\\/cats\\/save\\/\\d+/', 'modify posted cats', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'comments_read_list', '/^(?:\\/index\\.php)?\\/admin\\/comments\\/list/', 'view comments list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'comments_read_post', '/^(?:\\/index\\.php)?\\/admin\\/comments\\/post/', 'view comments post page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'comments_modify', '/^(?:\\/index\\.php)?\\/admin\\/comments\\/save\\/\\d+/', 'modify posted comments', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'statistics_read_list', '/^(?:\\/index\\.php)?\\/admin\\/statistics\\/list/', 'view statistics list page', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_read', '/^(?:\\/index\\.php)?\\/admin\\/settings$/', 'view settings page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_seo', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/seo/', 'modify seo settings', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'settings_modify_security', '/^(?:\\/index\\.php)?\\/admin\\/settings\\/save\\/security/', 'modify login page url settings', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'users_read_list', '/^(?:\\/index\\.php)?\\/admin\\/users\\/list/', 'view users list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'users_role_operate', '/^(?:\\/index\\.php)?\\/admin\\/users\\/set_account/', 'operate users role', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'roles_read_list', '/^(?:\\/index\\.php)?\\/admin\\/roles\\/list/', 'view roles list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'roles_add', '/^(?:\\/index\\.php)?\\/admin\\/roles\\/save$/', 'add new roles', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'roles_modify', '/^(?:\\/index\\.php)?\\/admin\\/roles\\/save\\/\\d+/', 'modify posted roles', 'Y', unix_timestamp());

INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_read_list', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/list/', 'view permissions list page', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_user_read', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/setting\\/user\\/\\d+/', 'view user permissions', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_role_read', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/setting\\/role\\/\\d+/', 'view role permissions', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_user_modify', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/setting_save\\/user\\/\\d+/', 'modify user permissions', 'Y', unix_timestamp());
INSERT INTO `lblog_blog_permission` VALUES (default, 'permissions_role_modify', '/^(?:\\/index\\.php)?\\/admin\\/permissions\\/setting_save\\/role\\/\\d+/', 'modify role permissions', 'Y', unix_timestamp());


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
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `data` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lblog_config` VALUES ('1', 'SITE_NAME', 'LBlog');
INSERT INTO `lblog_config` VALUES ('2', 'SITE_KEYWORDS', '开源博客系统-LBLOG');
INSERT INTO `lblog_config` VALUES ('3', 'SITE_DESCRIPTION', 'LBLOG博客系统是一款轻量级的博客兼CMS建站系统,基于LMLPHP框架,丰富的模板和雄厚的社区技术支持,为自由快速建站而生,让网站轻盈而高速.');

