<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\Service;

use Ansien\FormToJsonBundle\Transformer\Context\TransformerContext;
use Symfony\Component\Form\FormInterface;

class FormTransformer implements FormTransformerInterface
{
    public function __construct(private TransformerContext $transformerContext)
    {
    }

    public function transform(FormInterface $form): array
    {
        $transformer = $this->transformerContext->getTransformer($form);

        return $transformer->transform($form);
    }
}
