<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/choice.html
 */
class ChoiceTypeTypeTransformer extends AbstractTypeTransformer
{
    public function __construct(protected TranslatorInterface $translator)
    {
    }

    public function transform(FormInterface $form, FormView $formView): array
    {
        $schema = [];

        $schema = $this->hydrateBasicOptions($formView, $schema);
        $schema = $this->hydrateExtraOptions($form, $schema, [
            'choices',
            'choice_attr',
            'choice_filter',
            'choice_label',
            'choice_loader',
            'choice_name',
            'choice_translation_domain',
            'choice_value',
            'expanded',
            'group_by',
            'multiple',
            'placeholder',
            'preferred_choices',
        ]);
        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getForBlockPrefix(): string
    {
        return 'choice';
    }
}
