<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Loyer;
use App\Repository\LocationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoyerType extends AbstractType
{
    /**
     * @var LocationRepository
     */
    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mois', ChoiceType::class, [
                'choices' => $this->getMonths(),
            ])
            ->add('etat', CheckboxType::class, [
                'label' => 'Payé',
                'required' => false
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choices' => $this->locationRepository->findBy(['archived' => false]),
                'choice_label' => 'nom',
                'required' => true,
                'multiple' => false,
            ])
        ;
    }


    private function getMonths(): array
    {
        $year = (int) (new \DateTime())->format('Y');
        $months = [
            'Janvier / ' . $year => 'Janvier / ' . $year,
            'Février / ' . $year => 'Février / ' . $year,
            'Mars / ' . $year => 'Mars / ' . $year,
            'Avril / ' . $year => 'Avril / ' . $year,
            'Mai / ' . $year => 'Mai / ' . $year,
            'Juin / ' . $year => 'Juin / ' . $year,
            'Juillet / ' . $year => 'Juillet / ' . $year,
            'Août / ' . $year => 'Août / ' . $year,
            'Septembre / ' . $year => 'Septembre / ' . $year,
            'Octobre / ' . $year => 'Octobre / ' . $year,
            'Novembre / ' . $year => 'Novembre / ' . $year,
            'Décembre / ' . $year => 'Décembre / ' . $year,
        ];

        return $months;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Loyer::class,
        ]);
    }
}
