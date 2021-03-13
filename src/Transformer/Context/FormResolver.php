<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\Context;

use Ansien\FormToJsonBundle\Transformer\TypeTransformerInterface;
use RuntimeException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Contracts\Translation\TranslatorInterface;

class FormResolver implements FormResolverInterface
{
    /**
     * @var TypeTransformerInterface[]
     */
    private array $transformers = [];

    private TranslatorInterface $translator;

    public function __construct(iterable $transformers, TranslatorInterface $translator)
    {
        foreach ($transformers as $transformer) {
            $this->addTransformer($transformer);
        }

        $this->translator = $translator;
    }

    public function addTransformer(TypeTransformerInterface $transformer): void
    {
        $forBlockPrefix = $transformer::getForBlockPrefix();

        if (array_key_exists($forBlockPrefix, $this->transformers)) {
            throw new RuntimeException(sprintf('Transformer for block prefix %s is already registered.', $forBlockPrefix));
        }

        $this->transformers[$forBlockPrefix] = $transformer;
    }

    public function resolve(FormView $formView): TypeTransformerInterface
    {
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

    public function transform(FormInterface $form): array
    {
        $formView = $form->createView();
        $transformer = $this->resolve($formView);

        return $transformer->transform($form, $formView);
    }
}
