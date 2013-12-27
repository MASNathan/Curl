<?php

namespace MASNathan\Curl;

/**
 * String parser - It parses either a json or a xml string into an array
 * 
 * @package MASNathan
 * @subpackage Curl
 * @author André Filipe <andre.r.flip@gmail.com>
 * @link https://github.com/ReiDuKuduro/Curl GitHub repo
 * @version 0.0.1
 */
class StringParser
{
    /**
     * Parses a json string into an array
     * @param string $str
     * @return array
     */
    static public function toJson($str)
    {
        $data = \json_decode($str, true);

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
     * @param string $str
     * @return array
     */
    static public function toXml($str)
    {
        return self::toJson(\json_encode((array) \simplexml_load_string($str), true));
    }

    /**
     * Parses the data passed into the requested data type
     * @param string $str
     * @param string $content_type You can use one of the following: json, xml, none
     * @return array
     */
    static public function parse($str, $content_type)
    {
        switch ($content_type) {
            case 'json':
                return self::toJson($str);
            
            case 'xml':
                return self::toXml($str);

            default:
                return $str;
        }
    }
}
