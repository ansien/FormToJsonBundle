<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Transformer\TransformerInterface;
use Symfony\Component\Form\FormInterface;

abstract class AbstractTransformer implements TransformerInterface
{
    public function transform(FormInterface $form): array
    {
        // TODO: Implement convert() method.
    }

    abstract public static function getType(): string;
}
