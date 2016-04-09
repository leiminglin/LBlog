<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/meta.php';
$mCat = new ModelCat();
$cats = $mCat->getCats();
?>
<title>页面未找到 - <?php ehtml(SITE_NAME);?></title>
<style>
.center{
	text-align:center;
}
.warn{
	color:red;
}
</style>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/header.php';
?>

<div class="content">
<div class="left">
<div class="lbox litem">
<p class="center warn">
Sorry, This page was not found!<br/>
Please check the website url.
</p>
</div>
<div class="lbox page"></div>
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
?>
<script type="text/javascript">
window.onload=function(){deferred.promise()}
</script>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/@common/foot.php';
?>