<?php

header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: text/html; charset=utf-8;');
mb_http_input('UTF-8');
mb_http_output('UTF-8');
mb_internal_encoding("UTF-8");
date_default_timezone_set('UTC');
$start = microtime(true);
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
require_once 'core/config.php';
require_once 'core/init.php';


$time = microtime(true) - $start;
//printf('Скрипт выполнялся %.4F сек.', $time);