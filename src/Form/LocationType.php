<?php

namespace App\Form;

use App\Contante\EnergieConstant;
use App\Contante\LoyerConstant;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => 'Nom *'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => LoyerConstant::types,
                'choice_label' => function (string $type) {
                    return ucfirst($type);
                },
            ])
            ->add('amenagement', ChoiceType::class, [
                'choices' => LoyerConstant::AMANAGEMENT,
                'choice_label' => function (string $type) {
                    return ucfirst($type);
                },
                'expanded' => true,
                'required' => false,
                'placeholder' => false
            ])
            ->add('surfaceHabitable', NumberType::class, [
                'scale' => 2,
                'required' => false,
            ])
            ->add('surfaceTerrain', NumberType::class, [
                'scale' => 2,
                'required' => false,
            ])
            ->add('nombrePiece', IntegerType::class, [
                'required' => false,
            ])
            ->add('classeEnergetique', ChoiceType::class, [
                'required' => false,
                'choices' => EnergieConstant::CLASSE_ENERGIE,
                'choice_label' => function (string $type) {
                    return strtoupper($type);
                },
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('prixLoyer', NumberType::class, [
                'scale' => 2,
                'required' => false,
                'attr' => [
                    'placeholder' => '150.5 €',
                ]
            ])
            ->add('adresse', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => '23 avenue de charles de gaulle '
                ]
            ])
            ->add('codePostale', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => '78280'
                ]
            ])
            ->add('ville', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Guyancourt'
                ],
                'label' => 'Ville *'
            ])
            ->add('image', ImageType::class, [
                'required' => false,
            ])
            ->add('locataire', LocataireType::class, [
                'required' => false,
                'label' => 'Informations sur le locataire'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}

