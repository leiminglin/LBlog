
(function(){
	function lmledit(textarea_ele){

		var textarea=$(textarea_ele||'.lmledit_container');
		var edit_parent=textarea.parent();
		textarea.css({"display":"none"});
		
		var div_editable=$("<div/>").attr({"contentEditable":"true","class":"lmledit"}).html(textarea.val());
		var div_wrap=$("<div/>")
			.css({"width":"100%","border":"1px solid #d4d4d4","border-radius":"4px"})
			.addClass('lmledit_wrap');

		var image=$("<a/>")
			.append('image')
			.append(
				$("<div/>").css({"position":"absolute","background":"#fff","opacity":.92,
				"display":"none","left":"-165px","border":"1px solid #ccc","width":"100%"})
			)
			.css({"cursor":"pointer","position":"relative","display":"inline-block"})
			.mouseover(function(){
				if(!textarea.is(':visible')){
					$(this).children('div').show();
				}
			})
			.mouseout(function(){
				$(this).children('div').hide();
			})
			.click(function(e){
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
						getCaretPosition(div_editable, '<p>'+cobj.outerHTML+'</p>');
						return;
					}
					
					if(!this.loaded||true){
						var page=0;
						if(obj.tagName=='A'){
							page = obj.getAttribute('data-id')||0;
						}
						get_images_list_page(page, function(rs){
							$(_this).children('div').html(rs);
							_this.loaded=true;
						});
					}
				}
				return prevent(this);
			})
			.mousedown(function(){
				return prevent(this);
			});
		
		var code=$("<a/>")
			.html('code')
			.css({"margin":"0 5px","cursor":"pointer"})
			.click(function(){
				if(!textarea.is(':visible')){
					getCaretPosition(div_editable, '<pre class="code wbreak"><br></pre>');
				}
				return prevent(this);
			})
			.mousedown(function(){
				return prevent(this);
			});
		
		var paragraph=$("<a/>")
			.html('paragraph')
			.css({"margin":"0 5px","cursor":"pointer"})
			.click(function(){
				if(!textarea.is(':visible')){
					getCaretPosition(div_editable, '<p><br></p>');
				}
				return prevent(this);
			})
			.mousedown(function(){
				return prevent(this);
			});

		var html=$("<a/>")
			.html('html')
			.css({"cursor":"pointer"})
			.click(function(){
				if(panel.flag){
					div_editable.css({"display":"block"});
					textarea.css({"display":"none"});
					$(this).html('html');
					panel.flag=false;
				}else{
					textarea.css({"display":"block","height":div_editable.height()+'px',"width":'100%'});
					div_editable.css({"display":"none"});
					$(this).html('pvw');
					panel.flag=true;
				}
				return prevent(this);
			})
			.mousedown(function(){
				return prevent(this);
			});
		
		var f_list=$("<a/>")
			.html('list')
			.css({"margin":"0 5px","cursor":"pointer"})
			.click(function(){
				if(!textarea.is(':visible')){
					getCaretPosition(div_editable, '<ul><li></li></ul>');
				}
				return prevent(this);
			})
			.mousedown(function(){
				return prevent(this);
			});
		
		var f_h4=$("<a/>")
		.html('H4')
		.css({"margin":"0 5px","cursor":"pointer"})
		.click(function(){
			if(!textarea.is(':visible')){
				getCaretPosition(div_editable, '<h4></h4>');
			}
			return prevent(this);
		})
		.mousedown(function(){
			return prevent(this);
		});
		var f_h5=$("<a/>")
		.html('H5')
		.css({"margin":"0 5px","cursor":"pointer"})
		.click(function(){
			if(!textarea.is(':visible')){
				getCaretPosition(div_editable, '<h5></h5>');
			}
			return prevent(this);
		})
		.mousedown(function(){
			return prevent(this);
		});
		var f_h6=$("<a/>")
		.html('H6')
		.css({"margin":"0 5px","cursor":"pointer"})
		.click(function(){
			if(!textarea.is(':visible')){
				getCaretPosition(div_editable, '<h6></h6>');
			}
			return prevent(this);
		})
		.mousedown(function(){
			return prevent(this);
		});
		
		var f_bold=$("<a/>")
		.html('bold')
		.css({"margin":"0 5px","cursor":"pointer"})
		.click(function(){
			if(!textarea.is(':visible')){
				var sel=getSelection();
				if($(sel.anchorNode).closest(div_editable).length>0){
					if(sel.anchorNode!=sel.focusNode){
						if(typeof show_info=='function'){
							show_info('选择的内容不能跨节点');
						}
						return;
					}
					var nodeValue = sel.anchorNode.nodeValue;
					if(!nodeValue){
						return;
					}
					var minOffset=Math.min(sel.anchorOffset,sel.focusOffset);
					var maxOffset=Math.max(sel.anchorOffset,sel.focusOffset);
					var partOne=nodeValue.substring(0,minOffset);
					var partTwo=nodeValue.substring(minOffset,maxOffset);
					var partThree=nodeValue.substring(maxOffset,nodeValue.length);
					var strongData=partOne+'<strong>'+partTwo+'</strong>'+partThree;
					var strongNode=document.createTextNode(strongData);
					
					var result='';
					var childNodes=sel.anchorNode.parentNode.childNodes;
					for(var i=0,j=childNodes.length;i<j;i++){
						if(childNodes[i]==sel.anchorNode){
							result+=strongData;
						}else if(typeof childNodes[i].tagName!='undefined'){
							if(childNodes[i].tagName.match(/br/i)){
								continue;
							}
							result+='<'+childNodes[i].tagName+'>'+childNodes[i].innerHTML+'</'+childNodes[i].tagName+'>';
						}else{
							result+=childNodes[i].nodeValue||'';
						}
					}
					$(sel.anchorNode.parentNode).html(result);
				}
			}
			return prevent(this);
		})
		.mousedown(function(){
			return prevent(this);
		});
		
		var panel=$("<div/>")
			.addClass('panel')
			.css({"box-shadow":"0 1px 4px rgba(204, 204, 204, 0.67)","border-bottom":"1px solid #d4d4d4","line-height":"30px","padding":"0 10px"})
			.append(html)
			.append(paragraph)
			.append(code)
			.append(image)
			.append(f_list)
			.append(f_bold)
			.append(f_h4)
			.append(f_h5)
			.append(f_h6)
			.bind('mousedown click',function(){
				return prevent(this);
			});
		
		div_wrap.append(panel).append(div_editable).append(textarea).appendTo(edit_parent);

		$(div_editable).bind('keyup blur', function(){
			textarea.val(div_editable.html());
		});

		$(textarea).bind('keyup change blur', function(){
			div_editable.html(textarea.val());
		});
	}

	window.lmledit=lmledit;
	
	
	
	/*once*/


	function moveCaret(charCount) {
		var sel, range;
		if (window.getSelection) {
			sel = window.getSelection();
			if (sel.rangeCount > 0) {
				var textNode = sel.focusNode;
				var newOffset = sel.focusOffset + charCount;
				sel.collapse(textNode, Math.min(textNode.length, newOffset));
			}
		} else if ( (sel = window.document.selection) ) {
			if (sel.type != "Control") {
				range = sel.createRange();
				range.move("character", charCount);
				range.select();
			}
		}
	}


	
	var lblog_admin_images_path = '<?php echo WEB_APP_PATH?>admin/images/editorList';
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
			var panel=$('.lmledit_wrap').find('div.panel');
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
			if(!sel.getRangeAt || !sel.rangeCount){
				return;
			}

			range=sel.getRangeAt(0);
			var Ancestor=range.commonAncestorContainer,i=0;
			if(Ancestor==null){
				return;
			}
			
			if($(Ancestor).closest(editableDiv).length==0){
				range=document.createRange();
				if(editableDiv.children().length>0){
					var focusNode=editableDiv.children(":last").get(0);
				}else{
					var focusNode=editableDiv.get(0);
				}
				range.setStart(focusNode,0);
				range.setEnd(focusNode,0);
				sel.removeAllRanges();
				sel.addRange(range);
				Ancestor=range.commonAncestorContainer;
				sel = window.getSelection();
			}
			
			
			var el=document.createElement("div"),
			frag=document.createDocumentFragment(),node,lastNode;
			el.innerHTML = html;
			while ((node = el.firstChild)) {
				lastNode = frag.appendChild(node);
			}
			var firstNode = frag.firstChild;
			do{
				if(Ancestor.parentNode && Ancestor.parentNode == editableDiv[0]){
					$(frag).insertAfter($(Ancestor));
					if (lastNode) {
						/*range.setStartAfter(lastNode);
						range.setStartBefore(firstNode);*/
						toFocusNode(lastNode);
					}
					return;
				}else{
					Ancestor=Ancestor.parentNode;
				}
				i++;
			}while(i<5&&Ancestor);
			if($(range.commonAncestorContainer).closest(editableDiv).length>0){
				range.insertNode(frag);
				
				if (lastNode) {
					/*range.setStartAfter(lastNode);
					var selectPastedContent=true;
					if (selectPastedContent) {
						range.setStartBefore(firstNode);
					} else {
						range.collapse(true);
					}*/
					toFocusNode(lastNode);
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
	
	function toFocusNode(lastNode){
		var range=document.createRange();
		var focusNode=lastNode;
		var sel=getSelection();
		if($(lastNode).find('img').length>0){
			focusNode=$(lastNode).find('img')[0];
			range.setStartAfter(focusNode,0);
			range.setEndAfter(focusNode,0);
		}else if($(lastNode).find('li').length>0){
			focusNode=$(lastNode).find('li')[0];
			range.setStart(focusNode,0);
			range.setEnd(focusNode,0);
		}else{
			range.setStart(focusNode,0);
			range.setEnd(focusNode,0);
		}
		sel.removeAllRanges();
		sel.addRange(range);
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
			'border:1px dotted red;'+
			'min-height:20px;'+
		'}'+
		'.lmledit ul{'+
			'border:1px dotted blue;'+
			'min-height:20px;'+
			'margin:2px;'+
		'}'+
		'.lmledit ul li{'+
			'list-style:disc !important;'+
			'border:1px dotted green;'+
			'min-height:20px;'+
			'margin:2px 30px;'+
		'}'+
		'.lmledit div{'+
			'border:2px dotted orange;'+
			'min-height:30px;'+
		'}'+
		'.lmledit h4{'+
			'border:3px dotted black;'+
			'min-height:30px;'+
		'}'+
		'.lmledit h5{'+
			'border:2px dotted black;'+
			'min-height:25px;'+
		'}'+
		'.lmledit h6{'+
			'border:1px dotted black;'+
			'min-height:20px;'+
		'}'+
		'.lmledit p img{'+
			'max-width:40%;'+
			'height:auto;'+
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
