[![Build Status](https://travis-ci.org/Opifer/Imuis.svg)](https://travis-ci.org/Opifer/Imuis)

# Imuis

[Muis software](https://www.muis.nl/) builds administrative software for accountants and entrepreneurs.
This package eases the communication with the iMuis API from a PHP project.
The client is written on version 10-09-2013 from the Cloudswitch iMuis webservice.

This package is a work in progress. Currently only a few methods are available. More methods will be added and we're open to any pull requests.

Installation
------------

Add the package to your composer.json

    composer require opifer/imuis

Example
-------

Quick example on how to import a new creditor into Imuis

```php
<?php

require 'vendor/autoload.php';

use Opifer\Imuis\Client;
use Opifer\Imuis\Model\Creditor;

$creditor = new Creditor();
$creditor->setName('Rick van Laarhoven');
// Set any other data on the creditor

$client = new Client('PARTNERKEY', 'ENVIRONMENT');
$response = $client->createCreditor($creditor);

if ($response->hasErrors()) {
    $errors = $response->getErrors();
}
```
