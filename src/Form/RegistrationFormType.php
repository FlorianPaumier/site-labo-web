<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                "attr" => [
                    "class" => "form-control form-control-user"
                ],
            ])
            /*->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])*/
            ->add("name", TextType::class, [
                "attr" => [
                    "class" => "form-control form-control-user"
                ],
                "label" => "Nom Prénom",
            ])
            ->add("class", TextType::class, [
                "attr" => [
                    "class" => "form-control form-control-user"
                ],
                "label" => "Classe"
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                "attr" => [
                    "class" => "form-control form-control-user"
                ],
                'mapped' => false,
                'first_options' => array(
                    'label' => 'Mot de passe',
                    "attr" => [
                        "class" => "form-control form-control-user"
                    ],
                ),
                'second_options' => array(
                    'label' => 'Confirmation mot de passe',
                    "attr" => [
                        "class" => "form-control form-control-user"
                    ],
                ),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
