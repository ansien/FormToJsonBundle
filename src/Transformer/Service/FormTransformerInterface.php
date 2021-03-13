<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\Service;

use Symfony\Component\Form\FormInterface;

interface FormTransformerInterface
{
    public function transform(FormInterface $form): array;
}
