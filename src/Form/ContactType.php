<?php

declare(strict_types=1);

namespace App\Form;

use App\DTO\MessageDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, options: [
                'label' => 'Neved:',
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
            ->add('email', EmailType::class, options: [
                'label' => 'Email címed:',
                'required' => false,
                'constraints' => [
                    new Email([
                        'message' => 'Hiba! Kérjük e-mail címet adjál meg!',
                    ]),
                    new NotBlank([
                        'message' => 'Hiba! Kérjük töltsd ki az összes mezőt!',
                    ]),
                    
                ],
                'label_attr' => [
                    'class' => 'fs-6'
                    ],
                ])
            ->add('message', TextareaType::class, options: [
                'label' => 'Üzenet szövege:',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Hiba! Kérjük töltsd ki az összes mezőt!',
                    ]),
                ],
                'label_attr' => [
                    'class' => 'fs-6'
                ],
                ]);

    }

    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefault('data_class', MessageDTO::class);
        
    }
}
