<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Transformer\Context\FormResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/form.html
 */
class FormTypeTransformer extends AbstractTypeTransformer
{
    public function __construct(
        protected TranslatorInterface $translator,
        protected FormResolver $resolver
    ) {
    }

    public function transform(FormInterface $form, FormView $formView): array
    {
        $schema = [];

        $schema = $this->hydrateBasicOptions($formView, $schema);

        foreach ($form->all() as $key => $childForm) {
            $childFormView = $childForm->createView();
            $transformer = $this->resolver->resolve($childFormView);
            $schema['children'][$key] = $transformer->transform($childForm, $childFormView);
        }

        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getForBlockPrefix(): string
    {
        return 'form';
    }
}
