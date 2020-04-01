<?php
declare(strict_types=1);
require_once('../../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterTx;

include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');
include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'public_html/function.php');

$api = new MinterAPI($api3);

$estimateCoinSell = $api->estimateCoinSell('BIP', '1000000000000000000', 'MINTERCAT', null);
$estimateSell = $estimateCoinSell->result->will_get/10 ** 18;

$estimateCoinBuy = $api->estimateCoinSell('MINTERCAT', '1000000000000000000', 'BIP', null);
$estimateBuy = $estimateCoinBuy->result->will_get/10 ** 18;

$getCoinInfo = $api->getCoinInfo('MINTERCAT')->result;

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

$array = array("estimateCoinSell" => $estimateSell, "estimateCoinBuy" => $estimateBuy, "symbol" => $getCoinInfo);
echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);