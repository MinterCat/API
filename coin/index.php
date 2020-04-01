<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/function.php');

$json_api = JSON($coin_api);
$estimate = $json_api->result->will_get/10 ** 18;

$json_api = JSON('https://api.mscan.dev/'.$mscan.'/node/coin_info?symbol=MINTERCAT');
$symbol = $json_api->result;

$array = array("estimate" => $estimate, "symbol" => $symbol);
echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);