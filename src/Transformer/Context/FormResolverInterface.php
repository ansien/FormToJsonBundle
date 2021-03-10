<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\Context;

use Ansien\FormToJsonBundle\Transformer\TransformerInterface;

interface FormResolverInterface
{
    public function addTransformer(TransformerInterface $transformer): void;
}
