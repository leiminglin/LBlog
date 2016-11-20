<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title><?php elang('Backstage management')?> - <?php ehtml(SITE_NAME)?></title>
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
textarea{
	font-size:14px;
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
!function(a,b,c){function d(a){return a={},a.queue=[],a.running=0,a.promise=function(){a.queue.length?(a.running=1,a.queue.shift()()):a.running=0},a.then=function(b){a.queue.push(b)},a.front=function(b){a.queue.unshift(b)},a}function h(){function c(c){b.push(c),a.onresize=function(){for(var a in b)b[a]()}}var b=[];return c}function i(c){function f(c,d,e,f){e=b.createElement("script"),f=b.getElementsByTagName("script")[0],e.async=1,e.src=c;try{f.parentNode.insertBefore(e,f),a.addEventListener?e.addEventListener("load",d,!1):a.attachEvent?e.onreadystatechange=function(){this.readyState.match(/loaded|complete/i)&&d()}:e.onload=function(){d()}}catch(a){d()}}function h(a,b,d,e){function f(e,g){e=a.shift(),g=a.shift(),a.unshift(g),i(e,function(){g?(f(),c[g].callback.running||i.start(g)):b()},d)}e=a[0],f()}function i(a,b,g,j){function k(){function d(){f(a,function(){c[a].loaded=1,b(),i.start(a)})}g=g+""=="1"?1:0,g?d():c[a].start||c[a].loaded?(b(),i.start(a)):d(),c[a].start=1}return"object"==typeof a&&a instanceof Array?h(a,b):(b=b||function(){e.promise()},c[a]?c[a].callback.then(k):(j=d(),j.then(k),c[a]={loaded:0,start:0,callback:j}),void(c[a].callback.running||i.start(a)))}return c={},i.competeLoad=function(a,b,c,d,e,f){for(e=0,f=a.length;e<f;e++)i(a.shift(),function(){return this.flag?c():(b(),void(this.flag=1))},d)},i.start=function(a,b){if(g.onload)if(a)c[a].callback.promise();else for(b in c)c[b].callback.promise()},i}function k(c){var f,g,d=c.offsetTop,e=c.offsetParent;if(null==e&&c.parentNode)for(f=c.parentNode;null==e&&(e=f.offsetParent,f=f.parentNode););for(;e;)d+=e.offsetTop+e.clientTop,e=e.offsetParent;return"number"==typeof a.pageYOffset?g=a.pageYOffset:(docElement=b.compatMode&&"CSS1Compat"===b.compatMode?b.documentElement:b.body,g=docElement.scrollTop),d-g}function l(){return b.compatMode&&"BackCompat"==b.compatMode&&b.body?{width:b.body.clientWidth,height:b.body.clientHeight}:{width:b.documentElement.clientWidth,height:b.documentElement.clientHeight}}function m(a,c){c=b.createElement("style"),c.type="text/css",c.styleSheet?c.styleSheet.cssText=a:c.innerHTML=a,b.getElementsByTagName("head")[0].appendChild(c)}var e=d(),f=i(),g={};g.registerOnResize=h(),e.then(function(){function p(){if(m>=h.length)return void(a.addEventListener?b.removeEventListener("scroll",p,!1):a.attachEvent&&a.detachEvent(event,p));for(c=0,j=h.length;c<j;c++)h[c].getAttribute("src")||(n=k(h[c]),o=h[c].getAttribute("height")||0,n>=-o&&n<i.height&&(f=h[c].getAttribute("osrc"))&&(h[c].setAttribute("src",f),h[c].onerror=function(){(f=this.getAttribute("osrc-bak"))&&(this.setAttribute("src",f),this.onerror=null)},h[c].onload=function(){m++}))}var c,f,n,o,h=b.getElementsByTagName("IMG"),i=l(),m=0;g.registerOnResize(function(){i=l()}),a.addEventListener?b.addEventListener("scroll",p,!1):a.attachEvent&&a.attachEvent("onscroll",p),p(),e.promise()}),"function"!=typeof b.getElementsByClassName&&(b.getElementsByClassName=function(a){var f,g,a,c=b.getElementsByTagName("*"),d=new RegExp("\\b"+a+"\\b"),e=[];for(f=0,g=c.length;f<g;f++)a=c[f].className,d.test(a)&&e.push(c[f]);return e}),e.then(function(a,c){for(a=b.getElementsByClassName("lazyCss"),c=0;c<a.length;c++)m(a[c].value||a[c].innerHTML);e.promise()}),e.then(function(){var c,d,a=b.getElementsByClassName("lazyHtml");for(c=0;c<a.length;c++)"TEXTAREA"==a[c].tagName&&(d=b.createElement("DIV"),d.innerHTML=a[c].value,a[c].parentNode.insertBefore(d,a[c]));e.promise()}),g.deferred=e,g.createDeferred=d,g.loadJs=f,g.onload=0,g.run=function(){g.onload=1,e.promise(),f.start()},a.lml=g}(window,document);
var LBLOG_CSRF_TOKEN='<?php echo csrf_token();?>';
window.onload=function(){
	lml.run();
}
</script>


</head>
<body>

<div class="sitewrap">



<div class="top">
	<span class="title"><?php ehtml(SITE_NAME)?></span>
	<span class="user">
	<?php if( ($nickname = Tool::getAdminNickName())==true ){?>
<?php elang('Hi,')?> <?php ehtml($nickname);?>&nbsp;<a href="<?php echo WEB_APP_PATH.'admin/logout'?>"><?php elang('Logout')?></a>
<?php }?>
	</span>
	<div class="clear"></div>
</div>



<div class="middle">
	<div class="left">
		<ul>
		
			<?php if(p('goods_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_goods_list_page" class="cl"><?php elang('Goods')?></a>
			</li>
			<?php }?>
			
			<?php if(p('archives_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_archives_list_page"><?php elang('Archives')?></a>
			</li>
			<?php }?>
			
			<?php if(p('archives_relation_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_archives_relation_page"><?php elang('Related articles')?></a>
			</li>
			<?php }?>
			
			<?php if(p('cats_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_cats_page"><?php elang('Article Categories')?></a>
			</li>
			<?php }?>
			
			<?php if(p('comments_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_comments_list_page"><?php elang('Article Comments')?></a>
			</li>
			<?php }?>
			
			<?php if(p('statistics_access_record_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_statistics_page"><?php elang('Access Record')?></a>
			</li>
			<?php }?>
			
			<?php if(p('images_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_images_page"><?php elang('Image')?></a>
			</li>
			<?php }?>
			
			<?php if(p('pages_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_pages_page"><?php elang('Page')?></a>
			</li>
			<?php }?>
			
			<?php if(p('users_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_users_page"><?php elang('User')?></a>
			</li>
			<?php }?>
			
			<?php if(p('roles_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_roles_page"><?php elang('Role')?></a>
			</li>
			<?php }?>
			
			<?php if(p('accounts_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_accounts_page"><?php elang('Account')?></a>
			</li>
			<?php }?>
			
			<?php if(p('sessions_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_sessions_page"><?php elang('Session')?></a>
			</li>
			<?php }?>
			
			<?php if(p('permissions_read_list')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_permissions_page"><?php elang('Permission')?></a>
			</li>
			<?php }?>
			
			<?php if(p('settings_read')){?>
			<li>
			<a href="javascript:void(0)" data-action="lblog_admin_settings_page"><?php elang('Setting')?></a>
			</li>
			<?php }?>
			
		</ul>
	</div>
	
	<div class="right">
		<div class="tabs_title">
			<a data-tab="1">
				<?php elang('Home')?>
			</a>
		</div>
		<div class="content">
		
			<div id="result">
				<div class="tabs_content">
					<div data-tab="1">
						<?php elang('Welcome!')?>
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
'<?php echo WEB_APP_PATH?>admin/js/common?t=<?php echo DEFAULT_LANG?>'+<?php echo filemtime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/common.js');?>, 
'<?php echo WEB_APP_PATH?>admin/js/archives?t=<?php echo DEFAULT_LANG?>'+<?php echo filemtime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/archives.js');?>
],
function(){});
</script>







</body>
</html>
