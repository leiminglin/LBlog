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
.left{
	float:left;
	border-right:1px solid #edeff2;
	/* height:2000px; */
	padding:10px;
	width:100px;
	height:auto;
	min-height:300px;
}
.right{
	float:left;
	height:auto;
	min-height:300px;
	/* height:1000px; */
}
.right .content{
	padding:10px;
}
.bottom{
	text-align:center;
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
!function(e,t,n){function o(e){return e={},e.queue=[],e.running=0,e.promise=function(){e.queue.length?(e.running=1,e.queue.shift()()):e.running=0},e.then=function(t){e.queue.push(t)},e}function r(){function t(t){n.push(t),e.onresize=function(){for(var e in n)n[e]()}}var n=[];return t}function a(n){function r(n,o,r,a){r=t.createElement("script"),a=t.getElementsByTagName("script")[0],r.async=1,r.src=n;try{a.parentNode.insertBefore(r,a),e.addEventListener?r.addEventListener("load",o,!1):e.attachEvent?r.onreadystatechange=function(){this.readyState.match(/loaded|complete/i)&&o()}:r.onload=function(){o()}}catch(i){o()}}function a(e,t,o,r){function a(r,s){r=e.shift(),s=e.shift(),e.unshift(s),i(r,function(){s?(a(),n[s].callback.running||i.start(s)):t()},o)}r=e[0],a()}function i(e,t,s,c){function u(){function o(){r(e,function(){n[e].loaded=1,t(),i.start(e)})}s=s+""=="1"?1:0,s?o():n[e].start||n[e].loaded?(t(),i.start(e)):o(),n[e].start=1}return"object"==typeof e&&e instanceof Array?a(e,t):(t=t||function(){l.promise()},n[e]?n[e].callback.then(u):(c=o(),c.then(u),n[e]={loaded:0,start:0,callback:c}),void(n[e].callback.running||i.start(e)))}return n={},i.competeLoad=function(e,t,n,o,r){for(o=0,r=e.length;r>o;o++)i(e.shift(),function(){this.flag||(t(),this.flag=1)})},i.start=function(e,t){if(f.onload)if(e)n[e].callback.promise();else for(t in n)n[t].callback.promise()},i}function i(n){var o,r,a=n.offsetTop,i=n.offsetParent;if(null==i&&n.parentNode)for(o=n.parentNode;null==i&&(i=o.offsetParent,o=o.parentNode););for(;null!==i;)a+=i.offsetTop+i.clientTop,i=i.offsetParent;return"number"==typeof e.pageYOffset?r=e.pageYOffset:(docElement=t.compatMode&&"CSS1Compat"===t.compatMode?t.documentElement:t.body,r=docElement.scrollTop),a-r}function s(){return t.compatMode&&"BackCompat"==t.compatMode&&t.body?{width:t.body.clientWidth,height:t.body.clientHeight}:{width:t.documentElement.clientWidth,height:t.documentElement.clientHeight}}function c(e,n){n=t.createElement("style"),n.type="text/css",n.styleSheet?n.styleSheet.cssText=e:n.innerHTML=e,t.getElementsByTagName("head")[0].appendChild(n)}var l=o(),u=a(),f={};f.registerOnResize=r(),l.then(function(){function n(){if(h>=u.length)return void(e.addEventListener?t.removeEventListener("scroll",n,!1):e.attachEvent&&e.detachEvent(event,n));for(o=0,j=u.length;o<j;o++)u[o].getAttribute("src")||(a=i(u[o]),c=u[o].getAttribute("height")||0,a>=-c&&a<d.height&&(r=u[o].getAttribute("osrc"))&&(u[o].setAttribute("src",r),u[o].onerror=function(){(r=this.getAttribute("osrc-bak"))&&(this.setAttribute("src",r),this.onerror=null)},u[o].onload=function(){h++}))}var o,r,a,c,u=t.getElementsByTagName("IMG"),d=s(),h=0;f.registerOnResize(function(){d=s()}),e.addEventListener?t.addEventListener("scroll",n,!1):e.attachEvent&&e.attachEvent("onscroll",n),n(),l.promise()}),"function"!=typeof t.getElementsByClassName&&(t.getElementsByClassName=function(e){var n,o,e,r=t.getElementsByTagName("*"),a=new RegExp("\\b"+e+"\\b"),i=[];for(n=0,o=r.length;o>n;n++)e=r[n].className,a.test(e)&&i.push(r[n]);return i}),l.then(function(e,n){for(e=t.getElementsByClassName("lazyCss"),n=0;n<e.length;n++)c(e[n].value||e[n].innerHTML);l.promise()}),l.then(function(){var e,n,o=t.getElementsByClassName("lazyHtml");for(e=0;e<o.length;e++)"TEXTAREA"==o[e].tagName&&(n=t.createElement("DIV"),n.innerHTML=o[e].value,o[e].parentNode.insertBefore(n,o[e]));l.promise()}),f.deferred=l,f.createDeferred=o,f.loadJs=u,f.onload=0,f.run=function(){f.onload=1,l.promise(),u.start()},e.lml=f}(window,document);
window.onload = function(){
	lml.run();
}
</script>


</head>
<body>

<div class="sitewrap">

<div class="top">
	<span><?php echo SITE_NAME?></span>
</div>

<div class="middle">

	<div class="left">
		<ul>
			<li><?php echo tag_a('物料管理', 'get_list_archives()');?></li>
		</ul>
	</div>
	
	<div class="right">
		<div class="content">
		
			<div id="result">
			
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
	['<?php echo WEB_APP_PATH?>admin/js/common?t=' + <?php echo filectime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/common.js');?>, 
	'<?php echo WEB_APP_PATH?>admin/js/archives?t=' + <?php echo filectime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/archives.js');?>], 
	function(){});
</script>









<span class="hidden">
<a href="<?php echo WEB_APP_PATH?>admin/postarticle" target="_blank">发表文章</a>
<br/>
<hr/>
<br/>
<input type="text" id="article_id" placeholder="输入要编辑的文章ID"/><a href="javascript:void(0)" 
onclick="javascript:var article_id=document.getElementById('article_id').value; if(article_id<=0){return false;} this.href='<?php echo WEB_APP_PATH?>admin/postarticle?id='+article_id;" 
target="_blank">
编辑文章</a>
<br/>
<hr/>
<br/>
<input type="text" id="relation_aid" placeholder="两个相关文章ID空格分开"/>
<br/>
<a href="javascript:void(0)" 
onclick="javascript:var relation_aid=document.getElementById('relation_aid').value; if(relation_aid<=0){return false;} this.href='<?php echo WEB_APP_PATH?>admin/addrelationarticle?relation_ids='+relation_aid;" 
target="_blank">
设为相关文章</a>
<br/>
<a href="javascript:void(0)" 
onclick="javascript:var relation_aid=document.getElementById('relation_aid').value; if(relation_aid<=0){return false;} this.href='<?php echo WEB_APP_PATH?>admin/removerelationarticle?relation_ids='+relation_aid;" 
target="_blank">
取消相关文章</a>
</span>







<script>
(function(){
	function getElementOffsetTop(element){
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
		return actualTop;
	}

	function getEleStyle(ele, cssName){
		var style = window.getComputedStyle ? 
			window.getComputedStyle(ele, "") : 
			ele.currentStyle;
		return style[cssName];
	}

	function getPageScrollOffset() {
		var doc = document, w = window;
		var x, y, docEl;

		if ( typeof w.pageYOffset === 'number' ) {
			x = w.pageXOffset;
			y = w.pageYOffset;
		} else {
			docEl = (doc.compatMode && doc.compatMode === 'CSS1Compat') ? 
				doc.documentElement : doc.body;
			x = docEl.scrollLeft;
			y = docEl.scrollTop;
		}
		return {x : x, y : y};
	}

	function getWindowViewport() {
		var doc = document, w = window;
		var docEl = (doc.compatMode && doc.compatMode === 'CSS1Compat') ? 
				doc.documentElement: doc.body;

		var width = docEl.clientWidth;
		var height = docEl.clientHeight;

		if ( w.innerWidth && width > w.innerWidth ) {
			width = w.innerWidth;
			height = w.innerHeight;
		}

		return {width : width, height : height};
	}

	var left = document.getElementsByClassName('left')[0];
	var right = document.getElementsByClassName('right')[0];
	var rightOriginOffsetTop = parseInt(getElementOffsetTop(right));
	var leftHeight, rightHeight;

	left.originMarginTop = left.style.marginTop.match(/\d+/);
	right.originMarginTop = right.style.marginTop.match(/\d+/);

	var rightFloat = function(){
		leftHeight = left.offsetHeight;
		rightHeight = right.offsetHeight;
		if(leftHeight < rightHeight){
			var temp = right;
			right = left;
			left = temp;
			leftHeight = left.offsetHeight;
			rightHeight = right.offsetHeight;
		}

		if(left.originMarginTop){
			left.style.marginTop = left.originMarginTop + 'px';
		}

		var viewportHeight = parseInt(getWindowViewport().height);
		var pageScrollTop = parseInt(getPageScrollOffset().y);
		var leftOffsetTop = parseInt(getElementOffsetTop(left));
		var rightBoxOffsetTop = parseInt(getElementOffsetTop(right));
		var rightBoxMarginTop = parseInt(right.style.marginTop.match(/\d+/));
		var maxMarginTopVal = rightHeight + rightBoxOffsetTop - leftOffsetTop - leftHeight; 

		if(maxMarginTopVal > 0){
			var startBack = rightBoxOffsetTop - pageScrollTop;
			if(startBack > 0){
				right.style.marginTop = (pageScrollTop - rightOriginOffsetTop) + 'px';
			}
			return;
		}

		var startFloatDownVal = pageScrollTop + viewportHeight 
			- rightOriginOffsetTop - rightHeight;

		if(rightHeight<viewportHeight){
			startFloatDownVal = pageScrollTop - rightOriginOffsetTop;
		}

		if(startFloatDownVal >= 0){
			if(rightBoxMarginTop >= startFloatDownVal){
				if(rightBoxOffsetTop > pageScrollTop && rightBoxOffsetTop > rightOriginOffsetTop){
					var temp = pageScrollTop - rightOriginOffsetTop;
					right.style.marginTop = (temp>0?temp:0) +'px';
				}
				return;
			}
			var actualVal = leftHeight + leftOffsetTop - rightHeight - rightOriginOffsetTop;
			var pos = startFloatDownVal >= actualVal ? actualVal : startFloatDownVal;
			right.style.marginTop =  pos + 'px';
		}

		if(rightBoxOffsetTop > pageScrollTop && rightBoxOffsetTop > rightOriginOffsetTop){
			var temp = pageScrollTop - rightOriginOffsetTop;
			right.style.marginTop = (temp>0?temp:0) +'px';
		}
	};

	if( window.addEventListener ){
		document.addEventListener( 'scroll', rightFloat, false );
	}else if( window.attachEvent ){
		window.attachEvent("onscroll", rightFloat); 
	}
})();
</script>
</body>
</html>