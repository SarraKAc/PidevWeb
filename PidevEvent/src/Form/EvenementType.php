<?php



namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Webinaires' => 'Webinaires',
                    'Cours en ligne' => 'Cours en ligne',
                    'Séminaires virtuels' => 'Séminaires virtuels',
                    'Tutoriels' => 'Tutoriels',
                    'Sessions de formation' => 'Sessions de formation',
                    'Conférences virtuelles' => 'Conférences virtuelles',
                    'Workshops en ligne' => 'Workshops en ligne',
                    'Sessions de coaching' => 'Sessions de coaching',
                    'Forums de discussion' => 'Forums de discussion',
                    'Événements de réseautage académique' => 'Événements de réseautage académique',
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('date')
            ->add('prix')
            
            ->add('CheminImage', null, [
                'attr' => [
                    'class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Image Name',
                    'readonly' => true // Ajouter cette ligne pour rendre le champ en lecture seule

                ]
            ])
            ;
        ;
    }

    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
