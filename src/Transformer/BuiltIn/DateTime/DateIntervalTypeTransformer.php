<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/dateinterval.html
 */
class DateIntervalTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'days',
        'placeholder',
        'hours',
        'input',
        'labels',
        'minutes',
        'months',
        'seconds',
        'weeks',
        'widget',
        'with_days',
        'with_hours',
        'with_invert',
        'with_minutes',
        'with_months',
        'with_seconds',
        'with_weeks',
        'with_years',
        'years',
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
        $schema = $this->hydrateErrors($formView, $schema);

        return $schema;
    }

    public static function getBlockPrefix(): string
    {
        return 'dateinterval';
    }
}
