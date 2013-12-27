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
    
    private $curl_instance;

    public function __construct()
    {
    }

    /**
     * Initializes a CURL session
     * @return Curl
     */
    public function init()
    {
        $this->curl_instance = \curl_init();

        return $this;
    }

    public function isInitialized()
    {
        return !is_null($this->curl_instance);
    }

    /**
     * Closes the CURL session
     * @return Curl
     */
    public function close()
    {
        \curl_close($this->curl_instance);
        $this->curl_instance = null;

        return $this;
    }

    public function setOpt($option, $value)
    {
        \curl_setopt($this->curl_instance, $option, $value);

        return $this;
    }

    public function setOpts(array $opts)
    {
        \curl_setopt_array($this->curl_instance, $opts);

        return $this;
    }

    public function execute()
    {
        return \curl_exec($this->curl_instance);
    }

    public function get($url, array $params = array())
    {
        $standAlone = !$this->isInitialized();

        if ($standAlone) {
            $this->init();
        }

        if (!empty($params)) {
            $url .= strpos($url, '?' !== false) ? '&' : '?';
            $url .= http_build_query($params);
        }
        $this->setOpt(CURLOPT_URL, $url);
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, 0);
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $this->setOpt(CURLOPT_CONNECTTIMEOUT, 10);
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);

        $response = $this->execute();
        
        if ($standAlone) {
            $this->close();
        }

        return $response;
    }

    public function post($url, array $params = array())
    {
        $standAlone = !$this->isInitialized();

        if ($standAlone) {
            $this->init();
        }

        $this->setOpt(CURLOPT_URL, $url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST,  'POST');
        $this->setOpt(CURLOPT_POSTFIELDS,     \http_build_query($params));
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, 0);
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $this->setOpt(CURLOPT_CONNECTTIMEOUT, 10);
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);

        $response = $this->execute();
        
        if ($standAlone) {
            $this->close();
        }

        return $response;
    }

    public function put($url, array $params = array())
    {
        $standAlone = !$this->isInitialized();

        if ($standAlone) {
            $this->init();
        }

        $this->setOpt(CURLOPT_URL, $url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST,  'PUT');
        $this->setOpt(CURLOPT_POSTFIELDS,     \http_build_query($params));
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, 0);
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $this->setOpt(CURLOPT_CONNECTTIMEOUT, 10);
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);

        $response = $this->execute();
        
        if ($standAlone) {
            $this->close();
        }

        return $response;
    }

    public function delete($url, array $params = array())
    {
        $standAlone = !$this->isInitialized();

        if ($standAlone) {
            $this->init();
        }

        $this->setOpt(CURLOPT_URL, $url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST,  'DELETE');
        $this->setOpt(CURLOPT_POSTFIELDS,     \http_build_query($params));
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, 0);
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $this->setOpt(CURLOPT_CONNECTTIMEOUT, 10);
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);

        $response = $this->execute();
        
        if ($standAlone) {
            $this->close();
        }

        return $response;
    }

    public function login($url, array $params, $cookiefile, $useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36')
    {
        $this->setOpt(CURLOPT_USERAGENT, $useragent);
        $this->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $this->setOpt(CURLOPT_COOKIEJAR, $cookiefile);
        $this->setOpt(CURLOPT_COOKIEFILE, $cookiefile);
        
        return $this->post($url, $params);
    }
}
