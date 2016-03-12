function get_list_archives_page(pid){
	var url = '<?php echo WEB_APP_PATH?>admin/archives/list';
	if(pid){
		url += '/'+pid;
	}
	form_iframe_get(url, function(rs){
		document.getElementById('result').innerHTML = rs;
	});
}

function get_edit_archives_page(id){
	form_iframe_get('<?php echo WEB_APP_PATH?>admin/archives/edit/'+id, function(rs){
		document.getElementById('result').innerHTML = rs;
	});
}

function get_post_archives_page(){
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








get_list_archives_page(false);

var taga_actions = {
	'lblog_admin_archives_list_page':function(o){
		if(o.getAttribute('data-id')){
			get_list_archives_page(o.getAttribute('data-id'));
		}else{
			get_list_archives_page(false);
		}
	},
	'lblog_admin_archives_post_page':get_post_archives_page,
	'lblog_admin_archives_edit_page':function(o){
		if(o.getAttribute('data-id')){
			get_edit_archives_page(o.getAttribute('data-id'));
		}
	}
};
var tagform_actions = {
	'lblog_admin_archives_save':function(o){
		return get_save_archives(o);
	}
};

on(document.body, 'click', function(e){
	var obj = e.target||e.srcElement;
	if(obj.tagName == 'A'){
		if(typeof taga_actions[obj.getAttribute('data-action')] == 'function'){
			taga_actions[obj.getAttribute('data-action')](obj);
		}
	}
})






