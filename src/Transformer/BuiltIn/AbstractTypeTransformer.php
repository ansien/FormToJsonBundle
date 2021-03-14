<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Transformer\TypeTransformerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractTypeTransformer implements TypeTransformerInterface
{
    protected TranslatorInterface $translator;

    abstract public function transform(FormInterface $form): array;

    abstract public static function getBlockPrefix(): string;

    protected function hydrateBasicOptions(FormView $formView, array $schema): array
    {
        $schema['id'] = $formView->vars['id'] ?? null;
        $schema['name'] = $formView->vars['name'] ?? null;
        $schema['label'] = $formView->vars['label'] ?? null;
        $schema['unique_block_prefix'] = $formView->vars['unique_block_prefix'] ?? null;
        $schema['value'] = $formView->vars['value'] ?? null;
        $schema['required'] = $formView->vars['required'] ?? null;
        $schema['help'] = $formView->vars['help'] ?? null;
        $schema['compound'] = $formView->vars['compound'] ?? null;
        $schema['method'] = $formView->vars['method'] ?? null;
        $schema['action'] = $formView->vars['action'] ?? null;
        $schema['attr'] = $formView->vars['attr'] ?? null;

        return $schema;
    }

    protected function hydrateExtraOptions(FormInterface $form, array $schema, array $options): array
    {
        $config = $form->getConfig();

        $schema['options'] = [];

        foreach ($options as $option) {
            $schema['options'][$option] = $config->getOption($option);
        }

        return $schema;
    }

    protected function hydrateErrors(FormView $formView, array $schema): array
    {
        $schema['errors'] = [];

        foreach ($formView->vars['errors'] ?? [] as $error) {
            $translateResult = $this->translator->trans($error->getMessage(), $error->getMessageParameters());
            if ($translateResult !== null) {
                $schema['errors'][] = $translateResult;
            } else {
                $schema['errors'][] = $error->getMessage();
            }
        }

        return $schema;
    }
}
