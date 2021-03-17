<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Normalizer;

use Ansien\FormToJsonBundle\Util\FormUtil;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FormValuesNormalizer implements NormalizerInterface
{
    public function normalize(mixed $form, $format = null, array $context = [])
    {
        $formView = $form->createView();

        return $this->getValues($form, $formView);
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Form;
    }

    private function getValues(FormInterface $form, FormView $formView)
    {
        if (!empty($formView->children)) {
            if (in_array('choice', FormUtil::typeAncestry($form)) &&
                $formView->vars['expanded']
            ) {
                if ($formView->vars['multiple']) {
                    return $this->normalizeMultipleExpandedChoice($formView);
                } else {
                    return $this->normalizeExpandedChoice($formView);
                }
            }

            $data = (object) [];
            foreach ($formView->children as $name => $child) {
                if ($form->has((string) $name)) {
                    $data->{$name} = $this->getValues($form->get((string) $name), $child);
                }
            }

            return (array) $data;
        } else {
            if (isset($formView->vars['checked'])) {
                return $formView->vars['checked'];
            }

            return $formView->vars['value'];
        }
    }

    private function normalizeMultipleExpandedChoice(FormView $formView): array
    {
        $data = [];
        foreach ($formView->children as $name => $child) {
            if ($child->vars['checked']) {
                $data[] = $child->vars['value'];
            }
        }

        return $data;
    }

    private function normalizeExpandedChoice(FormView $formView)
    {
        foreach ($formView->children as $name => $child) {
            if ($child->vars['checked']) {
                return $child->vars['value'];
            }
        }

        return null;
    }
}
