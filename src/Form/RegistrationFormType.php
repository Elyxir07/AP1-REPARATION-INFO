<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Email', EmailType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse e-mail'],
                
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'row_attr' =>['class' => 'agree-row'],
                'label' => "J'accepte les conditions d'utilisation",
                'constraints' => [
                    new IsTrue(
                        message: 'Vous devez accetper les conditions.',
                    ),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control', 'placeholder' => 'Mot de passe'],
                'constraints' => [
                    new NotBlank(
                        message: 'Le mot de passe est obligatoire',
                    ),
                    new Length(
                        min: 6,
                        minMessage: 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        max: 4096,
                    ),
                ],
            ])
            ->add('prenom', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prenom'],
                'constraints' => [
                    new Regex(
                        pattern: "/^[A-Za-zÀ-ÿ](?:[A-Za-zÀ-ÿ' \-]*[A-Za-zÀ-ÿ])?$/",
                        message: "Le prénom contient des caractères non autorisés.",
                    ),
                    
                ],
            ])
            ->add('nom', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom'],
                'constraints' => [
                    new Regex(
                        pattern: "/^[A-Za-zÀ-ÿ](?:[A-Za-zÀ-ÿ' \-]*[A-Za-zÀ-ÿ])?$/",
                        message: "Le nom contient des caractères non autorisés.",
                    ),
                ],
                    
            ])
            ->add('NumTel', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Téléphone'],
                'constraints' => [
                    new Regex(
                        pattern: "/^0[1-9](?:[ .-]?\d{2}){4}$/",
                        message: "Le numero doit être un numéro de téléphone français valide.",
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
