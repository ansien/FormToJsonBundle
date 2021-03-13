<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/money.html
 */
class MoneyTypeTransformer extends AbstractTypeTransformer
{
    public function __construct(protected TranslatorInterface $translator)
    {
    }

    public function transform(FormInterface $form): array
    {
        $schema = [];

        $formView = $form->createView();

        $schema = $this->hydrateBasicOptions($formView, $schema);
        $schema = $this->hydrateExtraOptions($form, $schema, [
            'currency',
            'divisor',
            'grouping',
            'rounding_mode',
            'html5',
            'scale',
        ]);
        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getForBlockPrefix(): string
    {
        return 'money';
    }
}
