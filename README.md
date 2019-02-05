# PDOK Geodatastore API

[![PHP from Packagist](https://img.shields.io/packagist/php-v/swisnl/pdok-geodatastore-api.svg)](https://packagist.org/packages/swisnl/pdok-geodatastore-api)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/swisnl/pdok-geodatastore-api.svg)](https://packagist.org/packages/swisnl/pdok-geodatastore-api)
[![Software License](https://img.shields.io/packagist/l/swisnl/pdok-geodatastore-api.svg)](LICENSE.md) 
[![Run Status](https://api.shippable.com/projects/5a05d4ece397490700035e23/badge?branch=master)](https://app.shippable.com/github/swisnl/pdok-geodatastore-api)
[![Coverage Badge](https://api.shippable.com/projects/5a05d4ece397490700035e23/coverageBadge?branch=master)](https://app.shippable.com/github/swisnl/pdok-geodatastore-api)
[![Total Downloads](https://img.shields.io/packagist/dt/swisnl/pdok-geodatastore-api.svg)](https://packagist.org/packages/swisnl/pdok-geodatastore-api)
[![Made by SWIS](https://img.shields.io/badge/%F0%9F%9A%80-made%20by%20SWIS-%23D9021B.svg)](https://www.swis.nl)

A simple Object Oriented wrapper for PDOK Geodatastore API, written in PHP7. Uses [PDOK Geodatastore API v1](https://geodatastore.pdok.nl/api/v1/docs).

## :warning: Out of service :warning:

PDOK Geodatastore and its API have been taken out of service as of January 2019, therefore this package no longer works!

## Features

* Follows PSR-4 conventions and coding standard: autoload friendly
* Light and fast thanks to lazy loading of API classes

## Requirements

* PHP >= 7.0
* [Guzzle](https://github.com/guzzle/guzzle) library,
* (optional) PHPUnit to run tests.

## Install

Via Composer

``` bash
$ composer require swisnl/pdok-geodatastore-api php-http/guzzle6-adapter
```

Why `php-http/guzzle6-adapter`? We are decoupled from any HTTP messaging client with help by [HTTPlug](http://httplug.io/).

## Usage

``` php
$client = new \Swis\PdokGeodatastoreApi\Client();
$client->authenticate('username', 'password');
$datasets = $client->datasets()->all();
```

From `$client` object, you can access all features.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email security@swis.nl instead of using the issue tracker.

## Credits

- [Jasper Zonneveld](https://github.com/JaZo)
- [All Contributors](../../contributors)

Heavily inspired by [PHP GitHub API](https://github.com/KnpLabs/php-github-api).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## SWIS

[SWIS](https://www.swis.nl) is a web agency from Leiden, the Netherlands. We love working with open source software.
