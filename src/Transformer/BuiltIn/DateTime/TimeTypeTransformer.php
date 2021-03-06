<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/time.html
 */
class TimeTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'choice_translation_domain',
        'placeholder',
        'hours',
        'html5',
        'input',
        'input_format',
        'minutes',
        'model_timezone',
        'reference_date',
        'seconds',
        'view_timezone',
        'widget',
        'with_minutes',
        'with_seconds',
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
        return 'time';
    }
}
