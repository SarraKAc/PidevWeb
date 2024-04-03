<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Type;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomService')
            ->add('titreService')
            ->add('prix', NumberType::class, [
                'invalid_message' => 'Le prix doit être un nombre entier.',
                'attr' => [
                    'placeholder' => 'Prix'
                ],
            ])
            ->add('tmpservice')
            ->add('domaine', ChoiceType::class, [
                'choices' => [
                    'Programmation' => 'Programmation',
                    'Réseau' => 'Réseau',
                    'Langue' => 'Langue',
                    'Commerce' => 'Commerce',
                    'Programme BAC' => 'Programme BAC',

                ],
            ])
            ->add('img', FileType::class, [
                'label' => 'Image (JPEG, PNG, GIF)',
                'mapped' => false, // Don't map this field to any property of the entity
                'required' => false, // Allow the field to be empty
            ])

            ->add('idUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
