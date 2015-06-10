<style>
body{
	font-family:arial;
	padding:0px;
	margin:0px;
	color:#333;
	background:#F1F2F6;
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
/*960px*/
.sitewrap{
	width:960px;
	margin:auto;
	font-family:Microsoft Yahei;
}
.header{
	height:128px;
}
.header .title{
	font-size:32px;
	text-shadow:4px 2px 5px #444;
	font-family:Microsoft Yahei;
	margin:0 0 25px 10px;
	line-height:70px;
	display:inline-block;
	float:left;
}
.header .nav{
	margin-bottom:25px;
	line-height:62px;
	display:inline-block;
	float:right;
}
.header .login{
	text-align:right;
	height:25px;
	display:inline-block;
	float:right;
	font-size:14px;
	margin-top:8px;
}
.header .login .logintype{
	width:25px;
	float:left;
	margin-right:10px;
	overflow-x:hidden;
}
.header .nav li{
	float:left;
}
.header .nav li a{
	font-size:18px;
	padding:20px;
}
.header .nav li a.selected{
	color:#ff6f3d;
}
.header .title a{
	color:#333;
}
.content{
	padding-top:42px;
	width:960px;
}
.foot{
	background:#fff;
	height:100px;
	margin:10px 0;
	text-align:center;
	color:#666;
	font-size:14px;
	
}
.foot .foottop{
	font-size:20px;
	line-height:40px;
	padding-top:20px;
	font-family:华文行楷;
}
.foot .foottop span{
	font-family:Courier New;
}
.foot b{
	font:inherit;
	font-size:12px;
}
.foot a{
	color:#666;
	width:100px;
	display:inline-block;
	font:inherit;
}
.foot a:hover{
	color:#ff6f3d;
}
.foot .wechatgraph{
	display:none;
	left:-45px;
	position:absolute;
	top:-200px;
	height:200px;
	width:200px;
}
.content .left{
	width:700px;
	float:left;
	min-height:300px;
	height:auto;
	border-right:1px solid #E6E9ED;
	padding:0 0 0 10px;
	background:#fff;
}
.content .contop{
	height:30px;background:#fff;
}
.content .left .lbox{
	border-bottom:1px solid #EDEFF2;
	height:auto;
}
.content .left .litem{
	min-height:200px;
	margin:0 0 35px;
	padding:0 18px;
	word-break:break-all;
}
.content .left .page{
	min-height:100px;
	border-bottom:0;
}
.content .right{
	float:right;
	width:229px;
	height:auto;
	min-height:300px;
	padding:0 10px;
	background:#fff;
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
	width:205px;
	font-weight:normal;
	margin:0 0 10px 0;
}
.content .left .litem h2{
	font-weight:inherit;
	color:#000;
	font-size:28px;
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

		var pageScrollTop;
		if ( typeof win.pageYOffset === 'number' ) {
			pageScrollTop = win.pageYOffset;
		} else {
			docElement = (doc.compatMode && doc.compatMode === 'CSS1Compat') 
			? doc.documentElement : doc.body;
			pageScrollTop = docElement.scrollTop;
		}

		return actualTop - pageScrollTop;
	}

	function getViewport(){
		if( doc.compatMode && doc.compatMode == "BackCompat" ){
			return { width : doc.body.clientWidth, 
				height : doc.body.clientHeight }
		}else{
			return { width : doc.documentElement.clientWidth, 
				height : doc.documentElement.clientHeight }
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
					doc.removeEventListener( 'scroll', loadImg, false );
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
			doc.addEventListener( 'scroll', loadImg, false );
		}else if( window.attachEvent ){
			window.attachEvent("onscroll", loadImg); 
		}
		loadImg();
		deferred.promise();
	});

	if( typeof doc.getElementsByClassName != 'function' ){
		doc.getElementsByClassName = function( classname ){
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
		var e = doc.getElementsByClassName('lazyCss');
		for( var i=0; i<e.length; i++ ) {
			addLazyCss( e[i].value || e[i].innerHTML );
		}
		deferred.promise();
	});
	
	/**
	 * Lazy load HTML
	 */
	deferred.then( function(){
		var e = doc.getElementsByClassName('lazyHtml');
		for( var i=0; i<e.length; i++ ) {
			if(e[i].tagName == 'TEXTAREA'){
				var wrapdiv = doc.createElement('DIV');
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
您好，<?php echo $nickname;?>&nbsp;<a href="<?php echo WEB_APP_PATH.'/user/logout'?>">退出</a>
<?php }else{?>
<div class="logintype">
<a href="javascript:void(0)" onclick='javascript:toQzoneLogin();return false;'><img alt="Use qq login" title="使用QQ登录" osrc="<?php echo Tool::getCDNUrl('qq_login.png');?>" height="24" width="120"></a>
</div>
<div class="logintype">
<a href="javascript:void(0)" onclick='javascript:toWeiboLogin();return false;'><img alt="Use weibo login" title="使用新浪微博登录" osrc="<?php echo Tool::getCDNUrl('weibo_login.png');?>" height="24" width="120"></a>
</div>
<?php }?>
</div>
<div class="clear"></div>
<div class="title">
<a href="<?php echo WEB_PATH?>"><?php echo SITE_NAME?></a>
</div>
<div class="nav">
<ul>
<?php 
	foreach ($cats as $t){?>
	<li><a href="<?php echo WEB_APP_PATH?>cat/<?php echo $t['id']?>"<?php if(isset($catid)&& $t['id']==$catid){echo 'class="selected"';}?>><?php echo $t['name']?></a></li>
<?php }?>
</ul>
</div>
<div class="clear"></div>
</div>