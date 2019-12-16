<?php

namespace App\Form;

use App\Entity\Association;
use App\Entity\Sondage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SondageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enable', CheckboxType::class, [
                "label" => "Activer ?",
            ])
            ->add('name', TextType::class, [
                "label" => "Nom",
            ])
            ->add('association', EntityType::class, [
                "label" => "Association",
                "class" => Association::class,
                "choice_label" => "name",
            ])
            ->add("sondageQuestions", CollectionType::class, [
                "entry_type" => SondageQuestionType::class,
                "allow_delete" => true,
                "allow_add" => true,
                "prototype" => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sondage::class,
        ]);
    }
}
