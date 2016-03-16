<?php
$GLOBALS['is_debug'] = TRUE;
if ($GLOBALS['is_debug']) {
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', '1');
}

//メソッド
$GLOBALS['method'] = $_SERVER['REQUEST_METHOD'];

//ヘッダ
header('Content-type: text/plain; charset=UTF-8');

//リクエストパラメータの分割
$params   = explode('/', key($_REQUEST));
$function = $params[0];

//リクエストパラメータデバッグ
if ($GLOBALS['is_debug'])
{
	print "method={$GLOBALS['method']}\n";
	print "########\n";
	print "#params#\n";
	print "########\n";
	print_r($params);
	print "\n";
	print "##########\n";
	print "#function#\n";
	print "##########\n";
	print $function;
	print "\n\n";
}

//データベース設定
require_once('./libraries/db.php');
$db = new DB();
$GLOBALS['db'] = $db;

//API切り替え
require_once('./models/' . $function . '.php');
$ret = $function($params);

//JSONにして出力
echo json_encode($ret, JSON_UNESCAPED_UNICODE);

