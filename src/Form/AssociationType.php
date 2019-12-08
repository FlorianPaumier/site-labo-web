<?php

namespace App\Form;

use App\Entity\Association;
use App\Entity\Category;
use App\Entity\Rules;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AssociationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom"
            ])
            ->add('logoFile', VichImageType::class, [
                'label'             => 'Photo',
                'allow_delete'      => true,
                'download_label'    => "...",
                'download_uri'		=> true,
                'image_uri'         => true,
                'asset_helper'      => true,
                'data_class'        => null,
            ])
            ->add('description', CKEditorType::class,[
                "label" =>      "description",
                "required"          => false,
            ])
            ->add('president', EntityType::class, [
                "required" => false,
                "label" => "Président",
                "choice_label" => "name",
                "class" => User::class,
                "attr" => [
                    "class" => "select-js"
                ]
            ])
            ->add('assistant', EntityType::class, [
                "required" => false,
                "class" => User::class,
                "label" => "Assistant",
                "choice_label" => "name",
                "attr" => [
                    "class" => "select-js"
                ]
            ])
            ->add('category', EntityType::class, [
                "required" => false,
                "class" => Category::class,
                "label" => "Catégory",
                "attr" => [
                    "class" => "select-js"
                ]
            ])
            ->add('rules', EntityType::class, [
                "required" => false,
                "class" => Rules::class,
                "choice_label" => 'id',
                "label" => "Charte",
                "attr" => [
                    "class" => "select-js"
                ]
            ])
            ->add('participants', EntityType::class, [
                "required" => false,
                "multiple" => true,
                "class" => User::class,
                "label" => "Participants",
                "choice_label"=> "name",
                "attr" => [
                    "class" => "select-js"
                ]
            ])
            ->add("color", ColorType::class, [
                "label" => "Couleur",
                "required" => false,
                "attr" => [
                    "class" => "w-25"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }
}
