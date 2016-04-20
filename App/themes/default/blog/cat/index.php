<?php
$keywords=$description=$cat_title = $cats[$catid-1]['name'];
include DEFAULT_THEME_PATH.C_GROUP.'/@common/meta.php';
$title_page_str = '';
if(isset($_GET['pid'])){
	$title_page_str = '_Page '.$_GET['pid'];
}
?>
<title><?php ehtml($cat_title)?> - <?php ehtml(SITE_NAME)?><?php echo $title_page_str?></title>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/header.php';
?>

<div class="content">
<div class="contop"></div>
<div class="left">
<style>
.thumbImg{
	border-collapse:collapse;
	border-spacing:0;
	width:420px;
	text-align:center;
}
.thumbImg td{
	padding:5px;
	width:200px;
	max-width:200px;
}
.imgWrap{
	max-width:200px;
	width:200px;
}
.imgWrap img{
	max-height:200px;
	max-width:200px;
}
</style>
<?php foreach ($articles as $k=>$v){?>
<div class="lbox litem">
<h2>
<a href="<?php echo Tool::getArticleUrl($v['id'], $v['url']);?>"><?php ehtml($v['title'])?></a>
<?php foreach ($cats as $t){
if($t['id'] == $v['catid']){?>
<a href="<?php echo WEB_APP_PATH?>cat/<?php echo $t['id']?>">
<span class="tag">
<span class="arrow"></span>
<?php ehtml($t['name'])?>
<?php break;}}?>
</span></a>
</h2>
<div class="author"><span><a><?php ehtml($v['nickname'])?></a> 发表于<a><?php echo date("Y-m-d H:i", $v['createtime'])?></a></span></div>
<div class="essay">
<div class="intro">
<?php echo Tool::getOriginLinks(Tool::getArticleUrl($v['id'], $v['url']))?>
</div>
<?php
$cut_content = CutHtml::doCut($v['content'], 300);
$matches = $thumbImg = '';
preg_match_all('/<img.*?\/?>/i', $v['content'], $matches);
if( isset($matches[0]) && count($matches[0]) > 0 ){
	$max_length = 200;
	$thumbImg = '<table class="thumbImg"><tr>';
	$c = 0;
	foreach( $matches[0] as $t ){
		if($c>1){
			break;
		}
		preg_match('/\sheight\s*=\s*.(\d+)./', $t, $matches_height);
		preg_match('/\swidth\s*=\s*.(\d+)./', $t, $matches_width);
		$height = isset($matches_height[1]) ? $matches_height[1] : $max_length;
		$width = isset($matches_width[1]) ? $matches_width[1] : $max_length;
		if ($height > $max_length || $width > $max_length) {
			$rate = min(array($max_length/$height, $max_length/$width));
			$thumb_width = round($rate * $width);
			$thumb_height = round($rate * $height);
			$t = preg_replace('/width\s*=\s*[\'"](\d+)[\'"]/', 'width="'.$thumb_width.'"', $t);
			$t = preg_replace('/height\s*=\s*[\'"](\d+)[\'"]/', 'height="'.$thumb_height.'"', $t);
		}
		$thumbImg .= '<td><div class="imgWrap">'.$t.'</div></td>';
		$c++;
	}
	$thumbImg .= '</tr></table><div class="clear"></div>';
}

echo preg_replace('/<img([\s\S]+?)src\s*=([\s\S]+?)>/i', "<img$1osrc=$2>", $cut_content.$thumbImg);
?>
</div>
<div class="essaybottom">
<a href="<?php echo Tool::getArticleUrl($v['id'], $v['url']);?>#title" target="_blank">阅(<?php echo $v['viewtimes']?$v['viewtimes']:0;?>)</a>
<a href="<?php echo Tool::getArticleUrl($v['id'], $v['url']);?>#comment" target="_blank">评(<?php echo $v['commenttimes']?$v['commenttimes']:0?>)</a>
<a href="<?php echo Tool::getArticleUrl($v['id'], $v['url']);?>#viewcomment" target="_blank">查看评论</a>
</div>
</div>
<?php }?>
<div class="lbox page">
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/page.php';
?>
</div>
</div>
<div class="right">
<!-- right -->
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/rightwidget.php';
?>
</div>
<div class="clear"></div>
</div>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/bottom.php';

include DEFAULT_THEME_PATH.C_GROUP.'/@common/foot.php';
?>