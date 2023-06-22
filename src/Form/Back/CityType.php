<?php

namespace App\Form\Back;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $environment = [
            'mer' => 'dolorem',
            'montagne' => 'consequuntur',
            'ville' => 'deserunt',
            'campagne' => 'accusantium',
        ];

        $builder
            ->add('name', TextType::class,[
                "label" => "Nom de la ville",
                "attr" => [
                    "placeholder" => "Nom"
                ]
            ])
            ->add('country', EntityType::class, [
                "label" => "Pays",
                "multiple" => false,
                "expanded" => false,
                "class" => Country::class,
                "choice_label" => "name",
                'mapped' => false
            ])
            ->add('area', NumberType::class, [
                "label" => "Superficie de la ville en m²",
                "scale" => 2,
                "attr" => [
                    "placeholder" => "Superficie en m²"
                ]
            ])
            ->add('createdAt', DateType::class,[
                "label" => "Date d'ajout",
                "widget" => "single_text",
                "input" => "datetime"
            ])
            ->add('updateAt', DateType::class,[
                "label" => "Date de modification",
                "widget" => "single_text",
                "input" => "datetime"
            ])
            ->add('electricity', ChoiceType::class,[
                "label" => "Qualité du réseau électrique",
                "choices" => [
                    'Aucun' => "",
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ]
            ])
            ->add('internet', ChoiceType::class,[
                "label" => "Qualité du réseau Internet",
                "choices" => [
                    'Aucun' => "",
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ]
            ])
            ->add('sunshineRate', ChoiceType::class,[
                "label" => "Taux d'ensoleillement",
                "choices" => [
                    'Aucun' => "",
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ]
            ])
            ->add('temperatureAverage', NumberType::class, [
                "label" => "Température moyenne(°C)",
                "scale" => 2,
                "attr" => [
                    "placeholder" => "Température moyenne (°C)",
                    'min' => -50,  
                    'max' => 50,   
                ]
            ])
            ->add('cost', IntegerType::class, [
                "label" => "Coût de la vie(€)",                 
                "attr" => [
                "placeholder" => "Coût de la vie en €"
                ]
            ])
            ->add('language', LanguageType::class, [
                "label" => "langue",
                "multiple" => false,
                "expanded" => false,
            ])
            ->add('demography', IntegerType::class, [
                "label" => "Nombre d'habitants",
                "attr" => [
                    "placeholder" => "Nombre d'habitants"
                    ]
            ] )
            ->add('housing', ChoiceType::class,[
                "label" => "Niveau de logement",
                "choices" => [
                    'Aucun' => "",
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ]
            ])
            ->add('timezone', NumberType::class, [
                "label" => "Fuseau horaire",
                "attr" => [
                    "placeholder" => "N° GMT",
                    'min' => -12,  
                    'max' => 12,   
                ]
            ])
            ->add('environment', ChoiceType::class, [ 
                "label" => "Environnement",
                "choices" => [
                    $environment
                ],
                "expanded" => true,
                "multiple" => false, 
                ])
            ->add('images', EntityType::class, [
                "class" => Image::class,
                "choice_label" => "url",
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
