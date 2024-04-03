<?php

namespace App\Form;

use App\Entity\ReserverEvent;
use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ReserverEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('nbr_personne')
            ->add('date_reservation')
            ->add('email')
            
            /*->add('evenement', EntityType::class, [
                'class' => ReserverEvent::class,
                'choice_label' => 'nom' // Assuming 'id' is a meaningful property of Etablissement
                
        
                ])*/
                ->add('evenement', EntityType::class, [
                    'class' => Evenement::class,
                    'choice_label' => 'nom', // Assuming 'nom' is the property you want to display in the dropdown
                ])
                
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReserverEvent::class,
        ]);
    }
}
