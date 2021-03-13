<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\Group;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use RuntimeException;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/repeated.html
 */
class RepeatedTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'first_name',
        'first_options',
        'options',
        'second_name',
        'second_options',
    ];

    public function __construct(
        protected TranslatorInterface $translator
    ) {
    }

    public function transform(FormInterface $form): array
    {
        $schema = [];

        $formView = $form->createView();
        $config = $form->getConfig();

//        if ($config->getAttribute('prototype') === null) {
//            throw new RuntimeException('Please set "allow_add" to true to allow transformation of a RepeatedType.');
//        }

        // @TODO: Test RepeatedType

        $schema = $this->hydrateBasicOptions($formView, $schema);

//        foreach ($config->getAttribute('prototype') as $key => $childForm) {
//            $schema['children'][$key] = $this->formTransformer->transform($childForm);
//        }

        $schema = $this->hydrateExtraOptions($form, $schema, self::OPTIONS);
        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getBlockPrefix(): string
    {
        return 'repeated';
    }
}
