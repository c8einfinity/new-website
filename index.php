<?php
require_once "./vendor/autoload.php";
\Tina4\Initialize();

$config = new \Tina4\Config(static function (\Tina4\Config $config){
  //Your own config initializations
});

global $DBA;

$DBA = new \Tina4\DataSQLite3("test.db","", "", "d/m/Y");

echo new \Tina4\Tina4Php($config);