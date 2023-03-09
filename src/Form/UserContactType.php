<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'empty_data' => '',
                'required' => true, 
                'trim' => true,
                'label' => 'Identifiant *',
                'attr' => ['class'=> ''],
                'constraints' => [
                        new NotBlank([
                            'message' => 'Le nom est obligatoire',
                        ]),
                        new Length([
                            'max' => 180,
                            'maxMessage' => 'Le nom doit contenir moins de {{ limit }} caractères'
                        ])
                    ]
                ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe *',
                'required' => true, 
                //hash the password
                'hash_property_path' => 'password',
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe est obligatoire',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit contenir plus de {{ limit }} caractères',
                    ])
                ]
            ])
            ->add('position_company', TextType::class, [
                'empty_data' => '',
                'required' => false, 
                'trim' => true,
                'label' => 'Poste',
            ])
            ->add('picture')
            ->add('contact', ContactType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}