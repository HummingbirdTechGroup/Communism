# Communism

Little utility to easily extract and inject properties from objects.

[![License](https://poser.pugx.org/carlosv2/communism/license)](https://packagist.org/packages/carlosv2/communism)
[![Build Status](https://travis-ci.org/carlosV2/Communism.svg?branch=master)](https://travis-ci.org/carlosV2/Communism)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/21d88d25-be98-4e8c-86bd-8762b4ebb039/mini.png)](https://insight.sensiolabs.com/projects/21d88d25-be98-4e8c-86bd-8762b4ebb039)

## Usage

If you want to extract any object property, use the following construction:

```php
$value = From($object)->extract($property);
```

If you want to inject any object property, use the following construction:

```php
To($object)->inject($property, $value);
```

If you want to replace any object property, use the following construction:

```php
// The `replace` method is avilable for both `From` and `To` 
From($object)->replace($property, function ($value) {
    // `$value` will contain the current value for that property
    
    // Whatever is returned will be the new value of the property
    return $newValue;
});
```

Both functions instantiate a `carlosV2\Communism\Communist` object which
allows the extraction and injection of properties.


## Words of wisdom

This project is designed to be used for development environment only. If you find yourself
using this project on production code, you should better reconsider your architecture.


## Install

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this project:

```bash
$ composer require --dev carlosv2/communism
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.
