<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TestCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $contextDefinition = $container->findDefinition('Ansien\FormToJsonBundle\Transformer\Context\TransformerContext');

        $serviceIds = array_keys(
            $container->findTaggedServiceIds('form_to_json_bundle.type_transformer')
        );

        foreach ($serviceIds as $serviceId) {
            $contextDefinition->addMethodCall(
                'addTransformer',
                [new Reference($serviceId)]
            );
        }
    }
}
