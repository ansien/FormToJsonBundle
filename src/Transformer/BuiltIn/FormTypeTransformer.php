<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Transformer\Service\FormTransformerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/form.html
 */
class FormTypeTransformer extends AbstractTypeTransformer
{
    public function __construct(
        protected TranslatorInterface $translator,
        protected FormTransformerInterface $formTransformer
    ) {
    }

    public function transform(FormInterface $form): array
    {
        $schema = [];

        $formView = $form->createView();

        $schema = $this->hydrateBasicOptions($formView, $schema);

        foreach ($form->all() as $key => $childForm) {
            $schema['children'][$key] = $this->formTransformer->transform($childForm);
        }

        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getForBlockPrefix(): string
    {
        return 'form';
    }
}
