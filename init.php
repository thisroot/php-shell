<?
define('ROOT', dirname(__FILE__)); 
require(ROOT . '/app.php');
APP::Init(require(ROOT . '/conf.php'), isset($argv) ? $argv : false);