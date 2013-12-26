<?php

namespace MASNathan\Curl;

/**
 * Another Curl Object
 *
 * I can do stuff
 * @author    André Filipe <andre@easypay.pt>
 * @version   1.0.0
 */
class Curl
{
    static public function getMethod() { return $_SERVER['REQUEST_METHOD']; }
    static public function getData() { switch (self::getMethod()) { case 'POST': return $_POST; case 'GET': return $_GET; case 'PUT': $tmp = array(); parse_str(file_get_contents("php://input"), $tmp); return $tmp; case 'DELETE': $tmp = array(); parse_str(file_get_contents("php://input"), $tmp); return $tmp; default: return array(); } }

    /**
     * Supported Content types, 'none' isn't actually a content type itself but you get the idea
     */
    const CONTENT_TYPE_NONE = 'none';
    const CONTENT_TYPE_JSON = 'json';
    const CONTENT_TYPE_XML  = 'xml';

    /**
     * Communication standards allowed
     */
     const METHOD_GET    = 'GET';
     const METHOD_POST   = 'POST';
     const METHOD_PUT    = 'PUT';
     const METHOD_DELETE = 'DELETE';

    /**
     * Requests a specified url using the method GET
     * @param string $url
     * @param array $data
     * @return string
     */
    static public function get($url, $data = array())
    {
        return self::curl('GET', $url, $data);
    }

    /**
     * Requests a specified url using the method POST
     * @param string $url
     * @param array $data
     * @return string
     */
    static public function post($url, $data = array())
    {
        return self::curl('POST', $url, $data);
    }

    /**
     * Requests a specified url using the method PUT
     * @param string $url
     * @param array $data
     * @return string
     */
    static public function put($url, $data = array())
    {
        return self::curl('PUT', $url, $data);
    }

    /**
     * Requests a specified url using the method DELETE
     * @param string $url
     * @param array $data
     * @return string
     */
    static public function delete($url, $data = array())
    {
        return self::curl('DELETE', $url, $data);
    }

    /**
     * Requests a specified url using the specified method
     * @param string $methof
     * @param string $url
     * @param array $data
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
     * @param array $args
     * @param string $method You can use the following constants APIcaller::METHOD_GET, APIcaller::METHOD_POST, APIcaller::METHOD_PUT and APIcaller::METHOD_DELETE 
     * @return string|array Depends on the data type you use
     */
    public static function call($method, $args, $content_type = null)
    {
        if (count($args) == 0) {
            throw new InvalidArgsException("You need specify at least the URL to call");
        }

        $url       = null;
        $params    = null;
        $callback  = null;
        $data_type = self::CONTENT_TYPE_NONE;
        
        if (!is_string($args[0]) || !filter_var($args[0], FILTER_VALIDATE_URL)) {
            throw new InvalidArgsException("The URL you specified is not valid.");
        } else {
            $url = array_shift($args);
        }

        //Is there any parameters to add?
        if (count($args) > 0 && is_array($args[0])) {
            $params = array_shift($args);
        }
        
        //Is there any callback function to call?
        if (count($args) > 0 && is_callable($args[0])) {
            $callback = array_shift($args);
        }
        
        //Is there any data type?
        if (count($args) > 0 && is_string($args[0])) {
            $data_type = array_shift($args);
        }
        //END of arguments treatment

        if ($method == self::METHOD_POST && $content_type == self::CONTENT_TYPE_JSON) {
            $data = self::curl($method, $url, $params, array(
                CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
                CURLOPT_POSTFIELDS     => $params,
            ));

        } else if ($method == self::METHOD_POST && $content_type == self::CONTENT_TYPE_XML) {
            $data = self::curl($method, $url, $params, array(
                CURLOPT_HTTPHEADER     => array('Content-Type: text/xml'),
                CURLOPT_POSTFIELDS     => $params,
            ));

        } else {
        	$data = self::curl($method, $url, $params);
        }

        $data = self::parseData($data, $data_type);

        if (!is_null($callback)) {
            $data = $callback($data);
        }

        return $data;
    }

    /**
     * Parses a json string into an array
     * @param string        $string
     * @return array
     */
    private static function parseJson($str)
    {
        $data = json_decode($str, true);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
            	return $data;
	        case JSON_ERROR_DEPTH:
	            return array('error' => 'Maximum stack depth exceeded');
	        case JSON_ERROR_STATE_MISMATCH:
	            return array('error' => 'Underflow or the modes mismatch');
	        case JSON_ERROR_CTRL_CHAR:
	            return array('error' => 'Unexpected control character found');
	        case JSON_ERROR_SYNTAX:
	            return array('error' => 'Syntax error, malformed JSON');
	        case JSON_ERROR_UTF8:
	            return array('error' => 'Malformed UTF-8 characters, possibly incorrectly encoded');
	        default:
	            return array('error' => 'Unknown error on JSON file');
        }
    }

    /**
     * Parses a xml string into an array
     * @param string        $string
     * @return array
     */
    private static function parseXml($str)
    {
        return self::parseJson(json_encode((array) simplexml_load_string($str), true));
    }

    /**
     * Parses the data passed into the requested data type
     * @param string        $string
     * @param string        $data_type You can use one of the following constants APIcaller::CONTENT_TYPE_JSON, APIcaller::CONTENT_TYPE_XML, APIcaller::CONTENT_TYPE_NONE
     * @return array
     */
    private static function parseData($str, $data_type)
    {
        switch ($data_type) {
            case self::CONTENT_TYPE_JSON:
                return self::parseJson($str);
            	break;
            
            case self::CONTENT_TYPE_XML:
                return self::parseXml($str);
            	break;

            default:
                return $str;
            	break;
        }
    }
}
