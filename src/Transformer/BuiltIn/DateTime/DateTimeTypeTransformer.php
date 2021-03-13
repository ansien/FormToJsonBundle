<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/datetime.html
 */
class DateTimeTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'choice_translation_domain',
        'date_format',
        'date_label',
        'date_widget',
        'days',
        'placeholder',
        'format',
        'hours',
        'html5',
        'input',
        'input_format',
        'minutes',
        'model_timezone',
        'months',
        'seconds',
        'time_label',
        'time_widget',
        'view_timezone',
        'widget',
        'with_minutes',
        'with_seconds',
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
        return 'datetime';
    }
}
