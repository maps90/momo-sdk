# Momo SDK #

this is the PHP wrapper for Momo Mobile API.

## Installation ##

### Composer Installation ###

```sh
$ composer require Momo/php-sdk
```

### Manual Installation ###
download latest release & require 'autoload.php'.

```sh
require "Momo-php-sdk/autoload.php";

use Momo\Momo;
```

## How to ##

Check **[API Seller Apiary](http://docs.apiforseller.apiary.io/)**, for available endpoints.

### Basic Usage ###

```sh
$Momo = new Momo(API_TOKEN);
$Momo->post($url , $parameter);

//get headers
$headers = $Momo->getResponseHeaders();

//get response Http Code
$httpCode = $Momo->getResponseCode();

//get body
$body = $Momo->getResponseBody();

```
### Proxy Enabled ###
```sh
$request = new MMRequest();
$request->setProxy([
     'CURLOPT_PROXY' => PROXY_HOST,
     'CURLOPT_PROXYUSERPWD' => PROXY_USERPWD,
     'CURLOPT_PROXYPORT' => PROXY_PORT,
]);
$Momo = new Momo(API_TOKEN, $request);
$results = $Momo->post($url , $parameter);
```

### Error Handling ###

```sh
try {
    $Momo = new Momo(API_TOKEN);
    $Momo->post($url, $parameter);
} catch (MMException $e) {
    // print exception.
}

$result = $Momo->getResponseBody();
if ($Momo->getResponseCode() == 200 && !empty($result)) {
    // success
} else {
    // error
}
```

