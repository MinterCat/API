<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'public_html/function.php');

$db_users = new Users();

$point = 0;
$array = array();

$result = $db_users->query('SELECT * FROM "table"');
while ($res = $result->fetchArray(1))
{
	$address = $res->address;
	
	foreach (Cats::Address($address) as $value) {
				$stored_id = Cats::Address($address)->$value->stored_id;
				$point += Gen::StoredId($stored_id)->point;
			}
			
	$points[] = array('point' => $point);
	$data = array_merge($res, $points[0]);
	array_push($array, $data);
}

echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);