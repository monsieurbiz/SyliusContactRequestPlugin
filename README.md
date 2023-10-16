<p align="center">
    <a href="https://monsieurbiz.com" target="_blank">
        <img src="https://monsieurbiz.com/logo.png" width="250px" alt="Monsieur Biz logo" />
    </a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="https://monsieurbiz.com/agence-web-experte-sylius" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" width="200px" alt="Sylius logo" />
    </a>
    <br/>
    <img src="https://monsieurbiz.com/assets/images/sylius_badge_extension-artisan.png" width="100" alt="Monsieur Biz is a Sylius Extension Artisan partner">
</p>

<h1 align="center">Contact Request for Sylius</h1>

[![Contact Request  Plugin license](https://img.shields.io/github/license/monsieurbiz/SyliusContactRequestPlugin?public)](https://github.com/monsieurbiz/SyliusContactRequestPlugin/blob/master/LICENSE)
[![Tests Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusContactRequestPlugin/tests.yml?branch=master&logo=github)](https://github.com/monsieurbiz/SyliusContactRequestPlugin/actions?query=workflow%3ATests)
[![Security Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusContactRequestPlugin/security.yml?branch=master&label=security&logo=github)](https://github.com/monsieurbiz/SyliusContactRequestPlugin/actions?query=workflow%3ASecurity)

This plugin saves contact requests made on the native form into the database allowing us to see them in the back-office of Sylius.

![Demo of the Contact Request](docs/images/demo1.png)
![Demo of the Contact Request](docs/images/demo2.png)

## Installation

Install the plugin via composer:

```bash
composer require monsieurbiz/sylius-contact-request-plugin
```

## Getting started

Submit a contact request from the native contact form. Then go in the back-office in the customer menu node you will have a new menu 'contact requests', click on it, and 
you can see a grid with the contact requests created.
Obviously, this plugin is not retroactive and contact requests made before this plugin was installed will not be displayed.

### For the installation without flex, follow these additional steps

Change your `config/bundles.php` file to add this line for the plugin declaration:

```php
<?php
// config/bundles.php

return [
    //..
    MonsieurBiz\SyliusContactRequestPlugin\MonsieurBizSyliusContactRequestPlugin::class => ['all' => true],
];
```

Copy the plugin configuration files in your `config` folder:

```bash
cp --recursive --verbose vendor/monsieurbiz/sylius-contact-request-plugin/recipes/1.0/config/* config
```

### Migrations

Run previous Doctrie migrations, if any, to have application synchronized with SQL database :
```php
bin/console doctrine:migrations:migrate
```

Make a doctrine migration diff : 

```php
bin/console doctrine:migrations:diff
```

Then run it : 

```php
bin/console doctrine:migrations:migrate
```

## Contributing

You can find a way to run the plugin without effort in the file [DEVELOPMENT.md](./DEVELOPMENT.md).

Then you can open an issue or a Pull Request if you want! 😘  
Thank you!

## License

This plugin is completely free and released under the [MIT License](https://github.com/monsieurbiz/SyliusContactRequestPlugin/blob/master/LICENSE).
