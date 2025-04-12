<?php

// load config file
require_once ('config/config.php');

// load helepr file
foreach (glob(__DIR__ . '/helper/*.php') as $LibFile) {
    require_once($LibFile);
}

// load liberary file
function MVC_AutoLoad ($file){
    require_once('lib/' . $file . '.php');
}
spl_autoload_register('MVC_Autoload');