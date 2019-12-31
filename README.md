# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nzsakib/db-config.svg?style=flat-square)](https://packagist.org/packages/nzsakib/db-config)
[![Build Status](https://img.shields.io/travis/nzsakib/db-config/master.svg?style=flat-square)](https://travis-ci.org/nzsakib/db-config)
[![Quality Score](https://img.shields.io/scrutinizer/g/nzsakib/db-config.svg?style=flat-square)](https://scrutinizer-ci.com/g/nzsakib/db-config)
[![Total Downloads](https://img.shields.io/packagist/dt/nzsakib/db-config.svg?style=flat-square)](https://packagist.org/packages/nzsakib/db-config)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require nzsakib/db-config
```
`Only supported laravel framework is laravel 5.6.*`

## Usage

#### Get All Configurations as collection from DB 
```php 
use Nzsakib\DbConfig\DbConfig;

$config = new DbConfig;
$allConfig = $config->getCollection(); // returns Model collection of specified table

// pass to blade or do your thing by looping 
foreach($allConfig as $config) {
    dump($config->name);
    dump($config->value);
}
```
#### Set a new config 
``` php
use Nzsakib\DbConfig\DbConfig;

$config = new DbConfig; 
$name = 'facebook';
$value = [
    'client_id' => 'a client id',
    'client_secret' => 'client secret',
];
// Value could be any data type e.g. boolean/array/string/integer

try {
    $newConfig = $config->set($name, $value); 
    // new config is set and cache is invalidated 
} catch (\InvalidArgumentException $e) {
    // redirect with message $e->getMessage() 
}
```
#### Update existing DB config 
Cache will be deleted automatically after successfull update.
```php 
use Nzsakib\DbConfig\DbConfig;
use Illuminate\Database\Eloquent\ModelNotFoundException;

$config = new DbConfig;

$name = 'facebook';
$newValue = [
    'client_id' => 'updated client id',
    'client_secret' => 'updated secret'
];

try {
    $updatedConfig = (new DbConfig)->updateByName($name, $newValue); 
    // Updated model is returned 
} catch (ModelNotFoundException $e) {
    // Specified name does not exists in database
}

// Or you could update by `id` which is primary key 
try {
    $updatedConfig = (new DbConfig)->updateById($id, $name, $newValue);
    // Updated model is returned 
} catch (ModelNotFoundException $e) {
    // Specified id does not exists in database
}
```

#### Delete a DB Config
Cache will be deleted automatically after successfull delete.
```php 
use Nzsakib\DbConfig\DbConfig;
use Illuminate\Database\Eloquent\ModelNotFoundException;

$name = 'facebook';
try {
    $deletedConfig = (new DbConfig)->deleteByName($name);
    // deleted successfully 
} catch (ModelNotFoundException $e) {
    // specified name does not exists in database 
}

// Or delete the config by primary key `id` 
$id = request('id'); 
try {
    $deletedConfig = (new DbConfig)->deleteById($id);
    // deleted successfully 
} catch (ModelNotFoundException $e) {
    // specified id does not exists in database 
}
```
## Publish the package config and migration files
```bash 
php artisan vendor:publish --provider="Nzsakib\DbConfig\DbConfigServiceProvider" --tag="config"
php artisan vendor:publish --provider="Nzsakib\DbConfig\DbConfigServiceProvider" --tag="migrations"
```

You can change table name of the migration file, but make sure you mention the updated table name in the config file.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email sukku.mia@gmail.com instead of using the issue tracker.

## Credits

- [Nazmus Sakib](https://github.com/nzsakib)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).