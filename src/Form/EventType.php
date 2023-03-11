<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class, [
                'empty_data' => '',
                'required' => true, 
                'trim' => true,
                'label' => 'Titre *',
                'attr' => ['class'=> ''],
                'constraints' => [
                        new NotBlank([
                            'message' => 'Le titre est obligatoire',
                        ]),
                        new Length([
                            'max' => 255,
                            'maxMessage' => 'Le titre doit contenir moins de {{ limit }} caractères'
                        ])
                    ]
                ])
            ->add('date_start', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Début'
                ])
            ->add('date_end', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Fin'
                ])
            ->add('all_day', CheckboxType::class, [
                'label' => 'Toute la journée ?',
                'required' => false
                ])
            ->add('description',TextareaType::class, [
                'required' => false, 
                'trim' => true,
                'label' => 'Description',
                'attr' => ['class'=> '']
                ])
            ->add('location', TextType::class, [
                'required' => false, 
                'trim' => true,
                'label' => 'Emplacement',
                'attr' => ['class'=> ''],
                'constraints' => [
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'L\'emplacement doit contenir moins de {{ limit }} caractères'
                        ])
                    ]
                ])
            ->add('background_color', ColorType::class, [
                    'required' => false,
                    'label' => 'Couleur',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
