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
        $blockPrefixes = $formView->vars['block_prefixes'];
        $type = $blockPrefixes[count($blockPrefixes) - 2];

        $schema['id'] = $formView->vars['id'] ?? null;
        $schema['name'] = $formView->vars['name'] ?? null;
        $schema['type'] = $type;
        $schema['disabled'] = $formView->vars['disabled'] ?? null;
        $schema['label'] = $formView->vars['label'] ?? null;
        $schema['label_format'] = $formView->vars['label_format'] ?? null;
        $schema['label_html'] = $formView->vars['label_html'] ?? null;
        $schema['multipart'] = $formView->vars['multipart'] ?? null;
        $schema['unique_block_prefix'] = $formView->vars['unique_block_prefix'] ?? null;
        $schema['row_attr'] = $formView->vars['row_attr'] ?? null;
        $schema['translation_domain'] = $formView->vars['translation_domain'] ?? null;
        $schema['label_translation_parameters'] = $formView->vars['label_translation_parameters'] ?? null;
        $schema['attr_translation_parameters'] = $formView->vars['attr_translation_parameters'] ?? null;
        $schema['valid'] = $formView->vars['valid'] ?? null;
        $schema['value'] = $formView->vars['value'] ?? null;
        $schema['required'] = $formView->vars['required'] ?? null;
        $schema['size'] = $formView->vars['size'] ?? null;
        $schema['label_attr'] = $formView->vars['label_attr'] ?? null;
        $schema['help'] = $formView->vars['help'] ?? null;
        $schema['help_attr'] = $formView->vars['help_attr'] ?? null;
        $schema['help_html'] = $formView->vars['help_html'] ?? null;
        $schema['help_translation_parameters'] = $formView->vars['help_translation_parameters'] ?? null;
        $schema['compound'] = $formView->vars['compound'] ?? null;
        $schema['method'] = $formView->vars['method'] ?? null;
        $schema['action'] = $formView->vars['action'] ?? null;
        $schema['submitted'] = $formView->vars['submitted'] ?? null;
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
