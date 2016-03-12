(function(){

	var archives_list_path = '<?php echo WEB_APP_PATH?>admin/archives/list';
	var archives_post_path = '<?php echo WEB_APP_PATH?>admin/archives/post';

function get_list_archives_page(pid){
	var path = archives_list_path;
	if(pid){
		path += '/'+pid;
	}
	$.get(path, function(rs){
		$('#result').html(rs);
	});
}

function get_post_archives_page(id){
	var path = archives_post_path;
	if(id){
		path += '/'+id;
	}
	$.get(path, function(rs){
		$('#result').html(rs);
	});
}








lml.loadJs.competeLoad([
	'//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js',
	'//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
	'//code.jquery.com/jquery-1.11.1.min.js'], function(){

	get_list_archives_page(false);

	var taga_actions = {
		'lblog_admin_archives_list_page':function(o){
			if(o.getAttribute('data-id')){
				get_list_archives_page(o.getAttribute('data-id'));
			}else{
				get_list_archives_page(false);
			}
		},
		'lblog_admin_archives_post_page':function(o){
			if(o.getAttribute('data-id')){
				get_post_archives_page(o.getAttribute('data-id'));
			}else{
				get_post_archives_page();
			}
		}
	};

	on(document.body, 'click', function(e){
		var obj = e.target||e.srcElement;
		if(obj.tagName == 'A'){
			if(typeof taga_actions[obj.getAttribute('data-action')] == 'function'){
				taga_actions[obj.getAttribute('data-action')](obj);
			}
		}
	});

	$('#result').delegate("input[type=button]", "click", function(){
		$.post($(this.form).attr('action'), $(this.form).serialize(), function(rs){
			$('#result').html(rs);
		});
	});

});



})();
