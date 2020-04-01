<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');

$trees = $_GET['trees'];
$commits = $_GET['commits'];

$ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://api.github.com/repos/MinterCat/MinterCat.com/branches/$version",
        CURLOPT_HTTPHEADER => [
            "Accept: application/vnd.github.v3+json",
            "Content-Type: text/plain",
            "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true
    ]);
$response = curl_exec($ch);
curl_close($ch);
print($response);