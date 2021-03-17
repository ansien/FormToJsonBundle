<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Normalizer\FormErrorsNormalizer;
use Ansien\FormToJsonBundle\Normalizer\FormValuesNormalizer;
use Ansien\FormToJsonBundle\Transformer\Service\FormTransformerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @see https://symfony.com/doc/current/reference/forms/types/form.html
 */
class FormTypeTransformer extends AbstractTypeTransformer
{
    public function __construct(
        protected TranslatorInterface $translator,
        protected FormTransformerInterface $formTransformer,
    ) {
    }

    public function transform(FormInterface $form): array
    {
        $schema = [];

        $formView = $form->createView();

        $schema['schema'] = $this->hydrateBasicOptions($formView, $schema);

        foreach ($form->all() as $key => $childForm) {
            $schema['schema']['children'][$key] = $this->formTransformer->transform($childForm);
        }

        $valuesNormalizer = [new FormValuesNormalizer()];
        $valuesSerializer = new Serializer($valuesNormalizer);
        $schema['values'] = $valuesSerializer->normalize($form);

        $errorsNormalizer = [new FormErrorsNormalizer($this->translator)];
        $errorsSerializer = new Serializer($errorsNormalizer);
        $schema['errors'] = $errorsSerializer->normalize($form);

        return $schema;
    }

    public static function getBlockPrefix(): string
    {
        return 'form';
    }
}
