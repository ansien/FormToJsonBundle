<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/date.html
 */
class DateTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'days',
        'placeholder',
        'format',
        'html5',
        'input',
        'input_format',
        'model_timezone',
        'months',
        'view_timezone',
        'widget',
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
        return 'date';
    }
}
