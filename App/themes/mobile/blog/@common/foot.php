<script type="text/javascript">
function toQzoneLogin(){window.location.href="<?php echo WEB_APP_PATH.'user/qqlogin?backurl=';?>"+encodeURIComponent(window.location.href)}
function toWeiboLogin(){window.location.href="<?php echo WEB_APP_PATH.'user/weibologin?backurl=';?>"+encodeURIComponent(window.location.href)}


function getShareText(){
	var e=document.getElementsByTagName('meta'),i,j;
	for(i=0,j=e.length;i<j;i++){
		if(e[i].getAttribute('name')&&e[i].getAttribute('name').match(/description/i)){
			return e[i].getAttribute('content')
		}
	}
}
function getShareImg(){
	var d=document.getElementsByTagName('DIV'),l=d.length,img;
	for(var i=0;i<l;i++){
		if(d[i].getAttribute('class')&&d[i].getAttribute('class').match(/content/)){
			img = d[i].getElementsByTagName('IMG');
			if(img.length>0){
				return img[0].src;
			}else{
				return document.getElementsByClassName('foot')[0].getElementsByTagName('img')[0].src;
			}
			break;
		}
	}
}

<?php 
echo s('config', 'JAVASCRIPT_CODE');
?>
</script>


<script type="text/javascript">deferred.then(function(){var def2 = lml.createDeferred();def2.then(function(){lml.loadJs('https://rawgit.com/leiminglin/LMLJS/master/lib/highlight.js', function(){def2.promise();});});deferred.promise();def2.promise();});</script>
</body>
</html>