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
	<div id="wechatgraph" class="wechatgraph"><img width="100" height="100" alt="LMLPHP订阅号" title="LMLPHP订阅号" osrc="<?php echo WEB_PATH?>static/resource/qrcode.jpg"/></div>
	</a> <a href="http://www.lmlphp.com/contact">联系我们</a>
	</div>
	<div id="footdate"><?php echo date("Y-m-d H:i:s"),'&nbsp;',$GLOBALS['start_time'];?></div>
</div>
</div><?php /*wrap end*/?>
<script>
deferred.then(function(){document.getElementById('footdate').style.display='none';deferred.promise()});
</script>