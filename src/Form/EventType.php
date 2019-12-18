<?php

namespace App\Form;

use App\Entity\Association;
use App\Entity\Event;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                "label" => "Nom :",
            ])
            ->add('publishedAt', DateType::class, [
                "label" => "Publication le :",
            ])
            ->add('happensAt',DateType::class, [
                "label" => "Ce passe le : ",
            ])
            ->add('description', CKEditorType::class, [
                "label" => "Description : "
            ])
            ->add('place', TextType::class, [
                "label" => "Emplacement : ",
            ])
            ->add('association', EntityType::class, [
                "class" => Association::class,
                "label" => "Association",
                "choice_label" => "name",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
