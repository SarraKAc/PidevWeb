<?php



namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('CheminImage')
        ;
    }

    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
