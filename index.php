<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

use Simpletable\Source as APP;

require_once 'app\init.php';
//Initialtes the table by loading the 
$app = new APP\Bootstrap();
