<?php

namespace App\Form;

use App\Entity\ReserverEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserverEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idEvenement')
            ->add('idUser')
            ->add('nom')
            ->add('nbrPersonne')
            ->add('dateReservation')
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReserverEvent::class,
        ]);
    }
}
