<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\Context;

use Ansien\FormToJsonBundle\Transformer\TypeTransformerInterface;

interface FormResolverInterface
{
    public function addTransformer(TypeTransformerInterface $transformer): void;
}
