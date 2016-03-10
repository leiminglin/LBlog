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

	var loadedDo = function(){
		callback(c_iframe.contentWindow.document.body.innerHTML);
		c_form.parentNode.removeChild(c_form);
		c_iframe.parentNode.removeChild(c_iframe);
		adjust_right();
	};

	if(c_iframe.attachEvent){
		c_iframe.attachEvent("onload", function(){
			loadedDo();
		});
	} else {
		c_iframe.onload = function(){
			loadedDo();
		};
	} 
}

function adjust_right(){
	var left_w = document.getElementsByClassName('left')[0].offsetWidth
	,body_w = document.body.clientWidth, right = document.getElementsByClassName('right')[0];
	right.style.width = body_w - left_w + "px";
}

lml.registerOnResize(adjust_right);

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

