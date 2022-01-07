# Laravel-insee

[![Latest Version on Packagist](https://img.shields.io/packagist/v/axeldotdev/laravel-insee.svg?style=flat-square)](https://packagist.org/packages/axeldotdev/laravel-insee)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/axeldotdev/laravel-insee/run-tests?label=tests)](https://github.com/axeldotdev/laravel-insee/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/axeldotdev/laravel-insee/Check%20&%20fix%20styling?label=code%20style)](https://github.com/axeldotdev/laravel-insee/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/axeldotdev/laravel-insee.svg?style=flat-square)](https://packagist.org/packages/axeldotdev/laravel-insee)

This is a Laravel package that helps you use the INSEE APIs.

## Installation

You can install the package via composer:

```bash
composer require axeldotdev/laravel-insee
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-insee-config"
```

## Usage

```php
$insee = new Axeldotdev\Insee();
echo $insee->echoPhrase('Hello, Axeldotdev!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Axel Charpentier](https://github.com/axeldotdev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
