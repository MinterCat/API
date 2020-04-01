<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include($_SERVER['DOCUMENT_ROOT'] . '/function.php');

$db_cats = new Cats();
$result = $db_cats->query('SELECT * FROM "table"');
$data = array();
while ($res = $result->fetchArray(1)){array_push($data, $res);}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);