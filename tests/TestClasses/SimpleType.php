<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Tests\TestClasses;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('task1', TextType::class)
            ->add('task2', TextType::class)
        ;
    }
}
