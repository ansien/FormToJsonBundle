<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\Context;

use Ansien\FormToJsonBundle\Transformer\TypeTransformerInterface;
use RuntimeException;
use Symfony\Component\Form\FormInterface;

class FormResolver implements FormResolverInterface
{
    /**
     * @var TypeTransformerInterface[]
     */
    private array $transformers = [];

    public function __construct(iterable $transformers = [])
    {
        foreach ($transformers as $transformer) {
            $this->addTransformer($transformer);
        }
    }

    public function addTransformer(TypeTransformerInterface $transformer): void
    {
        $type = $transformer::getType();

        if (array_key_exists($type, $this->transformers)) {
            throw new RuntimeException(sprintf('Transformer for type %s is already registered.', $type));
        }

        $this->transformers[$type] = $transformer;
    }

    public function resolve(FormInterface $form): TypeTransformerInterface
    {
        $type = $form->getConfig()->getType()->getInnerType()::class;

        if (!array_key_exists($type, $this->transformers)) {
            throw new RuntimeException(sprintf('Transformer for type %s could not be found.', $type));
        }

        return $this->transformers[$type];
    }

    public function transform(FormInterface $form): array
    {
        $transformer = $this->resolve($form);

        return $transformer->transform($form);
    }
}
