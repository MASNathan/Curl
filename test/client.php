<?php

use MASNathan\Curl\Curl;

require_once '../vendor/autoload.php';

$url  = 'http://repos.local/easypay/Request/test/server.php';
$data = array('param1' => 'val1', 'param2' => 'val2');

echo '////////////////////////////////////' . PHP_EOL;
echo '///              GET             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

var_dump(Curl::get($url, $data));

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///             POST             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

var_dump(Curl::post($url, $data));

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///            DELETE            ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

var_dump(Curl::delete($url, $data));

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///              PUT             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

var_dump(Curl::put($url, $data));

echo PHP_EOL;
