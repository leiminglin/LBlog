(function(){

var archives_list_path = '<?php echo WEB_APP_PATH?>admin/archives/list';
var archives_post_path = '<?php echo WEB_APP_PATH?>admin/archives/post';
var archives_relation_path = '<?php echo WEB_APP_PATH?>admin/archives/relation';
var archives_relation_remove_path = '<?php echo WEB_APP_PATH?>admin/archives/relation/remove';
var archives_relation_set_path = '<?php echo WEB_APP_PATH?>admin/archives/relation/set';
var cats_list_path = '<?php echo WEB_APP_PATH?>admin/cats/list';
var cats_save_path = '<?php echo WEB_APP_PATH?>admin/cats/save';
var statistics_list_path = '<?php echo WEB_APP_PATH?>admin/statistics/list';
var settings_path = '<?php echo WEB_APP_PATH?>admin/settings';
var users_path = '<?php echo WEB_APP_PATH?>admin/users/list';
var users_set_account_path = '<?php echo WEB_APP_PATH?>admin/users/set_account';
var roles_path = '<?php echo WEB_APP_PATH?>admin/roles/list';
var roles_save_path = '<?php echo WEB_APP_PATH?>admin/roles/save';
var permissions_list_path = '<?php echo WEB_APP_PATH?>admin/permissions/list';

function get_list_archives_page(pid){
	var path = archives_list_path;
	if(pid){
		path += '/'+pid;
	}
	get(path, function(rs){
		create_tab('Archive', rs);
	});
}

function get_post_archives_page(id){
	var path = archives_post_path,title='发布';
	if(id){
		path += '/'+id;
		title = '编辑-'+id;
	}
	get(path, function(rs){
		create_tab(title, rs);
	});
}

function get_relation_archives_list_page(pid){
	var path = archives_relation_path;
	if(pid){
		path += '/'+pid;
	}
	get(path, function(rs){
		create_tab('Relation', rs);
	});
}

function remove_relation_archives(o){
	var path = archives_relation_remove_path;
	post(path, {'relation_ids':o.getAttribute('data-id')}, function(rs){
		show_info(rs);
		$(o).addClass('hidden');
		$(o).siblings('a').removeClass('hidden');
	});
}

function set_relation_archives(o){
	var path = archives_relation_set_path;
	post(path, {'relation_ids':o.previousSibling.value}, function(rs){
		show_info(rs);
		var x = $('.tabs_content').children(':visible').find('a.current').html();
		get_relation_archives_list_page(x);
	});
}

function get_cats_list_page(o){
	var path = cats_list_path;
	if(o){
		path += '/'+o;
	}
	get(path, function(rs){
		create_tab('Cat', rs);
	});
}

function get_statistics_list_page(o){
	var path = statistics_list_path;
	if(o.getAttribute('data-id')){
		path += '/'+o.getAttribute('data-id');
	}

	get(path, function(rs){
		create_tab('Statistic', rs);
	});
}

function save_cat(name, id){
	var path = cats_save_path;
	if(id){
		path +='/'+id;
	}
	post(path, {'name':name}, function(rs){
		show_info(rs);
		var x = $('.tabs_content').children(':visible').find('a.current').html();
		get_cats_list_page(x);
	});
}

function get_settings_page(){
	var path = settings_path;
	get(path, function(rs){
		create_tab('Setting', rs);
	});
}

function get_users_page(o){
	var path = users_path;
	if(o){
		path += '/'+o;
	}

	get(path, function(rs){
		create_tab('User', rs);
	});
}

function get_roles_page(o){
	var path = roles_path;
	if(o){
		path += '/'+o;
	}
	get(path, function(rs){
		create_tab('Role', rs);
	});
}

function save_role(name, id){
	var path = roles_save_path;
	if(id){
		path +='/'+id;
	}
	post(path, {'name':name}, function(rs){
		show_info(rs);
		var x = $('.tabs_content').children(':visible').find('a.current').html();
		get_roles_page(x);
	});
}

function set_account(id, rid){
	var path = users_set_account_path+'/'+id+'/'+rid;
	post(path, {"userid":id, "roleid":rid}, function(rs){
		show_info(rs);
		var x = $('.tabs_content').children(':visible').find('a.current').html();
		get_users_page(x);
	});
}

function get_permissions_list_page(o){
	var path = permissions_list_path;
	if(o){
		path += '/'+o;
	}
	get(path, function(rs){
		create_tab('Permission', rs);
	});
}







lml.loadJs.competeLoad([
	'//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js',
	'//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
	'//code.jquery.com/jquery-1.11.1.min.js'], function(){

	
	get_list_archives_page(false);
	
	$('.left ul li a').click(function(){
		$(this).addClass('cl');
		$(this).parent('li').siblings().find('a').removeClass('cl');
	});
	
	$('.tabs_title').delegate("a", "click", function(e){
		var title = $(this).attr('data-tab');
		$(this).siblings().removeClass('bbw');
		$(this).addClass('bbw');
		$('div.tabs_content').children().addClass('hidden');
		$('div.tabs_content').children('div[data-tab='+title+']').removeClass('hidden');
		adjust_right();
	});
	
	$('.tabs_title').delegate("a", "mouseover", function(e){
		if($(this).siblings().length==0){
			return;
		}
		if(!this.close){
			var _this = this;
			this.close = $('<div/>').html('×').css({"display":"block","width":"16px","font-size":"16px",
				"position":"absolute","top":"-9px","line-height":"16px","color":"#ccc",
				"border":"1px solid #ccc","border-radius":"8px","background":"#fff",
				"text-align":"center","left":this.offsetWidth-9+'px'})
				.mouseover(function(){
					$(this).css({"color":"#ff6f3d","border":"1px solid #ff6f3d"});
				}).mouseout(function(){
					$(this).css({"color":"#ccc","border":"1px solid #ccc"});
				}).click(function(){
					var title = $(_this).attr('data-tab');
					var content = $('div.tabs_content').children('div[data-tab='+title+']');
					if($(_this).hasClass('bbw')){
						if($(_this).prev().length>0){
							$(_this).prev().addClass('bbw');
							$('div.tabs_content').children('div[data-tab='+$(_this).prev().attr('data-tab')+']').removeClass('hidden');
						}else{
							$(_this).next().addClass('bbw');
							$('div.tabs_content').children('div[data-tab='+$(_this).next().attr('data-tab')+']').removeClass('hidden');
						}
					}
					content.remove();
					$(_this).remove();
					adjust_right();
				}).appendTo($(this));
		}
		this.close.css({"display":"block"});
	});
	
	$('.tabs_title').delegate("a", "mouseout", function(e){
		if(this.close){
			this.close.css({"display":"none"});
		}
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
		},
		'edit_specified_archives':function(o){
			get_post_archives_page(o.previousSibling.value);
		},
		'lblog_admin_archives_relation_page':function(o){
			if(o.getAttribute('data-id')){
				get_relation_archives_list_page(o.getAttribute('data-id'));
			}else{
				get_relation_archives_list_page(false);
			}
		},
		'lblog_admin_archives_relation_remove':function(o){
			remove_relation_archives(o);
		},
		'lblog_admin_set_relation_archives':function(o){
			set_relation_archives(o);
		},
		'lblog_admin_cats_page':function(o){
			if(o.getAttribute('data-id')){
				get_cats_list_page(o.getAttribute('data-id'));
			}else{
				get_cats_list_page(false);
			}
		},
		'lblog_admin_statistics_page':function(o){
			get_statistics_list_page(o)
		},
		'lblog_admin_cats_post':function(o){
			save_cat(o.previousSibling.value);
		},
		'lblog_admin_cats_edit':function(o){
			var td = $(o).parent().prev(), name=td.html();
			if(o.flag){
				save_cat(td.children('input').val(), o.getAttribute('data-id'));
			}else{
				td.html($("<input/>").val(name).attr({"type":"text"}));
				$(o).html('Save');
				o.flag = 1;
			}
		},
		'lblog_admin_settings_page':function(o){
			get_settings_page(o);
		},
		'lblog_admin_users_page':function(o){
			get_users_page();
		},
		'lblog_admin_roles_page':function(o){
			if(o.getAttribute('data-id')){
				get_roles_page(o.getAttribute('data-id'));
			}else{
				get_roles_page(false);
			}
		},
		'lblog_admin_roles_post':function(o){
			save_role(o.previousSibling.value);
		},
		'lblog_admin_roles_edit':function(o){
			var td = $(o).parent().prev(), name=td.html();
			if(o.flag){
				save_role(td.children('input').val(), o.getAttribute('data-id'));
			}else{
				td.html($("<input/>").val(name).attr({"type":"text"}));
				$(o).html('Save');
				o.flag = 1;
			}
		},
		'lblog_admin_users_edit':function(o){
			var td = $(o).parent().prev().prev(),role=td.html(),roles=$('select.roles_select').clone();
			if(o.flag){
				set_account(o.getAttribute('data-id'), $('select', td).val());
			}else{
				td.html(roles.removeClass('hidden').prop('outerHTML'));
				$(o).html('Save');
				$("select option:contains('"+role+"')", td).attr("selected",true);
				o.flag = 1;
			}
		},
		'lblog_admin_permissions_page':function(o){
			if(o.getAttribute('data-id')){
				get_permissions_list_page(o.getAttribute('data-id'));
			}else{
				get_permissions_list_page(false);
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
		var _this = this;
		this.disabled = true;
		post($(this.form).attr('action'), $(this.form).serialize(), function(rs){
			if(_this.getAttribute('data-need-refresh')==1){
				$('.tabs_content').children(':visible').html(rs);
			}else{
				show_info(rs||'Save Successfully!');
			}
			_this.disabled = false;
			adjust_right();
		});
	});

	$(document).keydown(function(e){
		if(e.keyCode==13){
			var obj = e.target||e.srcElement;
			if(obj.tagName=='INPUT'){
				e.preventDefault();
			}
		}
	});

	$.ajaxSetup({global:true});
	$(document).ajaxError(function(event, jqxhr, settings, thrownError){
		/*console.log(event, jqxhr, settings, thrownError);*/
		if(jqxhr.status == 401){
			window.location.reload();
		}
	});

},function(){
	$.noConflict();
});



})();
