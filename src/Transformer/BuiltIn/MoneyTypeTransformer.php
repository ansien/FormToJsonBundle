<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/integer.html
 */
class MoneyTypeTransformer extends AbstractTypeTransformer
{
    protected TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function transform(FormInterface $form): array
    {
        $schema = [];

        $schema = $this->hydrateConfig($form, $schema);
        $schema = $this->hydrateValues($form, $schema);
        $schema = $this->hydrateErrors($form, $schema);

        return $schema;
    }

    public static function getType(): string
    {
        return MoneyType::class;
    }
}
