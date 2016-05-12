<?php

require './App/conf/init.php';
require './App/lml.min.php';

lml()->app()
->attachEvent(array('onRun'=>array('Statistic', 'start')))
->addDomain($domain)
->addLastRouter($lastRouter)
->run(true);

