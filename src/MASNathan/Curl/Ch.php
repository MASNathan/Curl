<?php

namespace MASNathan\Curl;

/**
 * Curl - Another Curl Object
 * 
 * @package MASNathan
 * @subpackage Curl
 * @author André Filipe <andre.r.flip@gmail.com>
 * @link https://github.com/ReiDuKuduro/Curl GitHub repo
 * @version 0.0.1
 */
class Ch
{
    /**
     * Calls a URL using the GET method
     * 
     * Ch::get( string $url [, array $params [, function $callback [, string $data_type]]]);
     * Here are a few examples:
     *                 - Ch::get('http://path_to_api.com');
     *                 - Ch::get('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'));
     *                 - Ch::get('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); });
     *                 - Ch::get('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); }, 'json');
     *                 - Ch::get('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), 'json');
     *                 - Ch::get('http://path_to_api.com', 'json');
     *                 - Ch::get('http://path_to_api.com', function(data) { var_dump($data); }, 'json');
     * Any of the above examples is aceptable
     * @return string|array|null
     */
    static public function get()
    {
        return self::call('GET', func_get_args());
    }

    /**
     * Calls a URL using the POST method
     * 
     * Ch::post( string $url [, array $params [, function $callback [, string $data_type]]]);
     * Here are a few examples:
     *                 - Ch::post('http://path_to_api.com');
     *                 - Ch::post('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'));
     *                 - Ch::post('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); });
     *                 - Ch::post('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); }, 'json');
     *                 - Ch::post('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), 'json');
     *                 - Ch::post('http://path_to_api.com', 'json');
     *                 - Ch::post('http://path_to_api.com', function(data) { var_dump($data); }, 'json');
     * Any of the above examples is aceptable
     * @return string|array|null
     */
    static public function post()
    {
        return self::call('POST', func_get_args());
    }

    /**
     * Uses POST method and send json data to the API 
     * 
     * Ch::postJson( string $url [, array $params [, function $callback [, string $data_type]]]);
     * Here are a few examples:
     *                 - Ch::postJson('http://path_to_api.com');
     *                 - Ch::postJson('http://path_to_api.com', array('{"param1": "some value", "param2": "some other value"}'));
     *                 - Ch::postJson('http://path_to_api.com', array('{"param1": "some value", "param2": "some other value"}'), function(data) { var_dump($data); });
     *                 - Ch::postJson('http://path_to_api.com', array('{"param1": "some value", "param2": "some other value"}'), function(data) { var_dump($data); }, 'json');
     *                 - Ch::postJson('http://path_to_api.com', array('{"param1": "some value", "param2": "some other value"}'), 'json');
     *                 - Ch::postJson('http://path_to_api.com', 'xml');
     *                 - Ch::postJson('http://path_to_api.com', function(data) { var_dump($data); }, 'json');
     * Any of the above examples is aceptable
     * @return string|array|null
     */
    static public function postJson()
    {
        return self::call('POST', func_get_args(), 'json');
    }

    /**
     * Uses POST method and send xml data to the API 
     * 
     * Ch::postXml( string $url [, array $params [, function $callback [, string $data_type]]]);
     * Here are a few examples:
     *                 - Ch::postXml('http://path_to_api.com');
     *                 - Ch::postXml('http://path_to_api.com', array('<?xml version="1.0" encoding="ISO-8859-1"?><data><param1>some value</param1><param2>some other value</param2></data>'));
     *                 - Ch::postXml('http://path_to_api.com', array('<?xml version="1.0" encoding="ISO-8859-1"?><data><param1>some value</param1><param2>some other value</param2></data>'), function(data) { var_dump($data); });
     *                 - Ch::postXml('http://path_to_api.com', array('<?xml version="1.0" encoding="ISO-8859-1"?><data><param1>some value</param1><param2>some other value</param2></data>'), function(data) { var_dump($data); }, 'json');
     *                 - Ch::postXml('http://path_to_api.com', array('<?xml version="1.0" encoding="ISO-8859-1"?><data><param1>some value</param1><param2>some other value</param2></data>'), 'json');
     *                 - Ch::postXml('http://path_to_api.com', 'json');
     *                 - Ch::postXml('http://path_to_api.com', function(data) { var_dump($data); }, 'json');
     * Any of the above examples is aceptable
     * @return string|array|null
     */
    static public function postXml()
    {
        return self::call('POST', func_get_args(), 'xml');
    }

    /**
     * Calls a URL using the PUT method
     * 
     * Ch::put( string $url [, array $params [, function $callback [, string $data_type]]]);
     * Here are a few examples:
     *                 - Ch::put('http://path_to_api.com');
     *                 - Ch::put('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'));
     *                 - Ch::put('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); });
     *                 - Ch::put('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); }, 'json');
     *                 - Ch::put('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), 'json');
     *                 - Ch::put('http://path_to_api.com', 'json');
     *                 - Ch::put('http://path_to_api.com', function(data) { var_dump($data); }, 'json');
     * Any of the above examples is aceptable
     * @return string|array|null
     */
    static public function put()
    {
        return self::call('PUT', func_get_args());
    }

    /**
     * Calls a URL using the DELETE method
     * 
     * Ch::delete( string $url [, array $params [, function $callback [, string $data_type]]]);
     * Here are a few examples:
     *                 - Ch::delete('http://path_to_api.com');
     *                 - Ch::delete('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'));
     *                 - Ch::delete('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); });
     *                 - Ch::delete('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); }, 'json');
     *                 - Ch::delete('http://path_to_api.com', array('param1' => 'some value', 'param2' => 'some other value'), 'json');
     *                 - Ch::delete('http://path_to_api.com', 'json');
     *                 - Ch::delete('http://path_to_api.com', function(data) { var_dump($data); }, 'json');
     * Any of the above examples is aceptable
     * @return string|array|null
     */
    static public function delete()
    {
        return self::call('DELETE', func_get_args());
    }

    /**
     * Requests a specified url using the specified method
     * @param string $methof
     * @param string $url
     * @param array $data
     * @param array $special_options Adicional CURL options
     * @return string
     */
    static private function curl($method, $url, $data, $special_options = null)
    {
        $curl = \curl_init();

        if ($method == 'GET') {
            $url .= '?' . \http_build_query($data);
        } elseif (!is_null($special_options)) {
        	\curl_setopt_array($curl, $special_options);
            \curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            \curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } else {
            \curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            \curl_setopt($curl, CURLOPT_POSTFIELDS, \http_build_query($data));
        }

        \curl_setopt($curl, CURLOPT_URL, $url);

        \curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        \curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        \curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        \curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $content = \curl_exec($curl);
        \curl_close($curl);

        return $content;
    }

    /**
     * Deals with the arguments "detection" and sets the rigth configs for the method you specify
     * @param string $method You can use the following: GET, POST, PUT, DELETE
     * @param array $args
     * @param string $content_type Should be json or xml, if not, just leave it empty
     * @return string|array
     */
    public static function call($method, $args, $content_type = null)
    {
        if (count($args) == 0) {
            throw new InvalidArgsException("You need specify at least the URL to call");
        }

        $method    = strtoupper($method);
        $url       = null;
        $params    = null;
        $callback  = null;
        $data_type = '';
        
        if (!is_string($args[0]) || !filter_var($args[0], FILTER_VALIDATE_URL)) {
            throw new InvalidArgsException("The URL you specified is not valid.");
        } else {
            $url = \array_shift($args);
        }

        //Is there any parameters to add?
        if (count($args) > 0 && is_array($args[0])) {
            $params = \array_shift($args);
        }
        
        //Is there any callback function to call?
        if (count($args) > 0 && is_callable($args[0])) {
            $callback = \array_shift($args);
        }
        
        //Is there any data type?
        if (count($args) > 0 && is_string($args[0])) {
            $data_type = \array_shift($args);
        }
        //END of arguments treatment

        if ($method == 'POST' && $content_type == 'json') {
            $data = self::curl($method, $url, \reset($params), array(
                CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
                CURLOPT_POSTFIELDS     => $params,
            ));

        } else if ($method == 'POST' && $content_type == 'xml') {
            $data = self::curl($method, $url, \reset($params), array(
                CURLOPT_HTTPHEADER     => array('Content-Type: text/xml'),
                CURLOPT_POSTFIELDS     => $params,
            ));

        } else {
        	$data = self::curl($method, $url, $params);
        }

        $data = StringParser::parse($data, $data_type);

        if (!is_null($callback)) {
            $data = $callback($data);
        }

        return $data;
    }
}
