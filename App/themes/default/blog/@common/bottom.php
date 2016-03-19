<?php 
/**
 * 保留底部版权，可以免费获得官方技术支持。
 */
?>
<div class="foot">
	<div class="foottop">
	<span>LBlog</span>，轻量级开源博客<span>CMS</span>系统<span>！</span>
	</div>
	<div class="footlink">
	Powered By <span><a style="width:56px;" href="http://www.lmlphp.com">LMLPHP</a></span>
	&nbsp;<a style="width:56px;" href="http://lmljs.lmlphp.com">LMLJS</a>
	<a style="position:relative;" onmouseover="document.getElementById('wechatgraph').style.display='block';" onmouseout="document.getElementById('wechatgraph').style.display='none';">官方微信
	<div id="wechatgraph" class="wechatgraph"><img width="200" height="200" alt="LMLPHP订阅号" title="LMLPHP订阅号" osrc="<?php echo WEB_PATH?>static/resource/qrcode.jpg"/></div>
	</a><a href="http://www.lmlphp.com/contact">联系我们</a>
	</div>
	<div id="footdate"><?php echo date("Y-m-d H:i:s"),'&nbsp;',time();?></div>
</div>
</div><?php /*wrap end*/?>
<script>
deferred.then(function(){document.getElementById('footdate').style.display='none';deferred.promise()});
deferred.then(function(){
	document.getElementsByClassName('header')[0].style.background='#F1F2F6 url(https://raw.githubusercontent.com/leiminglin/images/master/2014/12/wallpapers/'+new Date().getDate()+'.jpg) center 0px repeat-x scroll';
	deferred.promise()
});
</script>