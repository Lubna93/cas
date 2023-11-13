<?php

namespace App\Form;

use App\Entity\User;
use App\Form\Type\TaskType;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\FormView;
use Symfony\UX\Autocomplete\EntityAutocompleterInterface;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('uid', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('codEtu', TextType::class)
            ->add('mailperso', EmailType::class, array(
                'attr' => array(
                    'placeholder' => 'youremail@example.com'
                )
           ))
           ->add('mail', EmailType::class, array(
            'attr' => array(
                'placeholder' => 'youremail@example.com'
            )
            ))
            ->add('tel', TelType::class, array(
                'attr' => array(
                    'placeholder' => '000-000-0000'
                )
                ))
            ->add('datenais', TextType::class)
            ->add('genre')
            ->add('nationalite')
            ->add('diplomePrepare')
            ->add('derniereDiplome')
            ->add('derniereFiliereHors')
            ->add('echangeInter')
            ->add('adresseFixe')
            ->add('adresseActu')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('pratiqueArt', ChoiceType::class, [
                'choices' => [
                    'Peinture et arts plastiques'  => '1',
                    'Musique'  => '2',
                    'Performance'  => '3',
                    'Rédaction'  => '4',
                    'Vidéo'  => '5',
                ],
            ])

            ->add('otherComments', TextareaType::class, array(
                'attr' => array(
                    'placeholder' => 'Ici vous pouvez écrire vos commentaires ou remarques . .'
                )
           ))
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
