<style>
body{
	padding:0;
	margin:0;
	color:#262626;
	text-align:left;
	font-size:14px;
	font-family:Arial,Helvetica,LiHei Pro Medium;
}
img{
	border:0px;
}
ul,li{
	margin:0;
	padding:0;
}
li{
	list-style:none;
}
a{
	text-decoration:none;
	color:#000;
}
a:hover{
	color:#ff6f3d;
}
.show{
	display:block;
}
.hidden{
	display:none;
}
.clear{
	clear:both;
}




.sitewrap{
	margin:auto;
}
.content{
	height:auto;
	min-height:300px;
}
.intro{
	font-size:14px;
	line-height:26px;
	padding:5px 0;
	text-indent:2em;
}
.title{
	font-size:16px;
	font-weight:bold;
}
.header{
	height:30px;
	border-bottom:1px solid #ccc;
	box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
	padding:5px;
}
.header .title{
	font-size:18px;
	font-family:Microsoft Yahei;
	display:inline-block;
	float:left;
	line-height:30px;
	margin-left:6px;
}
.header .login{
	text-align:right;
	height:25px;
	line-height:25px;
	display:inline-block;
	float:right;
	font-size:14px;
	margin:5px 5px 0 0;
}
.header .login .logintype{
	width:21px;
	float:left;
	margin-right:10px;
	overflow-x:hidden;
}
.header .logo {
	float:left;
	height:30px;
	width:30px;
}
.nav{
	text-align:center;
	width:100%;
	height:auto;
}
.nav a{
	font-size:18px;
	padding:5px;
	line-height:50px;
	color:blue;
}
.nav a.selected{
	color:#ff6f3d;
}
.header .title a{
	color:#333;
}
.content img{
	max-width:90%;height:auto;width:auto\9;
}
.foot{
	margin:15px 0;
	text-align:center;
	color:#666;
	font-size:14px;
	
}
.foot .foottop{
	font-size:20px;
	line-height:40px;
	padding-top:20px;
}
.foot a{
	color:#666;
	display:inline-block;
	padding:0 3px;
}
.foot a:hover{
	color:#ff6f3d;
}
.foot .wechatgraph{
	display:none;
	left:-22px;
	position:absolute;
	top:-100px;
	height:100px;
	width:100px;
}
.content .left{
	min-height:300px;
	height:auto;
	border-right:1px solid #E6E9ED;
	padding:0 10px;
}

.content .left .lbox{
	border-bottom:1px solid #EDEFF2;
	height:auto;
}
.content .left .litem{
	min-height:200px;
	margin:0 0 35px;
	word-break:break-all;
}
.content .left .page{
	min-height:100px;
	border-bottom:0;
}
.content .right{
	height:auto;
	min-height:300px;
	padding:0 10px;
}
.content .right .ritem{
	margin:0 0 40px;
	height:auto;
	word-break:break-all;
	font-size:14px;
}
.content .right .ritem ul{
	padding:0 0 15px 0;
}
.content .right .ritem ul li{
	margin:8px 6px;
	height:22px;
	line-height:22px;
	overflow:hidden;
}
.content .right .ritem ul li a{
	color:#004276;
}
.content .right .ritem ul li a:hover{
	color:#ff6f3d;
}
.content .right .widget-title{
	background-color:#f6f3f1;
	color:#333;
	font-size:18px;
	height:40px;
	line-height:40px;
	padding-left:15px;
	font-weight:normal;
	margin:0 0 10px 0;
}
.content .left .litem h2{
	font-weight:inherit;
	color:#000;
	font-size:20px;
	line-height:40px;
	margin:0;
	padding:0 0 10px;
	word-wrap:break-word;
}
.content .left .litem h2 span.tag{
	background:#9EA2C0;
	border-radius:3px;
	padding:0 12px;
	color:#fff;
	font-size:18px;
	font-weight:inherit;
	position:relative;
	display:inline-block;
	height:30px;
	line-height:30px;
	vertical-align:middle;
	margin:-6px 0 0 10px;
}
.content .left .litem h2 span.arrow{
	border-right-color:#9ea2c0;
	border-style:solid;
	border-width:5px;
	display:inline-block;
	height:0;
	left:-10px;
	position:absolute;
	top:10px;
	width:0;
	overflow:hidden;
}
.content .left .litem .author span a{
	color:#999;
}
.content .left .litem .author span a:hover{
	color:#ff6f3d;
}
.content .left .litem .author span{
	color:#999;
	font-size:10px;
}
.content .left .litem h2 span.tag:hover{
	background:#ff6f3d;
}
.content .left .litem h2 span.tag:hover span.arrow{
	border-right-color:#ff6f3d;
}
.content .left .litem h2 span.tag a{
	color:#fff;
}
.code{
	background-color:#fefefe;
	border:2px solid #ddd;
	color:#222;
	padding:10px;
	font-family:Monaco,"DejaVu Sans Mono","Courier New",monospace;
	font-size:13px;
	margin:10px 0;
	overflow:auto;
	text-indent:0;
}
.wbreak{
	white-space:normal;
	white-space:pre-wrap;
	white-space:-moz-pre-wrap;
	white-space:-pre-wrap;
	white-space:-o-pre-wrap;
	word-wrap:break-word;
	word-break:break-all;
}
.content .left .essay a{
	color:#004276;
}
.content .left .essay a:hover{
	text-decoration:underline;
	color:#ff6f3d;
}
.content .left .essaybottom{
	background:#F0F7FD;
	height:30px;
	margin:5px 0;
	line-height:30px;
}
.content .left .essaybottom a{
	padding:0 10px;
	font-size:12px;
	color:#ff6f3d;
	height:30px;
	display:inline-block;
	float:left;
}
.content .left .essaybottom a:hover{
	background:#eee;
}
.linkbtn{
	display:inline-block;
	float:left;
	border:1px solid #ccc;
	cursor:pointer;
	height:30px;
	line-height:30px;
	padding:0 10px;
	color:#ff6f3d;
	border-radius:5px;
}
a.linkbtn:hover{
	border:1px solid #ff6f3d;
	background:#ff6f3d;
	color:white;
}
</style>
<script type="text/javascript">
<?php 
// lml()->app()->setOneSloc(false);
?>
/**
 * LMLJS Framework
 * Copyright (c) 2014 http://lmlphp.com All rights reserved.
 * Licensed ( http://mit-license.org/ )
 * Author: leiminglin <leiminglin@126.com>
 * 
 * A lovely javascript framework.
 * 
 * $id: $
 * 
 */
!function(e,t){function n(n){var o=n.offsetTop,r=n.offsetParent;if(null==r&&n.parentNode)for(var a=n.parentNode;null==r&&(r=a.offsetParent,a=a.parentNode););for(;null!==r;)o+=r.offsetTop+r.clientTop,r=r.offsetParent;var i;return"number"==typeof e.pageYOffset?i=e.pageYOffset:(docElement=t.compatMode&&"CSS1Compat"===t.compatMode?t.documentElement:t.body,i=docElement.scrollTop),o-i}function o(){return t.compatMode&&"BackCompat"==t.compatMode&&t.body?{width:t.body.clientWidth,height:t.body.clientHeight}:{width:t.documentElement.clientWidth,height:t.documentElement.clientHeight}}var r=function(){var e={};return e.queue=[],e.promise=function(){e.queue.length&&e.queue.shift()()},e.then=function(t){e.queue.push(t)},e},a=r();a.then(function(){var e,r,i=t.getElementsByTagName("IMG"),s=o(),c=0;window.onresize=function(){s=o()};var l=function(){if(c>=i.length)return void(window.addEventListener?t.removeEventListener("scroll",l,!1):window.attachEvent&&window.detachEvent(event,l));for(e=0,j=i.length;e<j;e++)if(!i[e].getAttribute("src")){var o=n(i[e]),a=i[e].getAttribute("height")||0;o>=-a&&o<s.height&&(r=i[e].getAttribute("osrc"))&&(i[e].setAttribute("src",r),i[e].onerror=function(){(r=this.getAttribute("osrc-bak"))&&(this.setAttribute("src",r),this.onerror=null)},i[e].onload=function(){c++})}};window.addEventListener?t.addEventListener("scroll",l,!1):window.attachEvent&&window.attachEvent("onscroll",l),l(),a.promise()}),"function"!=typeof t.getElementsByClassName&&(t.getElementsByClassName=function(e){for(var n=t,o=n.getElementsByTagName("*"),r=new RegExp("\\b"+e+"\\b"),a=[],i=0,s=o.length;s>i;i++){var e=o[i].className;r.test(e)&&a.push(o[i])}return a});var i=function(e){var n=t.createElement("style");n.type="text/css",n.styleSheet?n.styleSheet.cssText=e:n.innerHTML=e,t.getElementsByTagName("head")[0].appendChild(n)};a.then(function(){for(var e=t.getElementsByClassName("lazyCss"),n=0;n<e.length;n++)i(e[n].value||e[n].innerHTML);a.promise()}),a.then(function(){for(var e=t.getElementsByClassName("lazyHtml"),n=0;n<e.length;n++)if("TEXTAREA"==e[n].tagName){var o=t.createElement("DIV");o.innerHTML=e[n].value,e[n].parentNode.insertBefore(o,e[n])}a.promise()});var s=function(e,n,o,r){o=t.createElement("script"),r=t.getElementsByTagName("script")[0],o.async=1,o.src=e;try{r.parentNode.insertBefore(o,r),n=n||function(){a.promise()},window.addEventListener?o.addEventListener("load",n,!1):window.attachEvent?o.onreadystatechange=function(){this.readyState.match(/loaded|complete/i)&&n()}:o.onload=function(){n()}}catch(i){n()}},c={};c.deferred=a,c.createDeferred=r,c.loadJs=s,e.lml=c}(window,document);
var deferred = lml.deferred;
</script>
</head>
<body>
<div class="sitewrap">
<div class="header">
<div class="login">
<?php if( ($nickname = Tool::getUserNickName())==true ){?>
您好，<?php echo $nickname;?>&nbsp;<a href="<?php echo WEB_APP_PATH.'user/logout'?>">退出</a>
<?php }else{?>
<div class="logintype">
<a href="javascript:void(0)" onclick='javascript:toQzoneLogin();return false;'><img alt="Use qq login" title="使用QQ登录" osrc="<?php echo Tool::getCDNUrl('qq_login.png');?>" height="20" width="100"></a>
</div>
<div class="logintype">
<a href="javascript:void(0)" onclick='javascript:toWeiboLogin();return false;'><img alt="Use weibo login" title="使用新浪微博登录" osrc="<?php echo Tool::getCDNUrl('weibo_login.png');?>" height="20" width="100"></a>
</div>
<?php }?>
</div>
<div class="logo">
	<a title="LMLPHP" href="<?php echo WEB_PATH?>">
		<img width="30" height="30" osrc="<?php echo Tool::getCDNUrl('lbloglogo100.png');?>" alt="<?php echo SITE_NAME?>">
	</a>
</div>
<div class="title">
<a href="<?php echo WEB_PATH?>"><?php echo SITE_NAME?></a>
</div>


</div>

<div class="nav">
<?php 
	foreach ($cats as $t){?>
	<a href="<?php echo WEB_APP_PATH?>cat/<?php echo $t['id']?>"<?php if(isset($catid)&& $t['id']==$catid){echo 'class="selected"';}?>><?php echo $t['name']?></a>
<?php }?>
</div>