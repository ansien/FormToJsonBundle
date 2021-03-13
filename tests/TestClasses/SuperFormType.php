<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Tests\TestClasses;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;
use Symfony\Component\Form\FormBuilderInterface;

class SuperFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Text
            ->add('text', TextType::class)
            ->add('textarea', TextareaType::class)
            ->add('email', EmailType::class)
            ->add('integer', IntegerType::class)
            ->add('money', MoneyType::class)
            ->add('number', NumberType::class)
            ->add('password', PasswordType::class)
            ->add('percent', PercentType::class)
            ->add('search', SearchType::class)
            ->add('url', UrlType::class)
            ->add('range', RangeType::class)
            ->add('tel', TelType::class)
            ->add('color', ColorType::class)
            // Choice
            ->add('choice', ChoiceType::class)
            ->add('country', CountryType::class)
            ->add('language', LanguageType::class)
            ->add('locale', LocaleType::class)
            ->add('timezone', TimezoneType::class)
            ->add('currency', CurrencyType::class)
            // DateTime
            ->add('date', DateType::class)
            ->add('dateInterval', DateIntervalType::class)
            ->add('dateTime', DateTimeType::class)
            ->add('time', TimeType::class)
            ->add('birthday', BirthdayType::class)
            ->add('week', WeekType::class)
            // Other
            ->add('checkbox', CheckboxType::class)
            ->add('file', FileType::class)
            ->add('radio', RadioType::class)
            // Group
            ->add('collection', CollectionType::class, [
                'allow_add' => true,
            ])
            ->add('repeated', RepeatedType::class, [
                'type' => PasswordType::class,
            ])
            // Hidden
            ->add('hidden', HiddenType::class)
            // Button
            ->add('button', ButtonType::class)
            ->add('reset', ResetType::class)
            ->add('submit', SubmitType::class)
        ;
    }
}
