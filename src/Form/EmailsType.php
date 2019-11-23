<?php

namespace App\Form;

use App\Entity\Emails;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',  TextType::class, [
                "attr" => [
                    "class" => "form-control",
                ],
            ])
            ->add('body', CKEditorType::class, [
                "attr" => [
                    "style" => "min-height:30vh;"
                ]
            ])
            ->add('dest', EntityType::class, [
                "class" => User::class,
                "choice_label" => "name",
                "attr" => [
                    "class" => "select-js form-control",
                ],
                "multiple" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emails::class,
        ]);
    }
}
