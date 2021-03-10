<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer;

use Symfony\Component\Form\FormInterface;

interface TransformerInterface
{
    public function transform(FormInterface $form): array;
}
