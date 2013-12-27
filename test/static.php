<?php

use MASNathan\Curl\Ch;

require_once '../vendor/autoload.php';

$url  = 'http://repos.local/easypay/Request/test/server.php';
$data = array('param1' => 'val1', 'param2' => 'val2');

echo '////////////////////////////////////' . PHP_EOL;
echo '///              GET             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

var_dump(Ch::get($url, $data, 'json'));
/*
echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///             POST             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

print_r(Ch::post($url, $data, 'json'));

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///            DELETE            ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

print_r(Ch::delete($url, $data, 'json'));

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///              PUT             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

print_r(Ch::put($url, $data, 'json'));

echo PHP_EOL;

/*
echo '////////////////////////////////////' . PHP_EOL;
echo '///           POST JSON          ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

$params = array('longUrl' => $url);
var_dump(Ch::postJson('https://www.googleapis.com/urlshortener/v1/url', array(json_encode($params)), 'json'));

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///           POST XML           ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

var_dump(Ch::postXml($url, '<xml></xml>'));

echo PHP_EOL;
*/
