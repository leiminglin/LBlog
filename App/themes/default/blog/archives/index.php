<?php
$keywords=$description=$title = Tool::htmlspecialcharsDeep($article['title']);
$current_cat = array();
foreach ($cats as $t){
	if($t['id'] == $article['catid']){
		$current_cat['id'] = $t['id'];
		$current_cat['name'] = $t['name'];
		break;
	}
}
include DEFAULT_THEME_PATH.C_GROUP.'/@common/meta.php';
?>
<title><?php echo $title,' - ',arr_get($current_cat, 'name')?> - <?php ehtml(SITE_NAME);?></title>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/header.php';
?>

<div class="content">
<div class="contop"></div>
<div class="left">

<div class="lbox litem">
<h2>
<a href="<?php echo Tool::getArticleUrl($id, $article['url']);?>" name="title"><?php ehtml($article['title']);?></a>
<a href="<?php echo WEB_APP_PATH?>cat/<?php echo arr_get($current_cat, 'id')?>">
<span class="tag">
<span class="arrow"></span>
<?php ehtml(arr_get($current_cat, 'name'))?>
</span></a>
</h2>
<div class="author"><span><a><?php ehtml($article['nickname'])?></a> 发表于<a><?php echo date("Y-m-d H:i", $article['createtime'])?></a></span></div>
<div class="essay">
<div class="intro">
<?php echo Tool::getOriginLinks(Tool::getArticleUrl($id, $article['url']))?>
</div>
<?php echo preg_replace('/<img([\s\S]+?)src\s*=([\s\S]+?)>/i', "<img$1osrc=$2>", $article['content'])?>
</div>
<div class="essaybottom">
<a href="<?php echo Tool::getArticleUrl($id, $article['url']);?>#title">阅(<?php echo $article['viewtimes']?$article['viewtimes']:0;?>)</a>
<a href="<?php echo Tool::getArticleUrl($id, $article['url']);?>#comment">评(<?php echo $article['commenttimes']?$article['commenttimes']:0?>)</a>
<a href="<?php echo Tool::getArticleUrl($id, $article['url']);?>#viewcomment">查看评论</a>
</div>
</div>
<style>
.comments{
	margin-right:10px;
}
.commentitem {
	border-bottom: 1px dotted #ccc;
	min-height: 100px;
	padding: 5px 0;
}
.commentitem .avatar {
	float: left;
	height: 100px;
	width: 100px;
}
.commentitem .itext {
	padding-left:120px;
	word-break:break-all;
}
.relations{
	font-size:14px;
	line-height:24px;
	margin:0 0 20px;
}
.relations span{
	font-size:18px;
	color:#333;
}
.relations a{
	color:#004276;
}
.relations a:hover{
	color:#ff6f3d;
}
</style>

<div class="lbox litem">

<?php
if( $relevance ){
?>
<div class="relations">
<table width="100%">
<tr><td cols="2"><span>相关文章</span></td></tr>
<tr>
<?php foreach ($relevance as $k=>$v){?>
<?php if( $k > 0 && $k % 2 == 0 ) { echo '</tr><tr>';} ?>
<td><a href="<?php echo Tool::getArticleUrl($v['aid'], $v['url']);?>" target="_blank"><?php $article = $this->mArchives->getArticleTitleById($v['aid']);ehtml($article['title'])?></a></td>
<?php }?>
</tr>
</table>
</div>
<?php }?>

<div class="relations">
<table width="100%">
<tr><td cols="2"><span>同期文章</span></td></tr>
<tr>
<?php foreach ($relations as $k=>$v){?>
<?php if( $k > 0 && $k % 2 == 0 ) { echo '</tr><tr>';} ?>
<td><a href="<?php echo Tool::getArticleUrl($v['id'], $v['url']);?>" target="_blank"><?php ehtml($v['title'])?></a></td>
<?php }?>
</tr>
</table>
</div>
</div>

<div class="lbox litem">
<table>
<tr><td><script id="commentarea" type="text/plain"></script></td></tr>
<tr><td><a class="linkbtn" style="display:none;" name="comment">提交评论</a></td></tr>
</table>
</div>
<div><a name="viewcomment">评论列表</a></div>
<div class="comments">
<?php if($comments){foreach ($comments as $k=>$v){?>
<div class="commentitem">
<div class="avatar"><img osrc="<?php echo $v['userinfo']['avatar']?>" width="100" height="100" alt="
<?php ehtml($v['nickname'])?>" title="<?php ehtml($v['nickname'])?>"/></div>
<div class="itext">
<div>
<a name="viewcomment_<?php echo $v['id']?>"><?php ehtml($v['nickname'])?></a>:
</div>
<?php echo $v['content']?></div>
<div class="clear"></div>
</div>
<?php }}else{echo '暂无';}?>
</div>
</div>
<div class="right">
<!-- right -->
<?php
$this->render(DEFAULT_THEME_PATH.C_GROUP.'/@common/rightwidget.php');
?>
</div>
<div class="clear"></div>
</div>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/bottom.php';
?>
<textarea class="lazyCss hidden">
.login_template{
	display:none;
}
.login_template .mask{
	width:100%;
	height:100%;
	position:fixed;
	left:0;
	top:0;
	z-index:10000;
	opacity:0.15;
	filter:alpha(opacity=15);
	background:#000;
}
.login_template .loginpage{
	width:300px;
	height:400px;
	position:fixed;
	left:50%;
	top:50%;
	margin-left:-150px;
	margin-top:-200px;
	background:#FFF;
	opacity:1;
	filter:alpha(opacity=100);
	z-index:10001;
	
	-webkit-box-shadow:0 0 8px 10px #e9d9e9;  
	-moz-box-shadow:0 0 8px 10px #e9d9e9;  
	box-shadow:0 0 8px 10px #e9d9e9;
}
.login_template .loginheader{
	font-size:16px;
	height:40px;
	line-height:40px;
	background-color:#F7F7F7;
}
.login_template .loginheader .close{
	width:18px;
	height:18px;
	float:right;
	margin:9px 9px 0 0;
}
.login_template .loginheader span{
	padding-left:20px;
	display:block;
	text-indent:10px;
	font-weight:bold;
}
.login_template .loginheader .loginlogo{
	float:left;
	margin:5px 0 0 20px;
}
.login_template .loginheader .close{
	background-image:url(<?php echo Tool::getCDNUrl('login_icons.png')?>);
	background-repeat:no-repeat;background-position:-54px -45px;
}
.login_template .loginheader .closehover{
	background-image:url(<?php echo Tool::getCDNUrl('login_icons.png')?>);
	background-repeat:no-repeat;background-position:-70px -45px;
}
</textarea>
<div class="login_template">
<!--
<div class="mask"></div>
<div class="loginpage">
<div class="loginheader">
<div class="loginlogo">
<img src="<?php echo Tool::getCDNUrl('lbloglogo100.png')?>" width="30" height="30" alt="<?php ehtml(SITE_NAME)?>" title="<?php ehtml(SITE_NAME)?>"/>
</div>
<div class="close"></div>
<span>登录<?php ehtml(SITE_NAME)?></span>
</div>
</div>
 -->
</div>
<script type="text/javascript">
deferred.then(function(){
	var def2 = lml.createDeferred();
	def2.then(function(){
		lml.loadJs('<?php echo Tool::getCDNUrl('ueditorconfig.txt')?>', function(){
			def2.promise();
		});
	});
	def2.then(function(){
		lml.loadJs('<?php echo Tool::getCDNUrl('ueditorallmin.txt')?>', function(){
			def2.promise();
		});
	});
	def2.then(function(){
		lml.loadJs('//code.jquery.com/jquery.min.js', function(){
			def2.promise();
		});
	});
	def2.then(function(){
		var ue = UE.getEditor('commentarea', {
			toolbars: [
				['fullscreen', 'source', 'undo', 'redo', 'bold','italic','preview','horizontal','fontfamily',
					 'underline','strikethrough','formatmatch','removeformat','link','unlink','justifyleft','justifyright',
					'justifycenter','justifyjustify','forecolor','backcolor']
			],
			autoHeightEnabled: true,
			autoFloatEnabled: true,
			initialFrameWidth:650,
			initialFrameHeight:100,
			elementPathEnabled:false,
			enableAutoSave:false,
			saveInterval:500,
			wordCount:false,
			autoFloatEnabled:false,
			UEDITOR_HOME_URL:'<?php echo WEB_PATH?>static/ueditor/',
			serverUrl:'<?php echo WEB_PATH?>static/ueditor/php/controller.php'
		});

		function showInfo(v, f, w, s){
			var a = $("<div/>")
			.attr({"style":"border:1px solid green;background:#fff;z-index:10000;-webkit-box-shadow:0 0 8px 10px #ccc;"
				+"-moz-box-shadow:0 0 8px 10px #ccc;box-shadow:0 0 8px 10px #ccc;"
				+"position:fixed;_position:absolute;_bottom:auto;padding:5px;top:-42px;left:50%;text-align:center;line-height:30px;border-radius:5px;"})
			.css({"opacity":.5})
			.html(v),f=f||200,s=s||1000,w=w||1000;
			$(document.body).append(
				a.animate({"top":"100px","opacity":1}, f)
				.delay(w)
				.animate({"top":"-42px","opacity":.5}, s)
				.queue(function(){a.remove()}));
			a.css({'margin-left': -a.width()/2+'px'});
		};

		function show_login(){
			var logindiv = $('.login_template');
			if(this.flag){
				logindiv.show();
				return;
			}
			this.flag = 1;
			logindiv.html(logindiv.html().replace(/<!--|-->/g,''));
			logindiv.show();
			logindiv.children('.loginpage').append($('<div/>').css({"padding":"20px"}).html('<br/>请选择登录方式<br/>'))
			.append('<div class="login" style="padding:20px;"><div class="logintype">'
					+'<a href="javascript:void(0)" onclick="javascript:toQzoneLogin();return false;">'
					+'<img alt="Use qq login" title="使用QQ登录" src="<?php echo Tool::getCDNUrl('qq_login.png');?>" height="24" width="120"></a>'
					+'</div><div class="logintype">'
					+'<a href="javascript:void(0)" onclick="javascript:toWeiboLogin();return false;">'
					+'<img alt="Use weibo login" title="使用新浪微博登录" src="<?php echo Tool::getCDNUrl('weibo_login.png');?>" height="24" width="120">'
					+'</a></div></div>');
			$('.close',logindiv).hover(function(){
				$(this).addClass('closehover');
			},function(){
				$(this).removeClass('closehover');
			}).click(function(){
				logindiv.hide();
			});
		}
		
		function postcomment(){
			if(!G.user.nickname){
				show_login();
				return;
			}
			content=ue.getContent();
			if( $.trim(content)=='' ){
				if(this.tips){
					clearTimeout(this.timeout);
					this.tips.show('fast');
				}else{
					this.tips=$('<span/>').css({"color":"red"}).html('内容不能为空！').insertAfter($(this)).hide().show('fast');
				}
				var tips = this.tips;
				this.timeout=setTimeout(function(){
					tips.hide('fast');
				}, 1000);
				return;
			}
			var self=this;
			$.ajax({
				type:'POST',
				url:'<?php echo WEB_APP_PATH;?>archives/comment',
				dataType:'json',
				data:{'content':content,'aid':<?php echo $id?>},
				success:function(m){
					if(m.status){
						showInfo('评价成功！');
						ue.execCommand('cleardoc');
					}else{
						showInfo(m.msg);
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown) {
					if(XMLHttpRequest.status==401){
						show_login();
					}else{
						showInfo('评价失败！');
					}
				}
			});
		};
		$("table a.linkbtn").click(postcomment).show();
		ue.addListener("focus", function(){
			if(!G.user.nickname){
				show_login();
			}
		});

		def2.promise();
	});
	deferred.promise();
	def2.promise();
});
</script>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/foot.php';
?>
