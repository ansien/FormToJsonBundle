<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Tests;

use Ansien\FormToJsonBundle\Transformer\BuiltIn\EmailTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\FormTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\IntegerTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\TextareaTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\TextTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\Context\FormResolver;
use stdClass;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RapidFormBuilderTest extends FormToJsonBundleTestCase
{
    public function testTextTransformer(): void
    {
        $testData = new stdClass();
        $testData->text = 'HelloWorld';
        $testData->textarea = 'Hello World !';
        $testData->email = 'hello@world.com';
        $testData->integer = 1;
        $testData->money = '0.00';
        $testData->number = '0.00';
        $testData->password = 'hunter2';
        $testData->percent = '0.5';

        $form = $this->factory->createNamedBuilder('test', FormType::class, $testData)
            ->add('text', TextType::class)
            ->add('textarea', TextareaType::class)
            ->add('email', EmailType::class)
            ->add('integer', IntegerType::class)
            ->getForm();

        $resolver = new FormResolver();
        $resolver->addTransformer(new TextTypeTransformer($this->translator));
        $resolver->addTransformer(new TextareaTypeTransformer($this->translator));
        $resolver->addTransformer(new EmailTypeTransformer($this->translator));
        $resolver->addTransformer(new IntegerTypeTransformer($this->translator));
        $resolver->addTransformer(new FormTypeTransformer($resolver));

        $result = $resolver->transform($form);

        dump($result);
        exit;
    }
}
