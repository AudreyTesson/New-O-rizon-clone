<?php

namespace App\Form\Front;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchCityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('city', TextType::class, [
               'label' => false,
               'class' => City::class,
               'attr' => [
                   'placeholder' => 'Ville que vous désirez rechercher',
                   'autocomplete' => true,
               ],
               'choice_label' => 'name',

           ]);
        /* $builder
            ->add('city', EntityType::class, [
                'label' => false,
                'attr' => [
                    'class' => City::class,
                    'placeholder' => 'Ville que vous désirez rechercher',
                    'autocomplete' => true,
                ]
            ]); */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
