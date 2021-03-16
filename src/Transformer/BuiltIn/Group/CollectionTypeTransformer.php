<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\Group;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\Service\FormTransformerInterface;
use RuntimeException;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/collection.html
 */
class CollectionTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'allow_add',
        'allow_delete',
        'delete_empty',
        'entry_options',
        'prototype_name',
    ];

    public function __construct(
        protected TranslatorInterface $translator,
        protected FormTransformerInterface $formTransformer
    ) {
    }

    public function transform(FormInterface $form): array
    {
        $schema = [];

        $formView = $form->createView();
        $config = $form->getConfig();

        if ($config->getAttribute('prototype') === null) {
            throw new RuntimeException('Please set "allow_add" to true to allow transformation of a CollectionType.');
        }

        $schema = $this->hydrateBasicOptions($formView, $schema);

        foreach ($config->getAttribute('prototype') as $key => $childForm) {
            $schema['children'][$key] = $this->formTransformer->transform($childForm);
        }

        $schema = $this->hydrateExtraOptions($form, $schema, self::OPTIONS);
        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getBlockPrefix(): string
    {
        return 'collection';
    }
}
