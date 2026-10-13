<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\Prestation;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ModifDemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('EtatDemande', ChoiceType::class, [
                'choices' => [
                    'Annulée' => 'annulée',
                    'En cours / En attente' => 'en attente',
                    'Terminée' => 'terminée',
                    'Acceptée' => 'acceptée',
                ],
                'placeholder' => 'Sélectionnez un état',
            ])
            ->add('Objet', TextareaType::class)
            ->add('Raison')
            ->add('Commentaire', TextareaType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer les modifications',
                'attr' => ['class' => 'btn btn-primary mt-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
