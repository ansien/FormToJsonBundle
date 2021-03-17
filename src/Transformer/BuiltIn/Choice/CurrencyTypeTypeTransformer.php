<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\Choice;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/currency.html
 */
class CurrencyTypeTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'choice_translation_locale',
    ];

    public function __construct(protected TranslatorInterface $translator)
    {
    }

    public function transform(FormInterface $form): array
    {
        $schema = [];

        $formView = $form->createView();

        $schema = $this->hydrateBasicOptions($formView, $schema);
        $schema = $this->hydrateChoicesOption($formView, $schema);
        $schema = $this->hydrateExtraOptions($form, $schema, [
            ...ChoiceTypeTypeTransformer::OPTIONS,
            ...self::OPTIONS,
        ]);

        return $schema;
    }

    public static function getBlockPrefix(): string
    {
        return 'currency';
    }
}
