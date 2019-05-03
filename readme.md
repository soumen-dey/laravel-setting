# Setting

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

A lightweight and simple package for database based key-value store for Laravel 5.6 and above.

## Installation

Via Composer

``` bash
$ composer require soumen-dey/laravel-setting
```

The migrations will be loaded automatically, just run `php artisan migrate`.

If you want, you can publish the config file.

``` bash
php artisan vendor:publish --provider="Soumen\Setting\SettingServiceProvider" --tag="config"
```

## Usage

Use the included helper to access the settings.

``` php
setting('key', 'value'); // set the setting 'key' using the 'value'
setting('key') // get the setting 'key'
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Credits

- [Soumen Dey][link-author]
- [All Contributors][link-contributors]

## License

MIT License. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/soumen-dey/laravel-setting.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/soumen-dey/laravel-setting.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/soumen-dey/laravel-setting/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/soumen-dey/laravel-setting
[link-downloads]: https://packagist.org/packages/soumen-dey/laravel-setting
[link-travis]: https://travis-ci.org/soumen-dey/laravel-setting
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/soumen-dey
[link-contributors]: ../../contributors
