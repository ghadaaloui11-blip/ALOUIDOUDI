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
            ->add('specialite', TextType::class, ['label' => 'Spécialité', 'required' => false])
            ->add('telephone', TextType::class, ['label' => 'Téléphone', 'required' => false])
            ->add('dateEmbauche', \Symfony\Component\Form\Extension\Core\Type\DateType::class, [
                'label' => 'Date d\'embauche',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('bureau', TextType::class, ['label' => 'Bureau / Étage', 'required' => false])
            ->add('grade', TextType::class, ['label' => 'Grade / Titre', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bibliothecaire::class,
        ]);
    }
}
