<?php 
$mArchives = new ModelArchives();
$recent_articles = $mArchives->getRecentArticles();

$mComment = new ModelComment();
$recent_comments = $mComment->getRecentComments();

$mStatistic = new ModelStatistic();
$todayTop = $mStatistic->articleTodayRank();

$mArticleStatistic = new ModelArchivesStatistic();
$allTop = $mArticleStatistic->getArticleReadRank();

?>
<div class="ritem">


<?php if($recent_articles){?>
<h3 class="widget-title">近期文章</h3>
<ul>
<?php foreach ($recent_articles as $t){?>
<li><a href="<?php echo Tool::getArticleUrl($t['id'], $t['url']);?>"><?php echo $t['title']?></a></li>
<?php }?>
</ul>
<?php }?>


<?php if($recent_comments){?>
<style>
.content .right .ritem .recent_comments li{
	height:auto;
}
</style>
<h3 class="widget-title">近期评论</h3>
<ul class="recent_comments">
<?php foreach ($recent_comments as $t){?>
<li><a><?php echo $t['nickname'];?></a>
《<a href="<?php echo Tool::getArticleUrl($t['aid'], $t['url']);?>#viewcomment_<?php echo $t['id']?>" target="_blank"><?php echo $t['title']?></a>》:
<?php echo mb_substr(preg_replace('/<[^>]+>/i', '', $t['content']), 0, 20, 'utf-8');?>
</li>
<?php }?>
</ul>
<?php }?>


<?php if($todayTop){?>
<h3 class="widget-title">今日排行</h3>
<ul>
<?php 
$i=0; 
foreach ($todayTop as $k=>$t){
	preg_match('/^\/archives\/([\d]+)/i', $k, $matches);
	if( isset($matches[1]) && $matches[1] ){
		$id = $matches[1];
		$article = $mArchives->getArticleTitleById($id);
?>
<li><a href="<?php echo Tool::getArticleUrl($id, $article['url']);?>"><?php echo $article['title']?></a></li>
<?php 
if( $i > 8 ){
	break;
}
$i++;
}}?>
</ul>
<?php }?>


<?php if($allTop){?>
<h3 class="widget-title">阅读排行</h3>
<ul>
<?php foreach ($allTop as $t){
	$t['article'] = $mArchives->getArticleTitleById($t['aid']);
?>
<li><a href="<?php echo Tool::getArticleUrl($t['article']['id'], $t['article']['url']);?>"><?php echo $t['article']['title']?></a></li>
<?php }?>
</ul>
<?php }?>



</div>