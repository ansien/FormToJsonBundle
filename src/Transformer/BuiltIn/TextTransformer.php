<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;

class TextTransformer extends AbstractTransformer
{
    public function transform(FormInterface $form): array
    {
        return [
            'value' => $form->getData(),
        ];
    }

    public static function getType(): string
    {
        return TextType::class;
    }
}
