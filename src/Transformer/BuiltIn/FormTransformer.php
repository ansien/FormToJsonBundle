<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Transformer\Context\FormResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;

class FormTransformer extends AbstractTransformer
{
    private FormResolver $resolver;

    public function __construct(FormResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function transform(FormInterface $form): array
    {
        $data = [];

        foreach ($form->all() as $name => $field) {
            $transformer = $this->resolver->resolve($field);
            $data[$name] = $transformer->transform($field);
        }

        return $data;
    }

    public static function getType(): string
    {
        return FormType::class;
    }
}
