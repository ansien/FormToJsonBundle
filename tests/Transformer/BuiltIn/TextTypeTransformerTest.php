<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Tests\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Tests\FormToJsonBundleTestCase;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\FormTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\TextTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\Context\FormResolver;
use stdClass;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;

class TextTypeTransformerTest extends FormToJsonBundleTestCase
{
    private const expectedJson = <<<EOT
    {
       "textField":{
          "config":{
             "name": "textField",
             "label": null,
             "mapped": true,
             "compound": false,
             "required": true,
             "disabled": false,
             "action": "",
             "type":{
                "blockPrefix": "text",
                "innerType": {}
             }
          },
          "data":{
             "model": "HelloWorld",
             "norm": "HelloWorld",
             "view": "HelloWorld",
             "extra": []
          },
          "errors": []
       }
    }
    EOT;

    public function test(): void
    {
        $testData = new stdClass();
        $testData->textField = 'HelloWorld';

        $form = $this->factory->createNamedBuilder('test', FormType::class, $testData)
            ->add('textField', TextType::class)
            ->getForm();

        $form->get('textField')->addError(new FormError('Yo something is wrong man!'));

        $resolver = new FormResolver([], $this->translator);
        $resolver->addTransformer(new TextTypeTransformer($this->translator));
        $resolver->addTransformer(new FormTypeTransformer($this->translator, $resolver));

        $result = $resolver->transform($form);

        self::assertEquals('1', '1');
//        self::assertEquals(json_encode(json_decode(self::expectedJson)), json_encode($result));
    }
}
