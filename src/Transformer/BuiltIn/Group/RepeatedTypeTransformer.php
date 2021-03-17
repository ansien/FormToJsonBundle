<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn\Group;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\AbstractTypeTransformer;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/repeated.html
 */
class RepeatedTypeTransformer extends AbstractTypeTransformer
{
    public const OPTIONS = [
        'first_name',
        'first_options',
        'options',
        'second_name',
        'second_options',
    ];

    public function __construct(
        protected TranslatorInterface $translator
    ) {
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
        return 'repeated';
    }
}
