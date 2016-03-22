<?php
$mConfig = new ModelConfig();
define('SITE_NAME', htmlspecialchars($mConfig->getConfig('SITE_NAME')));

define('LBLOGUSS', 'LBLOGUSS');
define('LBLOGSALT', 'salt_need_install_to_generate');
