<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomService')
            ->add('titreService')
            ->add('prix')
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
            ->add('img')

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
