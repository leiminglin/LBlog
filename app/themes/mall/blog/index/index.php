<?php require THEME_PATH.C_GROUP.'/@common/header.php';?>

<div class="he">
<h1><a class="fl" href="/"><?php ehtml(s('config','SITE_NAME'));?></a></h1>
<?php 
//<a class="fr zc" href="/user/register">注册</a>
//<a class="fr" href="/user/login">登录</a>
?>
<div class="clear"></div>
</div>

<div class="wrap">
	<div class="notice">
	<?php ehtml(s('config', 'SITE_NOTICE'));?>
	</div>
	<div class="top">
		<?php 
			$cats = q('mall_cat')->select('*','status=1');
			foreach ($cats as $k=>$v){
				if($k==0){
					echo '<ul>';
				}
				echo '<li><h2><a href="/cat/'.$v['id'].'"><span class="tbg'.($k+1).'">'.$v['title'].'</span></a></h2></li>';
				if($k>0 && ($k+1)%3==0){
					echo '</ul><div class="clear"></div>';
				}elseif($k+1 == count($cats)){
					echo '<div class="clear"></div>';
				}
			}
		?>
		
		<?php 
		/**
		<ul>
			<li><h2><a href="/"><span class="tbg1">品牌</span></a></h2></li>
			<li><h2><a href="/"><span class="tbg3">内衣</span></a></h2></li>
			<li><h2><a href="/"><span class="tbg5">玩具</span></a></h2></li>
		</ul>
		<div class="clear"></div>
		<ul>
			<li><h2><a href="/"><span class="tbg2">文胸</span></a></h2></li>
			<li><h2><a href="/"><span class="tbg4">裤袜</span></a></h2></li>
			<li><h2><a href="/"><span class="tbg6">帽衫</span></a></h2></li>
		</ul>
		<div class="clear"></div>
		 */
		?>
	</div>


	<div class="content">
		<ul>
		<?php 
		
			if(!isset($items)){
				$items = q('mall_goods')->select('*', 'status=1');
			}
			
			foreach ($items as $k=>$v){
				
		?>
			<li>
				<a href="/item/<?php echo $v['id'];?>">
				<div class="item">
					<div class="img">
						<?php echo template_interpreter('<LBLOGimage id="'.substr($v['images'],0,1).'" maxwidth="150" maxheight="150">', $v['title']);?>
					</div>
					<div class="title">
						<h3><?php ehtml($v['title']);?></h3>
					</div>
					<div class="price">
						<?php if(!in_array($v['origin_price'], array('0','0.00'))){echo '<del><i>￥'.substr($v['origin_price'],0,-3).'<span>'.substr($v['origin_price'],-3).'</span></i></del> ';}?>
						￥<?php echo substr($v['price'],0,-3);?>
						<span><?php echo substr($v['price'],-3);?></span>
					</div>
				</div>
				</a>
			</li>
		<?php }?>
		</ul>
		<div class="clear"></div>
		<?php require THEME_PATH.C_GROUP.'/@common/page.php';?>
	</div>


</div>

<?php require THEME_PATH.C_GROUP.'/@common/foot.php';?>
