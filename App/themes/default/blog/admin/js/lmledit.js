<?php
//lml()->app()->setOneSloc(false);
?>
(function(){
	function lmledit(){
		var textarea=$('.tabs_content').children(':visible').find('textarea[name=content]');
		var td = textarea.parent();
		textarea.css({"display":"none"});
		
		var div = $("<div/>").attr({"contentEditable":"true","class":"lmledit"}).html(textarea.val());
		var divwrap = $("<div/>").css({"width":"670px","border":"1px solid #d4d4d4","border-radius":"4px"});
		var image = $("<a/>").append('image').append($("<div/>")
				.css({"position":"absolute","background":"#fff","opacity":.92,
					"display":"none","left":"-165px","border":"1px solid #ccc","width":"670px"}))
		.css({"cursor":"pointer","position":"relative","display":"inline-block"}).mouseover(function(){
			if(!textarea.is(':visible')){
				$(this).children('div').show();
			}
		}).mouseout(function(){
			$(this).children('div').hide();
		}).click(function(e){
			if(!textarea.is(':visible')){
				var _this=this;
				var obj = e.target||e.srcElement;
				if(obj.tagName == 'IMG'){
					var cobj=$(obj).clone(true)[0];
					var title=$(this).closest('form').find('input[name=title]').val();
					cobj.alt=title;
					cobj.title=title;
					cobj.width=$(obj).next().html();
					cobj.height=$(obj).next().next().html();
					getCaretPosition(div, '<p>'+cobj.outerHTML+'</p>');
				}
				
				if(!this.loaded){
					get_images_list_page(0, function(rs){
						$(_this).children('div').html(rs);
						_this.loaded=true;
					});
				}
			}
			return prevent(this);
		}).mousedown(function(){
			return prevent(this);
		});
		
		var code = $("<a/>").html('code').css({"margin":"0 5px","cursor":"pointer"}).click(function(){
			if(!textarea.is(':visible')){
				getCaretPosition(div, '<pre class="code wbreak">code here</pre>');
			}
			return prevent(this);
		}).mousedown(function(){
			return prevent(this);
		});
		
		var paragraph = $("<a/>").html('paragraph').css({"margin":"0 5px","cursor":"pointer"}).click(function(){
			if(!textarea.is(':visible')){
				getCaretPosition(div, '<p>content here</p>');
			}
			return prevent(this);
		}).mousedown(function(){
			return prevent(this);
		});
		
		var panel = $("<div/>").addClass('panel').css({"box-shadow":"0 1px 4px rgba(204, 204, 204, 0.67)","border-bottom":"1px solid #d4d4d4","line-height":"30px","padding":"0 10px"})
		.append($("<a/>").html('html').css({"cursor":"pointer"}).click(function(){
			if(panel.flag){
				div.css({"display":"block"});
				textarea.css({"display":"none"});
				$(this).html('html');
				panel.flag=false;
			}else{
				textarea.css({"display":"block","height":div.height()+'px',"width":'664px'});
				div.css({"display":"none"});
				$(this).html('pvw');
				panel.flag=true;
			}
			return prevent(this);
		}).mousedown(function(){
			return prevent(this);
		}))
		.append(paragraph)
		.append(code)
		<?php if(p('images_editor_list')){?>
		.append(image)
		<?php }?>
		.bind('mousedown click',function(){
			return prevent(this);
		});
		
		divwrap.append(panel).append(div).append(textarea).appendTo(td);

		$(div).bind('keyup blur', function(){
			textarea.val(div.html());
		});
		$(textarea).bind('keyup change blur', function(){
			div.html(textarea.val());
		});
	}

	window.lmledit=lmledit;
	
	
	
	/*once*/
	
	var lblog_admin_images_path = '<?php echo WEB_APP_PATH?>admin/images/listEditor';
	function get_images_list_page(o, cb){
		var path = lblog_admin_images_path;
		if(o){
			path += '/'+o;
		}
		get(path, function(rs){
			cb(rs);
		});
	}
	
	$(document).scroll(function(){
		clearTimeout(this.timer);
		this.timer=setTimeout(function(){
			var panel=$('.tabs_content').children(':visible').find('div.panel');
			var element = panel[0];
			if(!element){
				return;
			}
			var cpanel = element.cpanel;
			if(!cpanel){
				cpanel=element.cpanel=panel.clone(true).css({"display":"none","background":"#fff","opacity":.9}).insertAfter(panel);
			}
			
			if($(document).scrollTop()>panel.offset().top){
				if(element.fixed){
					return;
				}
				cpanel.css({"position":"fixed","top":0,"display":"block"});
				element.fixed=true;
			}else{
				if(!element.fixed){
					return;
				}
				cpanel.css({"position":'inherit',"display":"none"});
				element.fixed=false;
			}
		},50);
	});

	function getCaretPosition(editableDiv, html){
		var caretPos = 0, containerEl = null, sel, range;
		if (window.getSelection) {
			sel = window.getSelection();
			if(sel.rangeCount && sel.getRangeAt){
				range = sel.getRangeAt(0);
				var Ancestor = range.commonAncestorContainer,i=0;
				if(Ancestor==null){
					return;
				}
				var el=document.createElement("div"),
				frag=document.createDocumentFragment(),node,lastNode;
				el.innerHTML = html;
				while ((node = el.firstChild)) {
					lastNode = frag.appendChild(node);
				}
				var firstNode = frag.firstChild;
				do{
					if(Ancestor.parentNode && Ancestor.parentNode.parentNode == editableDiv[0]){
						$(frag).insertAfter($(Ancestor));
						if (lastNode) {
							range = range.cloneRange();
							range.setStartAfter(lastNode);
							range.setStartBefore(firstNode);
							sel.removeAllRanges();
							sel.addRange(range);
						}
						return;
					}else{
						Ancestor=Ancestor.parentNode;
					}
					i++;
				}while(i<5&&Ancestor);
				if($(range.commonAncestorContainer).closest(editableDiv).length>0){
					range.insertNode(frag);
					var selectPastedContent=true;
					if (lastNode) {
						range = range.cloneRange();
						range.setStartAfter(lastNode);
						if (selectPastedContent) {
							range.setStartBefore(firstNode);
						} else {
							range.collapse(true);
						}
						sel.removeAllRanges();
						sel.addRange(range);
					}
				}
			}
		} else if (document.selection && document.selection.createRange) {
			range = document.selection.createRange();
			if (range.parentElement() == editableDiv) {
				var tempEl = document.createElement("span");
				editableDiv.insertBefore(tempEl, editableDiv.firstChild);
				var tempRange = range.duplicate();
				tempRange.moveToElementText(tempEl);
				tempRange.setEndPoint("EndToEnd", range);
				caretPos = tempRange.text.length;
			}
		}
		return caretPos;
	}

	function prevent(e){
		e = e || window.event;
		if(e.preventDefault && e.stopPropagation){
			e.preventDefault();
			e.stopPropagation();
		}
		return false;
	}

	var style_str = 
		'.lmledit{'+
			'padding:10px;'+
		'}'+
		'.lmledit .intro{'+
			'font-size:14px;'+
			'line-height:26px;'+
			'text-indent:2em;'+
		'}'+
		'.lmledit .code{'+
			'background-color:#fefefe;'+
			'border:2px solid #F7F7F7;'+
			'color:#222;'+
			'padding:10px;'+
			'font-family:Monaco,"DejaVu Sans Mono","Courier New",monospace;'+
			'font-size:13px;'+
			'margin:10px 0;'+
			'overflow:auto;'+
			'text-indent:0;'+
		'}'+
		'.lmledit .wbreak{'+
			'white-space:normal;'+
			'white-space:pre-wrap;'+
			'white-space:-moz-pre-wrap;'+
			'white-space:-pre-wrap;'+
			'white-space:-o-pre-wrap;'+
			'word-wrap:break-word;'+
			'word-break:break-all;'+
		'}'+
		'.lmledit p{'+
			'border:1px dotted red'+
		'}'+
		'.lmledit p img{'+
		'margin:0 auto;'+
		'display:block;'+
		'}';
	var style = document.createElement("style");
	style.type="text/css";
	if(style.styleSheet){
		style.styleSheet.cssText = style_str;
	} else {
		style.innerHTML = style_str;
	}
	$(document.body).append(style);
	
})();