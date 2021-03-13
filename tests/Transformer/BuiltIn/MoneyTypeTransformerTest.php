<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Tests\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Tests\FormToJsonBundleTestCase;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\FormTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\MoneyTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\Context\FormResolver;
use stdClass;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class MoneyTypeTransformerTest extends FormToJsonBundleTestCase
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
        $testData->moneyField = '1.00';

        $form = $this->factory->createNamedBuilder('test', FormType::class, $testData)
            ->add('moneyField', MoneyType::class)
            ->getForm();

        $resolver = new FormResolver([], $this->translator);
        $resolver->addTransformer(new MoneyTypeTransformer($this->translator));
        $resolver->addTransformer(new FormTypeTransformer($this->translator, $resolver));

        $result = $resolver->transform($form);

        self::assertEquals('1', '1');
    }
}
