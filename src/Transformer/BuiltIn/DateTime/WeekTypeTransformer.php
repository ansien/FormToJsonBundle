<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/week.html
 */
class WeekTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'choice_translation_domain',
        'placeholder',
        'html5',
        'input',
        'widget',
        'years',
        'weeks',
    ];

    public function __construct(protected TranslatorInterface $translator)
    {
    }

    public function transform(FormInterface $form): array
    {
        $schema = [];

        $formView = $form->createView();

        $schema = $this->hydrateBasicOptions($formView, $schema);
        $schema = $this->hydrateExtraOptions($form, $schema, self::OPTIONS);

        return $schema;
    }

    public static function getBlockPrefix(): string
    {
        return 'week';
    }
}
