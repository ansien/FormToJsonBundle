<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/number.html
 */
class NumberTypeTransformer extends AbstractTypeTransformer
{
    public function __construct(protected TranslatorInterface $translator)
    {
    }

    public function transform(FormInterface $form, FormView $formView): array
    {
        $schema = [];

        $schema = $this->hydrateBasicOptions($formView, $schema);
        $schema = $this->hydrateExtraOptions($form, $schema, [
            'grouping',
            'html5',
            'input',
            'scale',
            'rounding_mode',
        ]);
        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getForBlockPrefix(): string
    {
        return 'integer';
    }
}
