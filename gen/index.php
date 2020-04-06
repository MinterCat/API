<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'public_html/function.php');

if (isset($_GET['id']))
	{
		$key = $_GET['id'];
		$db_gen = new dbGen();
		$db = $db_gen->query('SELECT * FROM "table" WHERE stored_id=' . $key)->fetchArray(1);
		$StoredId =  json_decode(json_encode(Cats::StoredId($key)),true);
		$data = array_merge($StoredId, $db);
	}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);