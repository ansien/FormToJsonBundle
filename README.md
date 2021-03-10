# FormToJsonBundle - Convert Symfony forms to JSON with ease!

[comment]: <> (![GitHub Workflow Status &#40;branch&#41;]&#40;https://img.shields.io/github/workflow/status/ansien/FormToJsonBundle/Tests/master?label=Tests&logo=Tests&#41;)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ansien/form-to-json-bundle.svg)](https://packagist.org/packages/ansien/form-to-json-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/ansien/form-to-json-bundle.svg)](https://packagist.org/packages/ansien/form-to-json-bundle)
![GitHub](https://img.shields.io/github/license/ansien/FormToJsonBundle)

![Example](https://raw.githubusercontent.com/ansien/FormToJsonBundle/master/.github/readme_example.png)

The goal of this bundle is to make it possible to build Symfony forms using [PHP 8 attributes](https://stitcher.io/blog/attributes-in-php-8) on your [DTO](https://blog.martinhujer.cz/symfony-forms-with-request-objects/).

#### The problem
Making forms in Symfony is fairly simple. But once you start using DTO's there will always be two classes you'll have to maintain: 
your DTO and your Symfony form type. This is not ideal because it creates unnecessary work, maintenance and can also easily lead to bugs.

#### The solution
This bundle will significantly speed up the creation of forms inside your Symfony application. With the provided PHP 8 
attributes you can quickly build forms by decorating your DTO and you won't have to maintain two different classes anymore.

## Installation
You can install the package via Composer:

```bash
composer require ansien/form-to-json-bundle
```

## Usage
```php
<?php

declare(strict_types=1);

namespace App\Controller;

use Ansien\FormToJsonBundle\Form\RapidFormBuilderInterface;
use App\Form\ExampleForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController
{
    private RapidFormBuilderInterface $formBuilder;

    public function __construct(RapidFormBuilderInterface $formBuilder) 
    {
        $this->formBuilder = $formBuilder;
    }

    #[Route('/example', methods: ['GET', 'POST'])]
    public function __invoke(Request $request): Response
    {
        return;
    }
}
```

See `./examples` for more examples.

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing
Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Supporters
[![Stargazers repo roster for @ansien/FormToJsonBundle](https://reporoster.com/stars/ansien/FormToJsonBundle)](https://github.com/ansien/FormToJsonBundle/stargazers)

## Credits
- [Andries](https://github.com/ansien)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
