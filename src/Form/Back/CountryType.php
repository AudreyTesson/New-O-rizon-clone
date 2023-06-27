<?php

namespace App\Form\Back;

use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $visas = [
            'Visa touriste' => 'excepturi',
            'Visa nomade' => 'maxime',
            'Virtual Working Program'=> 'fuga',
            'Spécial Tourist Visa' => 'qui',
            'Welcome Stamp' => 'repellendus',
            'Residencia Temporal Empleados Especializados por cuenta propia' => 'repudiandae',
            'Work From Bermuda' => 'veniam',
            'Long-term visa for remote workers and family' => 'voluptatum',
            'e-Visa' => 'sint',
            'Antigua Nomad Digital Residence' => 'quas',
            'Global Citizen Concierge' => 'quos',
            'visa Premium' => 'maxime',
        ];

        $builder
        ->add('name', TextType::class,[
            "label" => "Nom du pays",
            "attr" => [
                "placeholder" => "Nom"
            ]
        ])
            ->add('visa', ChoiceType::class, [
                "label" => "Visa",
                "choices" => [
                    $visas
                ],
                "multiple" => false,
                "expanded" => true,
            ])
            ->add('visaIsRequired', CheckboxType::class, [
                "label" => "Visa Requis",
                "required" => false,
            ])
            ->add('currency', CurrencyType::class, [
                "label" => "Devise",
                "multiple" => false,
                "expanded" => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
