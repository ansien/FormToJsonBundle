<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Transformer\Context\FormResolver;
use RuntimeException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/collection.html
 */
class CollectionTypeTransformer extends AbstractTypeTransformer
{
    public function __construct(
        protected TranslatorInterface $translator,
        protected FormResolver $resolver
    ) {
    }

    public function transform(FormInterface $form, FormView $formView): array
    {
        $schema = [];

        $config = $form->getConfig();

        if ($config->getAttribute('prototype') === null) {
            throw new RuntimeException('Please set "allow_add" to true to allow transformation of a CollectionType.');
        }

        $schema = $this->hydrateBasicOptions($formView, $schema);

        foreach ($config->getAttribute('prototype') as $key => $childForm) {
            $childFormView = $childForm->createView();
            $transformer = $this->resolver->resolve($childFormView);
            $schema['children'][$key] = $transformer->transform($childForm, $childFormView);
        }

        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getForBlockPrefix(): string
    {
        return 'collection';
    }
}
