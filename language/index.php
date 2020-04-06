<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'public_html/function.php');

if (isset($_GET['lang']))
	{
		$url = 'https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_'. $_GET['lang'] .'.json';
		$data = file_get_contents($url);
		echo json_encode(json_decode($data), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
else
	{
		$Total = count(Users());
		$summ=0;
		$db_users = new Users();
		$arr = array('Russian', 'Ukrainian', 'Bulgarian', 'Chinese', 'English', 'French', 'Hebrew', 'Igbo', 'Indonesian', 'Spanish', 'Yoruba');
		$countarr = count($arr)-1;
		$data = array();
		for ($i = 0; $i <= $countarr; $i++)
		{
			$Lng = $arr[$i];
			$db = $db_users->query('SELECT COUNT(*) FROM "table" WHERE language="'.$Lng.'"')->fetchArray(1);
			$Language = $db['COUNT(*)'];
			$push = array($Lng => $Language);
			$summ += $Language;
			
			$data = array_merge($data, $push);
		}
		$Uncertain = $Total - $summ;
		$push = array('Uncertain' => $Uncertain);
		$data = array_merge($data, $push);
		echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

	}