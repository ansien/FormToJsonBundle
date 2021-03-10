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
use Symfony\Component\Form\FormError;

class RapidFormBuilderTest extends FormToJsonBundleTestCase
{
    public function testTextTransformer(): void
    {
        $testData = new stdClass();
        $testData->textField = 'HelloWorld';
        $testData->textareaField = 'Hello World !';
        $testData->emailField = 'hello@world.com';
        $testData->integerField = 1;
        $testData->moneyField = '0.00';
        $testData->numberField = '0.00';
        $testData->passwordField = 'hunter2';
        $testData->percentField = '0.5';

        $form = $this->factory->createNamedBuilder('test', FormType::class, $testData)
            ->add('textField', TextType::class)
            ->add('textareaField', TextareaType::class)
            ->add('emailField', EmailType::class)
            ->add('integerField', IntegerType::class)
            ->getForm();

        $form->get('textField')->addError(new FormError('Something is broken!'));

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
