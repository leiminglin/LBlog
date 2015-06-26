<script type="text/javascript">
function toQzoneLogin(){window.location.href="<?php echo WEB_APP_PATH.'user/login?backurl=';?>"+encodeURIComponent(window.location.href)}
function toWeiboLogin(){window.location.href="<?php echo WEB_APP_PATH.'user/weibologin?backurl=';?>"+encodeURIComponent(window.location.href)}

deferred.then(function(){
	var e = document.getElementsByClassName('ritem')[0].getElementsByTagName('A');
	for(i=0,j=e.length;i<j;i++){
		if(!e[i].getAttribute('title')){
			e[i].setAttribute('title', e[i].innerHTML);
		}
	}
	deferred.promise()
});
function getShareText(){
	var e=document.getElementsByTagName('meta'),i,j;
	for(i=0,j=e.length;i<j;i++){
		if(e[i].getAttribute('name')&&e[i].getAttribute('name').match(/description/i)){
			return e[i].getAttribute('content')
		}
	}
}
function getShareImg(){
	var d=document.getElementsByTagName('DIV'),l=d.length,img;
	for(var i=0;i<l;i++){
		if(d[i].getAttribute('class')&&d[i].getAttribute('class').match(/content/)){
			img = d[i].getElementsByTagName('IMG');
			if(img.length>0){
				return img[0].src;
			}else{
				return document.getElementsByClassName('foot')[0].getElementsByTagName('img')[0].src;
			}
			break;
		}
	}
}
/*
deferred.then(function(){(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-44165942-2', 'auto');ga('send', 'pageview');function t(d,o,l,a,m){a=d.createElement(o),m=d.getElementsByTagName(o)[0];a.async=1;a.src=l;m.parentNode.insertBefore(a,m)}t(document,'script','//s5.cnzz.com/z_stat.php?id=1253286891&web_id=1253286891');t(document,'script','//hm.baidu.com/h.js?611d0ab5726828d7f68896cec0aefbf6');t(document,'script','//js.users.51.la/17386014.js');setTimeout(function(){window._bd_share_config={"common":{"bdSnsKey":{},"bdText":getShareText(),"bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16","bdDesc":document.getElementsByTagName('title')[0].innerHTML,"bdPic":getShareImg()},"slide":{"type":"slide","bdImg":"2","bdPos":"right","bdTop":"100"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];},1000);deferred.promise()});
*/
</script>


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
	left.style.cssText = "margin-top:" + (left.originMarginTop) + 'px';
	var viewportHeight = parseInt(getWindowViewport().height);
	var pageScrollTop = parseInt(getPageScrollOffset().y);
	var leftOffsetTop = parseInt(getElementOffsetTop(left));
	var rightBoxOffsetTop = parseInt(getElementOffsetTop(right));
	var rightBoxMarginTop = parseInt(right.style.marginTop.match(/\d+/));
	var maxMarginTopVal = rightHeight + rightBoxOffsetTop - leftOffsetTop - leftHeight; 

	if(maxMarginTopVal > 0){
		var startBack = rightBoxOffsetTop - pageScrollTop;
		if(startBack > 0){
			right.style.cssText = "margin-top:" + (pageScrollTop - rightOriginOffsetTop) + 'px';
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
				right.style.cssText = "margin-top:"+ (temp>0?temp:0) +'px';
			}
			return;
		}
		var actualVal = leftHeight + leftOffsetTop - rightHeight - rightOriginOffsetTop;
		var pos = startFloatDownVal >= actualVal ? actualVal : startFloatDownVal;
		right.style.cssText = "margin-top:" + pos + 'px';
	}

	if(rightBoxOffsetTop > pageScrollTop && rightBoxOffsetTop > rightOriginOffsetTop){
		var temp = pageScrollTop - rightOriginOffsetTop;
		right.style.cssText = "margin-top:"+ (temp>0?temp:0) +'px';
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