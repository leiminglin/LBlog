function get_list_archives(pid){
	var url = '<?php echo WEB_APP_PATH?>admin/archives/list';
	if(pid){
		url += '/'+pid;
	}
	form_iframe_get(url, function(rs){
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

get_list_archives();