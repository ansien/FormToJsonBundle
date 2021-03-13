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

    abstract public function transform(FormInterface $form, FormView $formView): array;

    abstract public static function getForBlockPrefix(): string;

    protected function hydrateBasicOptions(FormView $formView, array $schema): array
    {
        $schema['id'] = $formView->vars['id'];
        $schema['name'] = $formView->vars['name'];
        $schema['full_name'] = $formView->vars['full_name'];
        $schema['label'] = $formView->vars['label'];
        $schema['block_prefixes'] = $formView->vars['block_prefixes'];
        $schema['unique_block_prefix'] = $formView->vars['unique_block_prefix'];
        $schema['valid'] = $formView->vars['valid'];
        $schema['data'] = $formView->vars['data'];
        $schema['value'] = $formView->vars['value'];
        $schema['required'] = $formView->vars['required'];
        $schema['help'] = $formView->vars['help'];
        $schema['compound'] = $formView->vars['compound'];
        $schema['method'] = $formView->vars['method'];
        $schema['action'] = $formView->vars['action'];
        $schema['submitted'] = $formView->vars['submitted'];

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

        foreach ($formView->vars['errors'] as $error) {
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
