<?php

namespace App\Form\Front;


use App\Entity\Country;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
        ;          
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
            'method' => 'GET',
        ]);
    }
}