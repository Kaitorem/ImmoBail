<?php

namespace App\Form;

use App\Contante\LocataireConstant;
use App\Entity\Locataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom locataire'
                ]
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'required' => false,
                'widget' => 'single_text'
            ])
            ->add('email', EmailType::class, [
                'required' => false
            ])
            ->add('telephone', TextType::class, [
                'required' => false,
                'label' => 'Téléphone'
            ])
            ->add('status', ChoiceType::class, [
                'required' => false,
                'choices' => LocataireConstant::STATUS,
                'choice_label' => function (string $type) {
                    return ucfirst($type);
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Locataire::class,
        ]);
    }
}
