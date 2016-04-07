<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>后台管理 - <?php echo SITE_NAME?></title>
<style>
body{
	font-family:Microsoft Yahei;
	font-size:14px;
	color:#222;
	margin:0;
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
.show{
	display:block;
}
.hidden{
	display:none;
}
.clear{
	clear:both;
}
a{
	text-decoration:none;
	color:#004276;
}
a:hover{
	color:#ff6f3d;
}
.sitewrap{
	min-width:960px;
}
.top{
	line-height:40px;
	font-size:16px;
	border-bottom:1px solid #e6e9ed;
	padding-left:10px;
}
.top span{
	color:#333;
}
.top .title{
	float:left;
}
.top .user{
	float:right;
	margin:0 10px;
	font-size:12px;
}
.left{
	float:left;
	border-right:1px solid #edeff2;
	padding:10px;
	width:100px;
	height:auto;
	min-height:300px;
}
.left ul li{
	margin:8px 0;
}
.right{
	float:left;
	height:auto;
	min-height:300px;
	position:relative;
}
.right .content{
	padding:10px;
}
.bottom{
	text-align:center;
	margin:20px auto;
}

table tr td, table tr th{
	border:1px solid #eee;
	padding:5px;
}
table{
	border-collapse:collapse;
}
div.line{
	margin:10px 0;
}
div.line span{
	margin-right:10px;
}

.tabs_title{
	position:absolute;
	top:-24px;
	left:10px;
	line-height:22px;
}
.tabs_title a{
	display:inline-block;
	margin:0 3px;
	padding:0 8px;
	cursor:pointer;
	position:relative;
	border-left:1px solid white;
	border-right:1px solid white;
	border-top:1px solid white;
	border-bottom:1px solid #e6e9ed;
}
a.bbw{
	border:1px solid #e6e9ed;
	border-bottom:1px solid #fff;
	color:#ff6f3d;
}
.cl{
	color:#ff6f3d;
}
.longinput{
	width:400px;
}
</style>
<script>
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
window.onload=function(){
	lml.run();
}
</script>


</head>
<body>

<div class="sitewrap">



<div class="top">
	<span class="title"><?php echo SITE_NAME?></span>
	<span class="user">
	<?php if( ($nickname = Tool::getUserNickName())==true ){?>
您好，<?php echo $nickname;?>&nbsp;<a href="<?php echo WEB_APP_PATH.'user/logout'?>">退出</a>
<?php }?>
	</span>
	<div class="clear"></div>
</div>



<div class="middle">
	<div class="left">
		<ul>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_archives_list_page" class="cl">Archive</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_archives_relation_page">Relation</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_cats_page">Cat</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_comments_page">Comment</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_statistics_page">Statistic</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_users_page">User</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_roles_page">Role</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_accounts_page">Account</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_permissions_page">Permission</a>
			</li>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_settings_page">Setting</a>
			</li>
		</ul>
	</div>
	
	<div class="right">
		<div class="tabs_title">
			<a data-tab="1">
				Home
			</a>
		</div>
		<div class="content">
		
			<div id="result">
				<div class="tabs_content">
					<div data-tab="1">
						Welcome!
					</div>
				</div>
			</div>
			
		</div>

	</div>
	<div class="clear"></div>
</div>



<div class="bottom">
<span>&copy; 2014-<?php echo date('Y');?> <a href="http://lblog.lmlphp.com" target="_blank">LBLOG</a></span>
</div>



</div>





<script>
lml.loadJs(
[
'<?php echo WEB_APP_PATH?>admin/js/common?t='+<?php echo filemtime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/common.js');?>, 
'<?php echo WEB_APP_PATH?>admin/js/archives?t='+<?php echo filemtime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/archives.js');?>
],
function(){});
</script>







</body>
</html>
