<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Normalizer;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class FormErrorsNormalizer implements NormalizerInterface
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function normalize(mixed $form, $format = null, array $context = []): array
    {
        return $this->getErrors($form);
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Form;
    }

    private function getErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            if ($form->getParent() === null) {
                $errors['_global'][] = $error->getMessage();
            } else {
                $translateResult = $this->translator->trans($error->getMessage(), $error->getMessageParameters());

                if ($translateResult) {
                    $errors[] = $translateResult;
                } else {
                    $errors[] = $error->getMessage();
                }
            }
        }

        foreach ($form->all() as $childForm) {
            if (($childForm instanceof FormInterface) && $childErrors = $this->getErrors($childForm)) {
                if (count($childErrors) > 0) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}
