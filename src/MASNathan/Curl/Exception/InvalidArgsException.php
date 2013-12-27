<?php

namespace MASNathan\Curl\Exception;

/**
 * Exception used when the args passed are not what they should be
 *
 * @package	MASNathan
 * @subpackage Curl
 * @author	André Filipe <andre.r.flip@gmail.com>
 * @link https://github.com/ReiDuKuduro/Curl GitHub repo
 * @license	MIT
 * @version	0.0.1
 */
class InvalidArgsException extends \Exception
{
	public function __construct($message = '', $code = 0, $previous = null) {

    	if (!$message) {
       		$message = "Something is wrong with some method that you recently called.";
    	}
        parent::__construct($message, $code, $previous);
    }
}
