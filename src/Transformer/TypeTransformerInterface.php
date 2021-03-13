<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

interface TypeTransformerInterface
{
    public function transform(FormInterface $form, FormView $formView): array;

    public static function getForBlockPrefix(): string;
}
