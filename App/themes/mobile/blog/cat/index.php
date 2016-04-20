<?php
$keywords=$description=$cat_title = $cats[$catid-1]['name'];
include DEFAULT_THEME_PATH.C_GROUP.'/@common/meta.php';
$title_page_str = '';
if(isset($_GET['pid'])){
	$title_page_str = '_Page '.$_GET['pid'];
}
?>
<title><?php echo $cat_title?> - <?php echo SITE_NAME?><?php echo $title_page_str?></title>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/header.php';
?>

<div class="content">
<div class="contop"></div>
<div class="left">

<?php foreach ($articles as $k=>$v){?>
<div class="lbox litem">
<h2>
<a href="<?php echo Tool::getArticleUrl($v['id'], $v['url']);?>"><?php echo Tool::htmlspecialcharsDeep($v['title'])?></a>
<?php foreach ($cats as $t){
if($t['id'] == $v['catid']){?>
<a href="<?php echo WEB_APP_PATH?>cat/<?php echo $t['id']?>">
<span class="tag">
<span class="arrow"></span>
<?php echo$t['name']?>
<?php break;}}?>
</span></a>
</h2>
<div class="author"><span><a><?php echo $v['nickname']?></a> 发表于<a><?php echo date("Y-m-d H:i", $v['createtime'])?></a></span></div>
<div class="essay">
<div class="intro">
<?php echo Tool::getOriginLinks(Tool::getArticleUrl($v['id'], $v['url']))?>
</div>
<?php
$cut_content = CutHtml::doCut($v['content'], 300);

preg_match_all('/<img.*?\/?>/i', $v['content'], $matches);
if( isset($matches[0]) ){
	$thumbImg = '';
	$c = 0;
	foreach( $matches[0] as $t ){
		if($c>0){
			break;
		}
		$thumbImg .= '<div class="thumbImg">'.$t.'</div>';
		$c++;
	}
	$thumbImg .= '<div class="clear"></div>';
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