<!DOCTYPE html>
<html>
<head><?php //特卖网, 保暖袜, 打底裤, 折扣鞋, 家居服, 琳琳衣橱?>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta content="<?php ehtml(s('config','SITE_KEYWORDS'));?>" name="keywords" />
<meta content="<?php ehtml(s('config','SITE_DESCRIPTION'));?>" name="description" />
<meta http-equiv="Cache-Control" content="no-transform"/>
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title><?php ehtml(s('config','SITE_NAME'));?></title>
<script type="text/javascript" src="<?php echo WEB_APP_PATH?>file/resource/js/lml?t=<?php echo filemtime(APP_PATH.'repository/static/resource/lml.js');?>"></script>

<script type="text/javascript">
lml.deferred.front(function(){

var l=document.createElement("link");
l.rel="stylesheet";
l.type="text/css";
l.href='<?php echo WEB_APP_PATH?>file/resource/css/mall?t=<?php echo DEFAULT_LANG . filemtime(APP_PATH.'repository/static/resource/mall.css');?>';
document.getElementsByTagName("head")[0].appendChild(l);

lml.deferred.promise();
});


lml.loadJs(
[
'<?php echo WEB_APP_PATH?>file/resource/js/mall?t=<?php echo DEFAULT_LANG . filemtime(APP_PATH.'repository/static/resource/mall.js');?>'
],
function(){

});
</script>
</head>
<body>
