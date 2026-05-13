<?php

namespace App\Form;

use App\Entity\Bibliothecaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BibliothecaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule', IntegerType::class, ['label' => 'Matricule'])
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('prenom', TextType::class, ['label' => 'Prénom'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bibliothecaire::class,
        ]);
    }
}
