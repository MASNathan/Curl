#Curl

[![Downloads with Composer](https://poser.pugx.org/masnathan/curl/downloads.png)](https://packagist.org/packages/masnathan/curl)
[![SensioLabs Insight](https://insight.sensiolabs.com/projects/6d9231d8-9140-4b02-9522-5d3c3aa3d6f2/mini.png)](https://insight.sensiolabs.com/projects/6d9231d8-9140-4b02-9522-5d3c3aa3d6f2)
[![ReiDuKuduro @gittip](http://bottlepy.org/docs/dev/_static/Gittip.png)](https://www.gittip.com/ReiDuKuduro/)

Another Curl Library...

# How to install via Composer

The recommended way to install is through [Composer](http://composer.org).

```sh
# Install Composer
$ curl -sS https://getcomposer.org/installer | php

# Add curl as a dependency
$ php composer.phar require masnathan/curl:dev-master
```

Once it's installed, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

#How to use

##The basic way

```php
$curl = new Curl();

//These are the fast-forward methods
$curl->get(string $url [, array $params]);
$curl->post(string $url [, array $params]);
$curl->put(string $url [, array $params]);
$curl->delete(string $url [, array $params]);

//or you can do it like a true ninja
$response = $curl
            ->init()
            ->setOpt(CURLOPT_URL, 'http://somedomain.com/')
            ->setOpt(CURLOPT_SSL_VERIFYHOST, 0)
            ->setOpt(CURLOPT_SSL_VERIFYPEER, false)
            ->setOpt(CURLOPT_CONNECTTIMEOUT, 5)
            ->setOpt(CURLOPT_RETURNTRANSFER, true)
            ->execute();
$curl->close();

//or you can login onto a website
$curl->init();
$login_page   = $curl->login('http://somedomain.com/login', array('username' => 'my_user', 'password' => 'my_fancy_password'), '/path/to/my/cookie.txt');
$private_page = $curl->get('http://somedomain.com/private_page');
```

##The "not so basic until you know it" way
```php
//These are the fast-forward methods
Ch::get( string $url [, array $params [, function $callback [, string $data_type]]]);
Ch::post( string $url [, array $params [, function $callback [, string $data_type]]]);
Ch::postJson( string $url [, array $params [, function $callback [, string $data_type]]]);
Ch::postXml( string $url [, array $params [, function $callback [, string $data_type]]]);
Ch::put( string $url [, array $params [, function $callback [, string $data_type]]]);
Ch::delete( string $url [, array $params [, function $callback [, string $data_type]]]);

//Here are a few examples:
Ch::get('http://somedomain.com');
Ch::get('http://somedomain.com', array('param1' => 'some value', 'param2' => 'some other value'));
Ch::get('http://somedomain.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); });
Ch::get('http://somedomain.com', array('param1' => 'some value', 'param2' => 'some other value'), function(data) { var_dump($data); }, 'json');
Ch::get('http://somedomain.com', array('param1' => 'some value', 'param2' => 'some other value'), 'json');
Ch::get('http://somedomain.com', 'xml');
Ch::get('http://somedomain.com', function(data) { var_dump($data); }, 'json');
//Any of the above examples is aceptable

```

# License

This library is under the MIT License, see the complete license [here](LICENSE)

###Is your project using `MASNathan\Curl`? [Let me know](https://github.com/ReiDuKuduro/Curl/issues/new?title=New%20script%20using%20Curl&body=Name and Description of your script.)!
