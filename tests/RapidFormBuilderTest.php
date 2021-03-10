<?php

declare(strict_types=1);

namespace Ansien\RapidFormBundle\Tests\Form;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\FormTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\TextTransformer;
use Ansien\FormToJsonBundle\Transformer\Context\FormResolver;
use stdClass;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Test\FormIntegrationTestCase;

class RapidFormBuilderTest extends FormIntegrationTestCase
{
    public function testTextTransformer(): void
    {
        $testData = new stdClass();
        $testData->testText = '123';

        $form = $this->factory->createNamedBuilder('test', FormType::class, $testData)
            ->add('testText', TextType::class)
            ->getForm();

        $resolver = new FormResolver();
        $resolver->addTransformer(new TextTransformer());
        $resolver->addTransformer(new FormTransformer($resolver));

        $result = $resolver->transform($form);

        dump($result);
        exit;
    }
}
