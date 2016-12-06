<?php require THEME_PATH.C_GROUP.'/@common/header.php';?>

<div class="he">
<h1><a class="fl" href="/"><?php ehtml(s('config','SITE_NAME'));?></a></h1>
<div class="clear"></div>
</div>




<div class="wrap">
	<div class="notice">
	<?php ehtml(s('config', 'SITE_NOTICE'));?>
	</div>
	
	<div class="content">
		
		<div class="ditem">
			<div class="img">
				<?php $temp=explode(',', $item['images']); echo template_interpreter('<LBLOGimage id="'.arr_get($temp, 0).'">', $item['title']);?>
			</div>
			<div class="title">
				<h3><?php ehtml($item['title']);?></h3>
			</div>
			<div class="price">
				<?php if(!in_array($item['origin_price'], array('0','0.00'))){echo '<del><i>￥'.substr($item['origin_price'],0,-3).'<span>'.substr($item['origin_price'],-3).'</span></i></del> ';}?>
				￥<?php echo substr($item['price'],0,-3);?>
				<span><?php echo substr($item['price'],-3);?></span>
			</div>
			
			<?php echo $item['content'];?>
			
			<div class="album">
			<?php 
				foreach (explode(',', substr($item['images'], 2)) as $k=>$v) {
					echo template_interpreter('<LBLOGimage id="'.$v.'">', $item['title']);
				}
			?>
			</div>
		</div>
	
	</div>

</div>


<?php require THEME_PATH.C_GROUP.'/@common/foot.php';?>