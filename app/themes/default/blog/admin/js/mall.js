function goods_init(){

var visible_tab = $('.tabs_content').children(':visible');



$('a[data-action=lblog_admin_images_editor_page]',visible_tab).hover(function(){
	$(this).children('div').show();
},function(){
	$(this).children('div').hide();
});



$('div.template_imgs',visible_tab).delegate('img','click',function(){
	$('.img_container',$(this).closest('.image_edit_album'))
	.append(
		$('<div/>')
		.append($(this).clone())
		.addClass('wrap')
		.append($("<div/>").html('<a href="javascript:void(0)">移除</a>').addClass('close'))
	);
});

$('div.img_container',visible_tab).delegate('.close a','click',function(){
	$(this).closest('div.wrap').remove();
});



$('input[type=button]',visible_tab).click(function(){
	var imgids=[];
	$('.img_container',visible_tab).find('img').each(function(){
		imgids.push(this.src.match(/\/file\/image\/(\d+)/)[1]);
	});
	$('input[name=images]',visible_tab).val(imgids.join(','));
});

};



(function(){
	var style_str='
	.template_imgs{
		width:100%;
		position:absolute;
		display:none;
		opacity:.9;
		background:white;
		z-index:9;
	}
	.img_container .wrap{
		text-align:center;
		float:left;
		width:100px;
		height:105px;
		border:1px dotted green;
		margin-right:2px;
		position:relative;
	}
	.img_container .wrap img{
		max-width:100px;
		max-height:80px;
	}
	.img_container .close{
		text-align:center;
		position:absolute;
		bottom:0;
		left:0;
		right:0;
	}';
	var style = document.createElement("style");
	style.type="text/css";
	if(style.styleSheet){
		style.styleSheet.cssText = style_str;
	} else {
		style.innerHTML = style_str;
	}
	$(document.body).append(style);
})();

