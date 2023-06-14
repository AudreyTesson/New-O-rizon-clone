<?php

namespace App\Form;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        $builder 
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Villes, pays...'
                ]
            ])
            ->add('name')
            ->add('area')
            ->add('createdAt')
            ->add('updateAt')
            ->add('electricity')
            ->add('internet')
            ->add('sunshineRate')
            ->add('temperatureAverage')
            ->add('cost')
            ->add('language')
            ->add('demography')
            ->add('housing')
            ->add('timezone')
            ->add('environment')
            ->add('country')
            ->add('users', EntityType::class, [
                "multiple" => true,
                "expanded" => true,
                "class" => User::class,
                'choice_label' => 'name'
            ])
            ->add('country', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Country::class, 
                'choice_label' => 'name'
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
