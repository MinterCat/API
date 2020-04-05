<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

if (isset($_GET['lang']))
	{
		$url = 'https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_'. $_GET['lang'] .'.json';
		$data = file_get_contents($url);
	}
echo json_encode(json_decode($data), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);