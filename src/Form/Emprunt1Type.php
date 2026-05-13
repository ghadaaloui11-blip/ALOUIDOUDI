<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Entity\Bibliothecaire;
use App\Entity\Emprunt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Emprunt1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateEmprunt')
            ->add('dateRetour')
            ->add('penalite')
            ->add('etat')
            ->add('bibliothecaire', EntityType::class, [
                'class' => Bibliothecaire::class,
                'choice_label' => 'id',
            ])
            ->add('adherent', EntityType::class, [
                'class' => Adherent::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
