<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'public_html/function.php');

$db_cats = new dbCats();

$data = $db_cats->query('SELECT COUNT(*) FROM "table" WHERE sale="1"')->fetchArray(1);
$count = $data['COUNT(*)'];
$arr = array('count' => $count);
		
echo json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);