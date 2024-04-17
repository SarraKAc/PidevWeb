<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbrEtoile', IntegerType::class, [
                'label' => 'Nombre d\'étoiles',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir le nombre d\'étoiles']),
                    new Range([
                        'min' => 1,
                        'max' => 5,
                        'minMessage' => 'Le nombre d\'étoiles doit être au moins {{ limit }}.',
                        'maxMessage' => 'Le nombre d\'étoiles ne peut pas être supérieur à {{ limit }}.',
                    ]),
                ],
            ])
            ->add('text', TextType::class, [
                'label' => 'Nombre d\'étoiles',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir un commentaire']),

                ]
            ])
            ->add('idService')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,'attr' => ['novalidate' => 'novalidate'], // Add this line to disable browser validation for every form

        ]);
    }
}
