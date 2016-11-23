<?php require THEME_PATH.C_GROUP.'/@common/header.php';?>

<div class="he">
<h1><a class="fl" href="/">琳琳衣橱</a></h1>
<?php 
//<a class="fr zc" href="/user/register">注册</a>
//<a class="fr" href="/user/login">登录</a>
?>
<div class="clear"></div>
</div>

<div class="wrap">
	<div class="top">
		<ul>
			<li><h2><a href="/"><span class="tbg1">品牌</span></a></h2></li>
			<li><h2><a href="/"><span class="tbg2">内衣</span></a></h2></li>
		</ul>
		<div class="clear"></div>
		<ul>
			<li><h2><a href="/"><span class="tbg3">文胸</span></a></h2></li>
			<li><h2><a href="/"><span class="tbg4">裤袜</span></a></h2></li>
		</ul>
		<div class="clear"></div>
	</div>


<style>



.content{
	padding-top:5px;
	margin:auto;
}
.content li{
	width:100%;
	float:left;
	margin-bottom:12px;
}
@media screen and (min-width:320px){
	.content li{
		width:50%;
	}
}

@media screen and (min-width:480px){
	.content li{
		width:33.3%;
	}
}
@media screen and (min-width:640px){
	.content li{
		width:25%;
	}
}
@media screen and (min-width:960px){
	.content{
		width:960px;
	}
}
.content li div.item{
	height:220px;
	width:160px;
	overflow:hidden;
	position:relative;
	margin:auto;
}
.content li div img{
	display:block;
	margin:auto;
}
.content .item h3{
	font-weight:normal;
	font-size:14px;
	margin:0;
}
.content .item .title{
	position:absolute;
	bottom:20px;
	color:#333;
	padding:0 4px;
}
.content .item .price{
	position:absolute;
	bottom:0;
	left:0;
	right:0;
	text-align:center;
	color:#DD2727;
	font-weight:bold;
}
.content .item .price span{
	font-size:12px;
}
</style>
	
	
	<div class="content">
		<ul>
			<li>
				<div class="item">
					<div class="img">
						<?php echo template_interpreter('<LBLOGimage id="1" maxwidth="150" maxheight="150">');?>
					</div>
					<div class="title">
						<h3>波司登超长修身加厚羽绒服</h3>
					</div>
					<div class="price">
						￥538
						<span>.00</span>
					</div>
				</div>
			</li>
			<li>
				<div class="item">
					<div class="img">
						<?php echo template_interpreter('<LBLOGimage id="2" maxwidth="150" maxheight="150">');?>
					</div>
					<div class="title">
						波司登超长修身加厚羽绒服
					</div>
					<div class="price">
						￥538
						<span>.00</span>
					</div>
				</div>
			</li>
			<li>
				<div class="item">
					<div class="img">
						<?php echo template_interpreter('<LBLOGimage id="3" maxwidth="150" maxheight="150">');?>
					</div>
					<div class="title">
						波司登超长修身加厚羽绒服
					</div>
					<div class="price">
						￥538
						<span>.00</span>
					</div>
				</div>
			</li>
			<li>
				<div class="item">
					<div class="img">
					<?php echo template_interpreter('<LBLOGimage id="4" maxwidth="150" maxheight="150">');?>
					</div>
					<div class="title">
						波司登超长修身加厚羽绒服
					</div>
					<div class="price">
						￥538
						<span>.00</span>
					</div>
				</div>
			</li>
			<li>
				<div class="item">
					<div class="img">
						<?php echo template_interpreter('<LBLOGimage id="5" maxwidth="150" maxheight="150">');?>
					</div>
					<div class="title">
						波司登超长修身加厚羽绒服
					</div>
					<div class="price">
						￥538
						<span>.00</span>
					</div>
				</div>
			</li>
		</ul>
		<div class="clear"></div>
	</div>


</div>

<?php require THEME_PATH.C_GROUP.'/@common/foot.php';?>
