(function(){

	var archives_list_path = '<?php echo WEB_APP_PATH?>admin/archives/list';
	var archives_post_path = '<?php echo WEB_APP_PATH?>admin/archives/post';

function get_list_archives_page(pid){
	var path = archives_list_path;
	if(pid){
		path += '/'+pid;
	}
	$.get(path, function(rs){
		create_tab('列表', rs);
	});
}

function get_post_archives_page(id){
	var path = archives_post_path,title='发布';
	if(id){
		path += '/'+id;
		title = '编辑-'+id;
	}
	$.get(path, function(rs){
		create_tab(title, rs);
	});
}

function create_tab(title, content){
	var tags_title = $('.tabs_title');
	var tags_content = $('.tabs_content');
	var tag_title = $('a[data-tab='+title+']', tags_title);
	
	$(tags_title).children('a').removeClass('bbw');
	$(tags_content).children('div').addClass('hidden');
	
	if(tag_title.length==0){
		$('<a/>').attr('data-tab', title).html(title).addClass('bbw').appendTo(tags_title);
		$('<div/>').attr('data-tab', title).html(content).appendTo(tags_content);
	}else{
		$('a[data-tab='+title+']', tags_title).addClass('bbw');
		$('div[data-tab='+title+']', tags_content).removeClass('hidden').html(content);
	}
	adjust_right();
}

function modify_tab_title(origin_title, new_title){
	var tags_title = $('.tabs_title');
	var tags_content = $('.tabs_content');
	$(tags_title).children('a[data-tab='+origin_title+']').attr({"data-tab":new_title}).html(new_title);
	$(tags_content).children('div[data-tab='+origin_title+']').attr({"data-tab":new_title});
}






lml.loadJs.competeLoad([
	'//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js',
	'//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
	'//code.jquery.com/jquery-1.11.1.min.js'], function(){

	
	get_list_archives_page(false);
	
	$('.tabs_title').delegate("a", "click", function(e){
		var title = $(this).attr('data-tab');
		$(this).siblings().removeClass('bbw');
		$(this).addClass('bbw');
		$('div.tabs_content').children().addClass('hidden');
		$('div.tabs_content').children('div[data-tab='+title+']').removeClass('hidden');
		adjust_right();
	});

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
			$('.tabs_content').children(':visible').html(rs);
			adjust_right();
			show_info('Save Successfully!');
		});
	});

});



})();
