<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom Prénom",
                "required" => true,
            ])
            ->add('email', EmailType::class, [
                "label" => "Email",
                "required" => true,
            ])
            ->add('class', TextType::class, [
                "label" => "Classe",
                "required" => true,
            ])
            ->add("thumbnail", VichImageType::class, [
                "label" => "Photo de profile",
                "required" => false,
            ])
            ->add('point', IntegerType::class, [
                "label" => "Point Open",
                "attr" => [
                    "class" => "col-md-2 col-sm-10"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
