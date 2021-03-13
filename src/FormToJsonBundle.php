<?php

namespace Ansien\FormToJsonBundle;

use Ansien\FormToJsonBundle\DependencyInjection\CompilerPass\TransformerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FormToJsonBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new TransformerCompilerPass());
    }
}
