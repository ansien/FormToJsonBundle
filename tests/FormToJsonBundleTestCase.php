<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Contracts\Translation\TranslatorInterface;

class FormToJsonBundleTestCase extends TestCase
{
    protected FormFactoryInterface $factory;
    protected TranslatorInterface $translator;

    protected function setUp(): void
    {
        $this->factory = Forms::createFormFactoryBuilder()->getFormFactory();
        $this->translator = $this->getMockBuilder(TranslatorInterface::class)->getMock();
    }
}
