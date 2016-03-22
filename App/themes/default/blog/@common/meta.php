<?php 
$mConfig = new ModelConfig();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta content="<?php if(isset($keywords)){echo $keywords,',';};echo htmlspecialchars($mConfig->getConfig('SITE_KEYWORDS'))?>" name="keywords"/>
<meta content="<?php if(isset($description)){echo $description,'.';};echo htmlspecialchars($mConfig->getConfig('SITE_DESCRIPTION'))?>" name="description"/>
<meta http-equiv="Cache-Control" content="no-transform"/>
<meta http-equiv="Cache-Control" content="no-siteapp"/>