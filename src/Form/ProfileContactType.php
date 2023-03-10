<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class ProfileContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true, 
                'trim' => true,
                'label' => 'E-mail *',
                'attr' => ['class'=> ''],
                'constraints' => [
                    new Email([
                        'message' => 'L\'e-mail n\'est pas valide'
                    ]),
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'L\'e-mail doit contenir moins de {{ limit }} caractères'
                    ])
                ],
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'trim' => true,
                'label' => 'Téléphone',
                'attr' => ['class'=> ''],
                'constraints' => [
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Le téléphone doit contenir moins de {{ limit }} caractères'
                    ])
                ],
            ])
            ->add('address', TextType::class, [
                'required' => false,
                'trim' => true,
                'label' => 'Adresse',
                'attr' => ['class'=> ''],
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'L\'adresse doit contenir moins de {{ limit }} caractères'
                    ])
                ],
            ])
            ->add('zip_code', TextType::class, [
                'required' => false,
                'trim' => true,
                'label' => 'Code postal',
                'attr' => ['class'=> ''],
                'constraints' => [
                    new Length([
                        'max' => 20,
                        'maxMessage' => 'Le code postal de l\'entreprise doit contenir moins de {{ limit }} caractères'
                    ])
                ],
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'trim' => true,
                'label' => 'Ville',
                'attr' => ['class'=> ''],
                'constraints' => [
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'La ville doit contenir moins de {{ limit }} caractères'
                    ])
                ],
            ])
            ->add('country', TextType::class, [
                'required' => false,
                'trim' => true,
                'label' => 'Pays',
                'attr' => ['class'=> ''],
                'constraints' => [
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'Le pays doit contenir moins de {{ limit }} caractères'
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
