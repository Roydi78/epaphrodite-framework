<?php

//var_dump(hash('gost','Epaphrodite'));die();

require 'bin/epaphrodite/define/define_directory.php';

require _DIR_VENDOR_ . '/autoload.php';
require _DIR_VENDOR_ . '/Autoloader.php';

$path_url = new \bin\controllers\render\geturlspath;
$path_url->runApp();

