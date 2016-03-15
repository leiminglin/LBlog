(function(){

var archives_list_path = '<?php echo WEB_APP_PATH?>admin/archives/list';
var archives_post_path = '<?php echo WEB_APP_PATH?>admin/archives/post';

function get_list_archives_page(pid){
	var path = archives_list_path;
	if(pid){
		path += '/'+pid;
	}
	$.get(path, function(rs){
		create_tab('Archives', rs);
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
