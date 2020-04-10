<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8'); 

$part = 4; //сколько всего партий способных выпадать при покупке

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'public_html/function.php');

$db_api = new db_api();
$db_cats = new dbCats();

$sl = 3; //не менять!!!
for ($i = 3; $i <= $part; $i++)
{
	$sl = $sl + ($i*2); //Считает количество слотов
}

$img0 = $_GET['img'];
if ($img0 == '')
	{
		$img0 = $_POST['img'];
	}
	
if ($img0 == '')
	{
		$result = $db_api->query('SELECT * FROM "table" ORDER BY series ASC');
	}
else
	{
		$result = $db_api->query('SELECT * FROM "table" WHERE img=' . $img0);
	}
$payloadapi = array();
while ($res = $result->fetchArray(1)){array_push($payloadapi, $res);}
$countapi = (count($payloadapi) - 1);
	
$prise = 50; //MINTERCAT PRICE

$data = $db_cats->query('SELECT COUNT(*) FROM "table"')->fetchArray(1);	
$count = $data['COUNT(*)'];

for ($i = 0; $i <= $countapi; $i++)
{
	$img = $payloadapi[$i]['img'];
	$data = $db_cats->query('SELECT COUNT(*) FROM "table" WHERE img = "' . $img . '"')->fetchArray(1);
	$q2 = $data['COUNT(*)'];
	
		//=====================================
		$series = $payloadapi[$i]['series']; //Серия
		$q3 = $payloadapi[$i]['q3']; //Шанс выпадения Проценты
		$rnd = $payloadapi[$i]['rnd']; //Количество однотипных котов (разного цвета)
		$name = $payloadapi[$i]['name']; //Имя
		$gender = $payloadapi[$i]['gender']; //1-мальчик, 0 - девочка
		//=====================================
		$q1 = $series/$sl; //шанс выпадения кота в определенной серии
		switch ($gender) {
			case 0: {
				$gender = '♀';
				$qq1 = $q1; if ($qq1 == 0) {$qq1 = 1;}
				switch ($img) {
					case 901: {$qq3 = $q3; if ($qq3 == 0) {$qq3 = 0.001;} break;}
					case 902: {$qq3 = $q3; if ($qq3 == 0) {$qq3 = 0.001;} break;}
					default: {$qq3 = $q3; if ($qq3 == 0) {$qq3 = 1;} break;}
				}
				$q5 = ($qq3 * (1/$rnd) * $qq1); //rarity - формула шанса выпадения;
				$q4 = round($q5,4); //rarity
				$qq4 = $q4; if ($qq4 == INF) {$qq4 = 0;}
				$qq2 = $q2; if ($qq2 == 0) {$qq2 = 1;}
				if (($img > 1000) AND ($img <= 1010))
				{
					$prrice = 0;
				}
				else
				{
					$prrice = round($prise + ($prise/($q5*$qq2)),2);
				}
				break;}
			case 1: {
				$gender = '♂';
				$qq1 = $q1; if ($qq1 == 0) {$qq1 = 1;}
				switch ($img) {
					case 901: {$qq3 = $q3; if ($qq3 == 0) {$qq3 = 0.001;} break;}
					case 902: {$qq3 = $q3; if ($qq3 == 0) {$qq3 = 0.001;} break;}
					default: {$qq3 = $q3; if ($qq3 == 0) {$qq3 = 1;} break;}
				}
				$q5 = ($qq3 * (1/$rnd) * $qq1); //rarity - формула шанса выпадения;
				$q4 = round($q5,4); //rarity
				$qq4 = $q4; if ($qq4 == INF) {$qq4 = 0;}
				$qq2 = $q2; if ($qq2 == 0) {$qq2 = 1;}
				if (($img > 1000) AND ($img <= 1010))
				{
					$prrice = 0;
				}
				else
				{
					$prrice = round($prise + ($prise/($q5*$qq2)),2);
				}
				break;}
			case 2: {
				$gender = '0';
				$qq4 = 0; //rarity
				$prrice = 0;
				$qq2 = 0;
				break;}
		}
		switch ($series)
		{
			case 0: {$color = '#C1B5FF'; break;}
			case 1: {$color = '#FFF6B5'; break;}
			case 2: {$color = '#FFB5B5'; break;}
			case 3: {$color = '#C7F66F'; break;}
			case 4: {$color = '#FFC873'; break;}
			case 5: {$color = '#6AF2D7'; break;}
			case 999: {$color = '#9BF5DA'; break;}
		}
		$array2 = array(
			"gender" => $gender,
			"name" => $name,
			"series" => $series,
			"rarity" => number_format($qq4,5, '.', ''),
			"img" => $img,
			"webp" => 'https://mintercat.com/static/img/Cat' . $img . '.webp',
			"png" => 'https://mintercat.com/png.php?png=' . $img,
			"count" => $qq2,
			"color" => $color,
			"value" => (int)$prrice
		);
		$array[] = $array2;
}
$arr = array(
			'count' => $count,
			'cats' => $array
);

echo json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);