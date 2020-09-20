# Laravel N11 Integration Package
[![Latest Version on Packagist](https://img.shields.io/packagist/v/onurkacmaz/laravel-n11.svg?style=flat-square)](https://packagist.org/packages/onurkacmaz/laravel-n11)
[![Build Status](https://img.shields.io/travis/onurkacmaz/laravel-n11/master.svg?style=flat-square)](https://travis-ci.org/onurkacmaz/laravel-n11)
[![Quality Score](https://img.shields.io/scrutinizer/g/onurkacmaz/laravel-n11.svg?style=flat-square)](https://scrutinizer-ci.com/g/onurkacmaz/laravel-n11)
[![Total Downloads](https://img.shields.io/packagist/dt/onurkacmaz/laravel-n11.svg?style=flat-square)](https://packagist.org/packages/onurkacmaz/laravel-n11)

## Installation

You can install the package via composer:

```bash
composer require onurkacmaz/laravel-n11
```

```bash
php artisan vendor:publish --tag=config
```

## Usage

``` php
$category = new Category();
dd($category->getTopLevelCategories());
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email kacmaz.onur@hotmail.com instead of using the issue tracker.

## Credits

- [Onur Kaçmaz](https://github.com/onurkacmaz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
