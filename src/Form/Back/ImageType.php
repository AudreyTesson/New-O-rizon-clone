<?php

namespace App\Form\Back;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', UrlType::class, [
                "label" => "Image de ville ou de pays",
                "attr" => [
                    "placeholder" => "https://...",
                ]
            ])
            ->add('city', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => City::class,
                "choice_label" => "name",
            ])
            ->add('country', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Country::class,
                "choice_label" => "name",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
