<?php

// require './App/conf/init.php';
// require './App/lml.min.php';
require './App/lml.php';

lml()->app()
->attachEvent(array('onRun'=>array('Statistic', 'start')))
->addDomain($domain)
->addLastRouter($lastRouter)
->run(true);

