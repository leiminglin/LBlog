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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='博客文章表';

INSERT INTO `lblog_blog_archives` VALUES ('1', '1', '1', '欢迎使用 LBLOG！', null, '<div class=\"intro\">\r\n\r\n<p>欢迎使用 LBLOG 开始您的博客之旅！</p>\r\n\r\n<p>LBlog 是一款基于 LMLPHP 和 LMLJS 框架的开源博客兼 CMS 系统，它拥有轻量级高性能特点和更加灵活的二次开发支持。系统拥有优秀的 SEO 支持；基于 QQ 和新浪微博的账户系统；独创的异步加载让网站跑的更快！</p>\r\n\r\n<p>使用 LBLOG 可以很方便的插入代码。</p>\r\n\r\n<pre class=\"code\">\r\njava：\r\nSystem.out.println(\'hello world!\');\r\n\r\nphp：\r\necho \'hello world!\';\r\n\r\njavascript：\r\ndocument.write(\'hello world!\');\r\n</pre>\r\n\r\n<p>使用 LBLOG 可以很方便的插入视频。</p>\r\n\r\n<textarea class=\"lazyHtml hidden\">\r\n<iframe height=300 width=\"90%\" src=\"http://player.youku.com/embed/XODUzNzcwMzg4\" frameborder=0 allowfullscreen></iframe>\r\n</textarea>\r\n\r\n<p>使用 LBLOG 可以很方便的插入图片。</p>\r\n\r\n<p>\r\n<img width=\"635\" height=\"476\" src=\"http://git.oschina.net/leiminglin/images/raw/master/2014/12/IMG_20141224_122726.jpg\" osrc-bak=\"https://raw.githubusercontent.com/leiminglin/images/master/2014/12/IMG_20141224_122726.jpg\" alt=\"世纪大道午后时光-LMLPHP后院\" title=\"世纪大道午后时光-LMLPHP后院\" />\r\n</p>\r\n\r\n<p>\r\n<img width=\"635\" height=\"847\" title=\"世纪大道午后时光-LMLPHP后院\" alt=\"世纪大道午后时光-LMLPHP后院\" osrc-bak=\"https://raw.githubusercontent.com/leiminglin/images/master/2014/12/IMG_20141224_123212.jpg\" src=\"http://git.oschina.net/leiminglin/images/raw/master/2014/12/IMG_20141224_123212.jpg\">\r\n</p>\r\n\r\n<p>\r\nLBlog 将在不断的完善中，在使用过程中发现任何问题，请反馈给我们，感谢您的支持！\r\n</p>\r\n\r\n\r\n</div>', '1433066960', 'Y');


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='博客分类表';

INSERT INTO `lblog_blog_cat` VALUES ('1', '心情随笔');


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
  `request_time` bigint(20) unsigned NOT NULL,
  `add_time` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `request_time` (`request_time`)
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

INSERT INTO `lblog_user` VALUES ('1', 'admin', '14e1b600b1fd579f47433b88e8d85291', '老大', null, '1412265580');


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

