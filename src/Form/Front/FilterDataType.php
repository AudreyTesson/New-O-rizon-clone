<?php

namespace App\Form\Front;

use App\Data\FilterData;
use App\Entity\Country;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

        $environment = [
            'mer' => 'dolorem',
            'montagne' => 'consequuntur',
            'ville' => 'deserunt',
            'campagne' => 'atque',
        ];

        $builder
            ->add('country', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Country::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => false,
                'placeholder' => 'Sélectionner', 'required' => true,
            ])
            
            ->add('electricityLevel', ChoiceType::class, [
                'choices' => [
                    'Aucun' => "",
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
            ->add('temperatureMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min °C',
                    'class' => 'text-sm w-20',
                ]
            ])
            ->add('temperatureMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max °C',
                    'class' => 'text-sm w-20',
                ]
            ])
            ->add('demographyMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min',
                    'class' => 'text-sm w-20',
                ]
            ])
            ->add('demographyMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max',
                    'class' => 'text-sm w-20',
                ]
            ])
            ->add('costMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min',
                    'class' => 'text-sm w-20',
                ]
            ])
            ->add('costMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max',
                    'class' => 'text-sm w-20',
                ]
            ])
            ->add('areaMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min km²',
                    'class' => 'text-sm w-20',
                ]
            ])
            ->add('areaMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max km²',
                    'class' => 'text-sm w-20',
                ]
            ])
            ->add('currencyType', CurrencyType::class, [
                "choices" => [
                    "expanded" => true, 
                    "multiple" => false],
                    'label' => false,
                    'placeholder' => 'Sélectionner', 'required' => true,
            ])
            ->add('timezone', NumberType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'N° GMT',
                    'class' => 'text-sm w-20',
                ],
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
                    'placeholder' => 'Sélectionner', 'required' => true,
            ])
            ->add('environment', ChoiceType::class, [ 
                "choices" => [
                    $environment
                    ],
                "expanded" => true,
                "multiple" => false,
                'label' => false,
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