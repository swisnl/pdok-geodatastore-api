# PDOK Geodatastore API

[![PHP from Packagist](https://img.shields.io/packagist/php-v/swisnl/pdok-geodatastore-api.svg)](https://packagist.org/packages/swisnl/pdok-geodatastore-api)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/swisnl/pdok-geodatastore-api.svg)](https://packagist.org/packages/swisnl/pdok-geodatastore-api)
[![Software License](https://img.shields.io/packagist/l/swisnl/pdok-geodatastore-api.svg)](LICENSE) 
[![Run Status](https://api.shippable.com/projects/5a05d4ece397490700035e23/badge?branch=master)](https://app.shippable.com/github/swisnl/pdok-geodatastore-api)
[![Coverage Badge](https://api.shippable.com/projects/5a05d4ece397490700035e23/coverageBadge?branch=master)](https://app.shippable.com/github/swisnl/pdok-geodatastore-api)

A simple Object Oriented wrapper for PDOK Geodatastore API, written in PHP7. Uses [PDOK Geodatastore API v1](https://geodatastore.pdok.nl/api/v1/docs).

## Features

* Follows PSR-4 conventions and coding standard: autoload friendly
* Light and fast thanks to lazy loading of API classes

## Requirements

* PHP >= 7.0
* [Guzzle](https://github.com/guzzle/guzzle) library,
* (optional) PHPUnit to run tests.

## Install

```bash
$ composer require swisnl/pdok-geodatastore-api php-http/guzzle6-adapter
```

Why `php-http/guzzle6-adapter`? We are decoupled from any HTTP messaging client with help by [HTTPlug](http://httplug.io/).

## Basic usage of `pdok-geodatastore-api` client

```php
<?php

// This file is generated by Composer
require_once 'vendor/autoload.php';

$client = new \Swis\PdokGeodatastoreApi\Client();
$client->authenticate('username', 'password');
$datasets = $client->datasets()->all();
```

From `$client` object, you can access all features.

## License

`pdok-geodatastore-api` is licensed under the MIT License - see the LICENSE file for details

## Credits

Heavily inspired by [PHP GitHub API](https://github.com/KnpLabs/php-github-api).
