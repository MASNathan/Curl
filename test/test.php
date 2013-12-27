<?php

use MASNathan\Curl\Curl;

require_once '../vendor/autoload.php';

$url  = 'http://repos.local/easypay/Request/test/server.php';
$data = array('param1' => 'val1', 'param2' => 'val2');

$curl = new Curl();

//Login
$curl->init();

$login   = $curl->login('https://www.wemineltc.com/login', array('username' => 'bolovsky', 'password' => '68742324'), 'cookie.txt');
$workers = $curl->get('https://www.wemineltc.com/accountworkers');

echo $login == $workers ? 'São Iguais' : 'São diferentes';
echo PHP_EOL;

$dom = new \domDocument;
@$dom->loadHTML($workers);
$dom->preserveWhiteSpace = false;

$tables = $dom->getElementsByTagName('table');

$rows = $tables->item(1)->getElementsByTagName('tr');

$list = array();
foreach ($rows as $row) {
	$list_row = array();
    $cols = $row->getElementsByTagName('td');
    foreach ($cols as $col) {
    	$child = $col->firstChild;
    	
    	//Getting the input values
    	if (isset($child->tagName) && $child->tagName == 'input') {
    		foreach ($child->attributes as $attribute) {
    			if ($attribute->name == 'value') {
    				$list_row[] = $attribute->value;
    			}
    		}
    	} else {
    		$list_row[] = $col->nodeValue;
    	}
    }

    array_pop($list_row);
    array_pop($list_row);
    array_pop($list_row);
    array_pop($list_row);
    array_pop($list_row);
    $list[] = $list_row;
    //exit;
        //echo $cols[2];
}

unset($list[0][3]);
var_dump($list);

//echo $workers;
echo PHP_EOL;

$curl->close();



/*
echo '////////////////////////////////////' . PHP_EOL;
echo '///              GET             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

echo $curl->get($url, $data);

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///             POST             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

echo $curl->post($url, $data);

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///            DELETE            ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

echo $curl->delete($url, $data);

echo PHP_EOL;

echo '////////////////////////////////////' . PHP_EOL;
echo '///              PUT             ///' . PHP_EOL;
echo '////////////////////////////////////' . PHP_EOL;

echo $curl->put($url, $data);

echo PHP_EOL;
*/
