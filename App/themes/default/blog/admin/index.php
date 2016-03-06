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
	height:2000px;
	padding:10px;
	width:100px;
}
.right{
	float:left;
	height:1000px;
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
	margin:10px;
}
</style>
</head>
<body>

<div class="sitewrap">

<div class="top">
	<span>LBLOG 后台管理</span>
</div>

<div class="middle">

	<div class="left">
		<ul>
			<li><?php echo tag_a('物料列表', 'get_list_archives()');?></li>
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
function form_iframe_get(action, callback){
	var time = new Date().getTime()
	,c_iframe = document.createElement('iframe')
	,c_form = document.createElement('form');
	c_iframe.className = 'hidden';
	c_iframe.name = 'request_iframe_'+time;
	c_form.className = 'hidden';
	c_form.id = 'request_form_'+time;
	c_form.method='get';
	c_form.target=c_iframe.name;
	c_form.action=action;
	
	document.body.appendChild(c_iframe);
	document.body.appendChild(c_form);
	c_form.submit();
	c_iframe.onload = function(){
		callback(c_iframe.contentWindow.document.body.innerHTML);
		c_form.parentNode.removeChild(c_form);
		c_iframe.parentNode.removeChild(c_iframe);
	}
}
function get_list_archives(){
	form_iframe_get('<?php echo WEB_APP_PATH?>admin/archives/list', function(rs){
		document.getElementById('result').innerHTML = rs;
	});
}

function get_edit_archives(id){
	form_iframe_get('<?php echo WEB_APP_PATH?>admin/archives/edit/'+id, function(rs){
		document.getElementById('result').innerHTML = rs;
	});
}

function get_post_archives(){
	form_iframe_get('<?php echo WEB_APP_PATH?>admin/archives/post', function(rs){
		document.getElementById('result').innerHTML = rs;
	});
}

function get_save_archives(form){
	var time = new Date().getTime()
	,c_iframe = document.createElement('iframe')
	,c_form = form;
	c_iframe.className = 'hidden';
	c_iframe.name = 'request_iframe_'+time;
	c_form.target=c_iframe.name;
	
	document.body.appendChild(c_iframe);
	c_iframe.onload = function(){
		document.getElementById('result').innerHTML = c_iframe.contentWindow.document.body.innerHTML;
		c_iframe.parentNode.removeChild(c_iframe);
	};
	return true;
}

window.onload = function(){
	get_list_archives();

	var left_w = document.getElementsByClassName('left')[0].offsetWidth
	,body_w = document.body.clientWidth, right = document.getElementsByClassName('right')[0];
	right.style.width = body_w - left_w + "px";

	
}
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

		left.style.marginTop = left.originMarginTop + 'px';

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