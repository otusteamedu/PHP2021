# First Package

## Installation
Package published on [packagest](https://packagist.org/)

Installing via composer:
```
composer require alligro/ohw3
```

## Usage example

```
<?php

require_once __DIR__ . '/vendor/autoload.php';

use ohw3\Say;

echo Say::sentence('Hello World!');

```