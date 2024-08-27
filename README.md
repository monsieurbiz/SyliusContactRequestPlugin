[![Banner of Sylius Contact Request plugin](docs/images/banner.jpg)](https://monsieurbiz.com/agence-web-experte-sylius)

<h1 align="center">Contact Request for Sylius</h1>

[![Contact Request Plugin license](https://img.shields.io/github/license/monsieurbiz/SyliusContactRequestPlugin?public)](https://github.com/monsieurbiz/SyliusContactRequestPlugin/blob/master/LICENSE.txt)
[![Tests Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusContactRequestPlugin/tests.yaml?branch=master&logo=github)](https://github.com/monsieurbiz/SyliusContactRequestPlugin/actions?query=workflow%3ATests)
[![Recipe Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusContactRequestPlugin/recipe.yaml?branch=master&label=recipes&logo=github)](https://github.com/monsieurbiz/SyliusContactRequestPlugin/actions?query=workflow%3ASecurity)
[![Security Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusContactRequestPlugin/security.yaml?branch=master&label=security&logo=github)](https://github.com/monsieurbiz/SyliusContactRequestPlugin/actions?query=workflow%3ASecurity)

This plugin saves contact requests made on the native form into the database allowing us to see them in the back-office of Sylius.

![Demo of the Contact Request](docs/images/demo1.png)
![Demo of the Contact Request](docs/images/demo2.png)

## Compatibility

| Sylius Version | PHP Version |
|---|---|
| 1.11 | 8.0 - 8.1 |
| 1.12 | 8.1 - 8.2 |
| 1.13 | 8.1 - 8.2 |

## Installation

If you want to use our recipes, you can configure your composer.json by running:

```bash
composer config --no-plugins --json extra.symfony.endpoint '["https://api.github.com/repos/monsieurbiz/symfony-recipes/contents/index.json?ref=flex/master","flex://defaults"]'
```

```bash
composer require monsieurbiz/sylius-contact-request-plugin
```

## Getting started

Submit a contact request from the native contact form. Them go in the back-office in the customer menu node you will have a new menu 'contact requests', click on it and 
you can see a grid with the contact requests created.
Obviously, this plugin is not retroactive and contact requests made before the plugin was installed will not be displayed.

### For the installation without flex, follow these additional steps

Change your `config/bundles.php` file to add this line for the plugin declaration:

```php
<?php

return [
    //..
    MonsieurBiz\SyliusContactRequestPlugin\MonsieurBizSyliusContactRequestPlugin::class => ['all' => true],
];
```

Create a new file `config/packages/monsieurbiz_sylius_contact_request.yaml` and add the following configuration:

```yaml
imports:
  - { resource: "@MonsieurBizSyliusContactRequestPlugin/Resources/config/config.yaml" }
```

Create a new file `config/routes/monsieurbiz_sylius_contact_request.yaml` and add the following configuration:

```yaml
imports:
    resource: '@MonsieurBizSyliusContactRequestPlugin/Resources/config/routes.yaml'
```

## Contributing

You can find a way to run the plugin without effort in the file [DEVELOPMENT.md](./DEVELOPMENT.md).

Then you can open an issue or a Pull Request if you want! 😘  
Thank you!

## License

This plugin is completely free and released under the [MIT License](https://github.com/monsieurbiz/SyliusContactRequestPlugin/blob/master/LICENSE).
