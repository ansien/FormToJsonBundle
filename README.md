# FormToJsonBundle

[comment]: <> (![GitHub Workflow Status &#40;branch&#41;]&#40;https://img.shields.io/github/workflow/status/ansien/FormToJsonBundle/Tests/master?label=Tests&logo=Tests&#41;)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ansien/form-to-json-bundle.svg)](https://packagist.org/packages/ansien/form-to-json-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/ansien/form-to-json-bundle.svg)](https://packagist.org/packages/ansien/form-to-json-bundle)
![GitHub](https://img.shields.io/github/license/ansien/FormToJsonBundle)

This bundle will allow you to transform Symfony forms into JSON.

## Installation
You can install the package via Composer:

```bash
composer require ansien/form-to-json-bundle
```

## Usage

Controller:
```php
<?php

declare(strict_types=1);

namespace App\Controller;

use Ansien\FormToJsonBundle\Transformer\Service\FormTransformerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Example;
use App\Form\ExampleType;

class ExampleController extends AbstractController
{
    public function __construct(private FormTransformerInterface $formTransformer) 
    {
    }

    #[Route('/example', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $example = new Example('Hello!');
        $form = $this->createForm(ExampleType::class, $example);
        
        return new JsonResponse($this->formTransformer->transform($form));
    }
}
```

Example output:
```json
{
    "id": "create_example",
    "name": "create_example",
    "type": "form",
    "disabled": false,
    "label": null,
    "label_format": null,
    "label_html": false,
    "multipart": false,
    "unique_block_prefix": "_create_example",
    "row_attr": [],
    "translation_domain": null,
    "label_translation_parameters": [],
    "attr_translation_parameters": [],
    "valid": true,
    "value": {
        "name": null,
        "exampleValue": null,
        "exampleCountry": null,
        "exampleDate": null
    },
    "required": true,
    "size": null,
    "label_attr": [],
    "help": null,
    "help_attr": [],
    "help_html": false,
    "help_translation_parameters": [],
    "compound": true,
    "method": "POST",
    "action": "",
    "submitted": false,
    "attr": [],
    "children": {
        "name": {
            "id": "create_example_name",
            "name": "name",
            "type": "text",
            "disabled": false,
            "label": null,
            "label_format": null,
            "label_html": false,
            "multipart": false,
            "unique_block_prefix": "_create_example_name",
            "row_attr": [],
            "translation_domain": null,
            "label_translation_parameters": [],
            "attr_translation_parameters": [],
            "valid": true,
            "value": "",
            "required": true,
            "size": null,
            "label_attr": [],
            "help": null,
            "help_attr": [],
            "help_html": false,
            "help_translation_parameters": [],
            "compound": false,
            "method": "POST",
            "action": "",
            "submitted": false,
            "attr": [],
            "errors": []
        }
    },
    "errors": []
}
```

## Extending the bundle
You can create your own form type transformer by making a new service that extends AbstractTypeTransformer and tagging it with `form_to_json_bundle.type_transformer`.

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
