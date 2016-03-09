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