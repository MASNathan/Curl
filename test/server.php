<?php

require_once '../vendor/autoload.php';

$data = array(
	'method' => MASNathan\Curl\Curl::getMethod(),
	'data' => MASNathan\Curl\Curl::getData(),
);

echo json_encode($data);