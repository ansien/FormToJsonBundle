<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\Context;

use Ansien\FormToJsonBundle\Transformer\TypeTransformerInterface;
use RuntimeException;
use Symfony\Component\Form\FormInterface;

class TransformerContext
{
    /**
     * @var TypeTransformerInterface[]
     */
    private array $transformers = [];

    public function addTransformer(TypeTransformerInterface $transformer): void
    {
        $forBlockPrefix = $transformer::getBlockPrefix();

        $this->transformers[$forBlockPrefix] = $transformer;
    }

    public function getTransformer(FormInterface $form): TypeTransformerInterface
    {
        $formView = $form->createView();

        if ($formView->parent === null) {
            return $this->transformers['form'];
        }

        $blockPrefixes = $formView->vars['block_prefixes'];
        $blockPrefix = $blockPrefixes[count($blockPrefixes) - 2];

        if (!array_key_exists($blockPrefix, $this->transformers)) {
            throw new RuntimeException(sprintf('Transformer for block prefix %s could not be found.', $blockPrefix));
        }

        return $this->transformers[$blockPrefix];
    }
}
