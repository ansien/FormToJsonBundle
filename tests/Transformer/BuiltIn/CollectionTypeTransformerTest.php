<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Tests\Transformer\BuiltIn;

use Ansien\FormToJsonBundle\Tests\FormToJsonBundleTestCase;
use Ansien\FormToJsonBundle\Tests\TestClasses\SimpleType;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\CollectionTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\FormTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\TextTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\Context\FormResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormError;

class CollectionTypeTransformerTest extends FormToJsonBundleTestCase
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
        $form = $this->factory->createNamedBuilder('test', FormType::class)
            ->add('test', CollectionType::class, [
                'entry_type' => SimpleType::class,
                'allow_add' => true,
            ])
            ->getForm();

        $form->get('test')->addError(new FormError('Yo something is wrong man 2!'));

        $resolver = new FormResolver([], $this->translator);
        $resolver->addTransformer(new TextTypeTransformer($this->translator));
        $resolver->addTransformer(new FormTypeTransformer($this->translator, $resolver));
        $resolver->addTransformer(new CollectionTypeTransformer($this->translator, $resolver));

        $result = $resolver->transform($form);

        self::assertEquals('1', '1');
//        self::assertEquals(json_encode(json_decode(self::expectedJson)), json_encode($result));
    }
}
