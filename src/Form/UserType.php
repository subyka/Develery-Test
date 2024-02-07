<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, options: [
                'label' => 'Név:',
                'label_attr' => [
                    'class' => 'fs-6'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Hiba! Kérjük töltsd ki az összes mezőt!',
                    ]),
                ],
                'required' => false,
                ])
                ->add('plainPassword', RepeatedType::class, [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'type' => PasswordType::class,
                    'required' => false,
                    'first_options' => ['label' => 'Jelszó:'],
                    'second_options' => ['label' => 'Jelszó újra:'],
                    'mapped' => false,
                    'attr' => ['autocomplete' => 'new-password'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Kérlek írj be egy jelszót!',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'A jelszó minimum {{ limit }} karakter kell legyen!',
                            'max' => 30,
                            'maxMessage' => 'A jelszó maximum {{ limit }} karakter hosszú lehet!',
                        ]),
                    ],
                ]);

    }

    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefault('data_class', User::class);
        
    }
}
