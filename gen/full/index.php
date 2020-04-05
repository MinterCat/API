<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'public_html/function.php');

$db_cats = new dbCats();
$result = $db_cats->query('
SELECT "table".*, "gen".*
FROM "table" INNER JOIN "gen"
ON "table".stored_id = "gen".stored_id;');
$data = array();
while ($res = $result->fetchArray(1)){array_push($data, $res);}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);