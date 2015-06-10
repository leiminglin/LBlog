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
(function(win, doc, undf){

	var deferred = {};
	deferred.queue = [];
	deferred.promise = function(){
		if( deferred.queue.length ){
			deferred.queue.shift()();
		}
	};
	deferred.then = function(e){
		deferred.queue.push(e);
	};

	function getElementViewTop(element){
		var actualTop = element.offsetTop
			,offsetParentElement = element.offsetParent;
		if( offsetParentElement == null && element.parentNode ){
			/* when style display is none */
			var parentNode = element.parentNode;
			while( offsetParentElement == null ){
				offsetParentElement = parentNode.offsetParent;
				parentNode = parentNode.parentNode;
				if( !parentNode ){
					break;
				}
			}
		}
		while ( offsetParentElement !== null /* document.body */ ){
			actualTop += (offsetParentElement.offsetTop+offsetParentElement.clientTop);
			offsetParentElement = offsetParentElement.offsetParent;
		}
		var elementScrollTop = document.documentElement.scrollTop 
			? document.documentElement.scrollTop : document.body.scrollTop; 
		return actualTop - elementScrollTop;
	}

	function getViewport(){
		if( document.compatMode == "BackCompat" ){
			return { width:document.body.clientWidth, 
				height:document.body.clientHeight }
		}else{
			return { width:document.documentElement.clientWidth, 
				height:document.documentElement.clientHeight }
		}
	}

	/**
	 * Lazy load img
	 */
	deferred.then(function(){
		var i, length, src, m = doc.getElementsByTagName('IMG'), 
			viewport=getViewport(), count=0;
		window.onresize = function(){
			viewport = getViewport();
		};
		var loadImg = function(){
			if( count >= m.length ){
				/* remove event */
				if( window.addEventListener ){
					document.removeEventListener( 'scroll', loadImg, false );
				}else if( window.attachEvent ){
					window.detachEvent(event, loadImg); 
				}
				return;
			}
			for(i=0,j=m.length; i<j; i++){
				if( m[i].getAttribute('src') ){
					continue;
				}
				var viewtop = getElementViewTop(m[i])
					,imgHeight = m[i].getAttribute('height')||0;
				if( viewtop>=-imgHeight && viewtop < viewport.height 
					&& (src=m[i].getAttribute('osrc')) ){
					m[i].setAttribute('src',src);
					m[i].onerror=function(){
						if( src=this.getAttribute('osrc-bak') ){
							this.setAttribute('src',src);
							this.onerror=null;
						}
					};
					m[i].onload = function(){
						count++;
					}
				}
			}
		};
		
		if( window.addEventListener ){
			document.addEventListener( 'scroll', loadImg, false );
		}else if( window.attachEvent ){
			window.attachEvent("onscroll", loadImg); 
		}
		loadImg();
		deferred.promise();
	});

	if( typeof document.getElementsByClassName != 'function' ){
		document.getElementsByClassName = function( classname ){
			var d = doc, e = d.getElementsByTagName('*'), 
				c = new RegExp('\\b'+classname+'\\b'), r = [];
			for( var i=0,l=e.length; i<l; i++ ){
				var classname = e[i].className;
				if( c.test(classname) ){
					r.push( e[i] );
				}
			}
			return r;
		}
	}

	var addLazyCss = function( css ) {
		var style = doc.createElement('style');
		style.type='text/css';
		if (style.styleSheet) {
			style.styleSheet.cssText = css;
		}else{
			style.innerHTML = css;
		}
		doc.getElementsByTagName('head')[0].appendChild(style);
	};

	/**
	 * Lazy load CSS
	 */
	deferred.then( function(){
		var e = document.getElementsByClassName('lazyCss');
		for( var i=0; i<e.length; i++ ) {
			addLazyCss( e[i].value || e[i].innerHTML );
		}
		deferred.promise();
	});
	
	/**
	 * Lazy load HTML
	 */
	deferred.then( function(){
		var e = document.getElementsByClassName('lazyHtml');
		for( var i=0; i<e.length; i++ ) {
			if(e[i].tagName == 'TEXTAREA'){
				var wrapdiv = document.createElement('DIV');
				wrapdiv.innerHTML = e[i].value;
				e[i].parentNode.insertBefore(wrapdiv, e[i]);
			}
		}
		deferred.promise();
	});

	var loadJs = function( src, callback, script, stag ) {
		script = doc.createElement('script'),
		stag = doc.getElementsByTagName('script')[0];
		script.async = 1;
		script.src = src;
		try{
			stag.parentNode.insertBefore( script, stag );
			callback = callback || function(){
				deferred.promise();
			};
			if( window.addEventListener ){
				script.addEventListener( 'load', callback, false );
			}else if( window.attachEvent ){
				script.onreadystatechange = function(){
					if(this.readyState.match(/loaded|complete/i)){
						callback();
					}
				}
			}else{
				script.onload = function(){
					callback();
				}
			}
		}catch(e){
			callback();
		}
	};

	var lml = {};
	lml.deferred = deferred;
	lml.loadJs = loadJs;
	win.lml = lml;
	
})(window, document);
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