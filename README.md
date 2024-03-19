# iikoAPI Library

iikoAPI Library is a PHP client for interacting with the iiko API. It is designed to simplify the process of making API calls to iiko and handling the responses.

## Installation

You can install the package via composer:

```bash
composer require iikoapilibrary/iikoapi
```

## Configuration
After installing the iikoAPI Library, publish its configuration file to your Laravel project:


```bash
php artisan vendor:publish --provider="IikoApiLibrary\Providers\iikoServiceProvider" --tag="iikoapi-config"
```

## Resources
Also you need to publish resource files to your Laravel project
```bash
php artisan vendor:publish --provider="IikoApiLibrary\Providers\iikoServiceProvider" --tag="iikoapi-resources"
```

This will publish the iikoapi.php configuration file to your config directory. In this file, you can specify the API login credentials and other settings.

## Usage
Here is a simple example of how to use the iikoAPI client:
```bash
$organization = iikoClientFacade::create()->GetOrganizationsInfo();

$menu = iikoClientFacade::create()->ExportMenu($org['organizations'][0]['id']);

$arr = $menu->toArray(1);

echo dd($arr);
```
Make sure to check out the API documentation for a list of available methods.