<?php

namespace App\Form\Front;

use App\Data\FilterData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $visas = [
            'Visa touriste' => 'illum',
            'Visa nomade' => 'molestiae',
            'Virtual Working Program'=> 'eum',
            'Spécial Tourist Visa' => 'pariatur',
            'Welcome Stamp' => 'temporibus',
            'Residencia Temporal Empleados Especializados por cuenta propia' => 'rerum',
            'Work From Bermuda' => 'suscipit',
            'Long-term visa for remote workers and family' => 'assumenda',
            'e-Visa' => 'eaque',
            'Antigua Nomad Digital Residence' => 'atque',
            'Global Citizen Concierge' => 'est',
            'visa Premium' => 'hic',
        ];

        $environment = [
            'mer' => 'aspernatur',
            'montagne' => 'consequuntur',
            'ville' => 'architecto',
            'campagne' => 'aliquid',
        ];

        $builder
            ->add('electricityLevel', ChoiceType::class, [
                'choices' => [
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ],
                'label' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('internetLevel', ChoiceType::class, [
                'choices' => [
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ],
                'label' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('sunshineLevel', ChoiceType::class, [
                'choices' => [
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ],
                'label' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('housingLevel', ChoiceType::class, [
                'choices' => [
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ],
                'label' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ])
            //  TODO : try setting a slider range option to replace temperature field
            ->add('temperature', RangeType::class, [
                'attr' => [
                    'min' => -50,
                    'max' => 50
                ],
            ])
            ->add('temperatureMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'température min'
                ]
            ])
            ->add('temperatureMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'température max'
                ]
            ])
            ->add('demographyMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Population min'
                ]
            ])
            ->add('demographyMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Population max'
                ]
            ])
            ->add('costMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Coût de la vie min'
                ]
            ])
            ->add('costMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Coût de la vie max'
                ]
            ])
            ->add('currencyType', CurrencyType::class, [
                "choices" => [
                    "expanded" => true, 
                    "multiple" => false],
                    'label' => false,
            ])
            ->add('timezone', RangeType::class, [
                'attr' => [
                    'min' => -12,
                    'max' => 12
                ],
                'label' => false,
            ])
            ->add('visaType', ChoiceType::class, [ 
                "choices" => [
                    $visas
                    ],
                "expanded" => true,
                "multiple" => false,
                'label' => false,
            ])
            ->add('visaRequired', CheckboxType::class, [
                "label" => "Visa Requis",
                "required" => false,
            ])
            ->add('language', LanguageType::class, [
                "choices" => [
                    "expanded" => false, 
                    "multiple" => false],
                    'label' => false,
            ])
            ->add('environment', ChoiceType::class, [ 
                "choices" => [
                    $environment
                    ],
                "expanded" => true,
                "multiple" => true,
                'label' => false,
                'help' => '(plusieurs choix possible)'
            ])
        ;          
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterData::class,
            'method' => 'GET',
        ]);
    }
}