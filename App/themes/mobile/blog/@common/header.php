<?php 
$nickname = Tool::getUserNickName();
?>
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
	border:2px solid #F7F7F7;
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
.content .left .essay p img{
	margin:0 auto;
	display:block;
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
!function(e,t,n){function o(e){return e={},e.queue=[],e.running=0,e.promise=function(){e.queue.length?(e.running=1,e.queue.shift()()):e.running=0},e.then=function(t){e.queue.push(t)},e}function r(){function t(t){n.push(t),e.onresize=function(){for(var e in n)n[e]()}}var n=[];return t}function a(n){function r(n,o,r,a){r=t.createElement("script"),a=t.getElementsByTagName("script")[0],r.async=1,r.src=n;try{a.parentNode.insertBefore(r,a),e.addEventListener?r.addEventListener("load",o,!1):e.attachEvent?r.onreadystatechange=function(){this.readyState.match(/loaded|complete/i)&&o()}:r.onload=function(){o()}}catch(i){o()}}function a(e,t,o,r){function a(r,s){r=e.shift(),s=e.shift(),e.unshift(s),i(r,function(){s?(a(),n[s].callback.running||i.start(s)):t()},o)}r=e[0],a()}function i(e,t,s,c){function u(){function o(){r(e,function(){n[e].loaded=1,t(),i.start(e)})}s=s+""=="1"?1:0,s?o():n[e].start||n[e].loaded?(t(),i.start(e)):o(),n[e].start=1}return"object"==typeof e&&e instanceof Array?a(e,t):(t=t||function(){l.promise()},n[e]?n[e].callback.then(u):(c=o(),c.then(u),n[e]={loaded:0,start:0,callback:c}),void(n[e].callback.running||i.start(e)))}return n={},i.competeLoad=function(e,t,n,o,r,a){for(r=0,a=e.length;a>r;r++)i(e.shift(),function(){return this.flag?n():(t(),void(this.flag=1))},o)},i.start=function(e,t){if(f.onload)if(e)n[e].callback.promise();else for(t in n)n[t].callback.promise()},i}function i(n){var o,r,a=n.offsetTop,i=n.offsetParent;if(null==i&&n.parentNode)for(o=n.parentNode;null==i&&(i=o.offsetParent,o=o.parentNode););for(;null!==i;)a+=i.offsetTop+i.clientTop,i=i.offsetParent;return"number"==typeof e.pageYOffset?r=e.pageYOffset:(docElement=t.compatMode&&"CSS1Compat"===t.compatMode?t.documentElement:t.body,r=docElement.scrollTop),a-r}function s(){return t.compatMode&&"BackCompat"==t.compatMode&&t.body?{width:t.body.clientWidth,height:t.body.clientHeight}:{width:t.documentElement.clientWidth,height:t.documentElement.clientHeight}}function c(e,n){n=t.createElement("style"),n.type="text/css",n.styleSheet?n.styleSheet.cssText=e:n.innerHTML=e,t.getElementsByTagName("head")[0].appendChild(n)}var l=o(),u=a(),f={};f.registerOnResize=r(),l.then(function(){function n(){if(h>=u.length)return void(e.addEventListener?t.removeEventListener("scroll",n,!1):e.attachEvent&&e.detachEvent(event,n));for(o=0,j=u.length;o<j;o++)u[o].getAttribute("src")||(a=i(u[o]),c=u[o].getAttribute("height")||0,a>=-c&&a<d.height&&(r=u[o].getAttribute("osrc"))&&(u[o].setAttribute("src",r),u[o].onerror=function(){(r=this.getAttribute("osrc-bak"))&&(this.setAttribute("src",r),this.onerror=null)},u[o].onload=function(){h++}))}var o,r,a,c,u=t.getElementsByTagName("IMG"),d=s(),h=0;f.registerOnResize(function(){d=s()}),e.addEventListener?t.addEventListener("scroll",n,!1):e.attachEvent&&e.attachEvent("onscroll",n),n(),l.promise()}),"function"!=typeof t.getElementsByClassName&&(t.getElementsByClassName=function(e){var n,o,e,r=t.getElementsByTagName("*"),a=new RegExp("\\b"+e+"\\b"),i=[];for(n=0,o=r.length;o>n;n++)e=r[n].className,a.test(e)&&i.push(r[n]);return i}),l.then(function(e,n){for(e=t.getElementsByClassName("lazyCss"),n=0;n<e.length;n++)c(e[n].value||e[n].innerHTML);l.promise()}),l.then(function(){var e,n,o=t.getElementsByClassName("lazyHtml");for(e=0;e<o.length;e++)"TEXTAREA"==o[e].tagName&&(n=t.createElement("DIV"),n.innerHTML=o[e].value,o[e].parentNode.insertBefore(n,o[e]));l.promise()}),f.deferred=l,f.createDeferred=o,f.loadJs=u,f.onload=0,f.run=function(){f.onload=1,l.promise(),u.start()},e.lml=f}(window,document);
var deferred = lml.deferred;
var G={'user':{'nickname':'<?php echo $nickname;?>'}};
window.onload=function(){lml.run()};
</script>
</head>
<body>
<div class="sitewrap">
<div class="header">
<div class="login">
<?php if( $nickname ){?>
您好，<?php echo $nickname;?>&nbsp;<a href="<?php echo WEB_APP_PATH.'user/logout'?>">退出</a>
<?php }else{?>
<div class="logintype">
<a href="javascript:void(0)" onclick="javascript:toQzoneLogin();return false;"><img alt="Use qq login" title="使用QQ登录" osrc="<?php echo Tool::getCDNUrl('qq_login.png');?>" height="20" width="100"></a>
</div>
<div class="logintype">
<a href="javascript:void(0)" onclick="javascript:toWeiboLogin();return false;"><img alt="Use weibo login" title="使用新浪微博登录" osrc="<?php echo Tool::getCDNUrl('weibo_login.png');?>" height="20" width="100"></a>
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