<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'public_html/function.php');

$db_cats = new dbCats();

if (isset($_GET['addr']))
	{
		$key = $_GET['addr'];
		$result = $db_cats->query('SELECT * FROM "table" WHERE addr="' . $key . '"');
		$data = array();
		while ($res = $result->fetchArray(1)){array_push($data, $res);}
	}

if (isset($_GET['id']))
	{
		$key = $_GET['id'];
		$db = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $key)->fetchArray(1);
		$img = $db['img'];
		
			$api = file_get_contents('https://api.mintercat.com');
			$json = json_decode($api,true)['cats'];
			foreach ($json as $value => $cats) {
				$cat = $cats['img'];
				if ($cat == $img) {$cat = $cats;break;}
			}
			$data = array_merge($db, $cat);
	}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);