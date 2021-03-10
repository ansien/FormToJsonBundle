<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Transformer\TypeTransformerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractTypeTransformer implements TypeTransformerInterface
{
    protected TranslatorInterface $translator;

    abstract public function transform(FormInterface $form): array;

    abstract public static function getType(): string;

    protected function hydrateConfig(FormInterface $form, array $schema): array
    {
        $config = $form->getConfig();

        $schema['config']['name'] = $config->getName();
        $schema['config']['label'] = $this->getLabel($form);
        $schema['config']['mapped'] = $config->getMapped();
        $schema['config']['compound'] = $config->getCompound();
        $schema['config']['required'] = $config->getRequired();
        $schema['config']['disabled'] = $config->getDisabled();
        $schema['config']['action'] = $config->getAction();
        $schema['config']['type'] = [
            'blockPrefix' => $config->getType()->getBlockPrefix(),
            'innerType' => $config->getType()->getInnerType(),
        ];
        $schema['config']['option'] = [
            'attr' => $form->getConfig()->getOption('attr'),
        ];

        return $schema;
    }

    protected function hydrateValues(FormInterface $form, array $schema): array
    {
        $schema['data'] = [
            'model' => $form->getData(),
            'norm' => $form->getNormData(),
            'view' => $form->getViewData(),
            'extra' => $form->getExtraData(),
        ];

        return $schema;
    }

    protected function hydrateErrors(FormInterface $form, array $schema): array
    {
        if (!array_key_exists('errors', $schema)) {
            $schema['errors'] = [];
        }

        foreach ($form->getErrors() as $error) {
            $schema['errors'] = $this->translator->trans($error->getMessage(), $error->getMessageParameters());
        }

        return $schema;
    }

    protected function getLabel(FormInterface $form): ?string
    {
        $translationDomain = $form->getConfig()->getOption('translation_domain');

        if ($label = $form->getConfig()->getOption('label')) {
            return $this->translator->trans($label, [], $translationDomain);
        } else {
            return $this->translator->trans($form->getName(), [], $translationDomain);
        }
    }

    protected function getDescription(FormInterface $form): ?string
    {
        $formConfig = $form->getConfig();

        if ($help = $formConfig->getOption('help', '')) {
            return $this->translator->trans($help);
        }

        return null;
    }
}
