# Communism

Little utility to easily extract and inject properties from objects.

[![License](https://poser.pugx.org/carlosv2/communism/license)](https://packagist.org/packages/carlosv2/communism)
[![Build Status](https://travis-ci.org/carlosV2/Communism.svg?branch=master)](https://travis-ci.org/carlosV2/Communism)

## Usage

If you want to extract any object property, use the following construction:

```php
$value = From($object)->extract($property);
```

If you want to inject any object property, use the following construction:

```php
To($object)->inject($property, $value);
```

Both functions instantiate a `carlosV2\Communism\Communist` object which
allows the extraction and injection of properties.


## Install

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this project:

```bash
$ composer require --dev carlosv2/communism
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.
