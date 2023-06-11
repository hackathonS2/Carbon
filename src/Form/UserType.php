<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class,[
                'choices' => [
                    'Administrateur'=>'ROLE_ADMIN',
                    'Consultant'=>'ROLE_CONSULTANT',
                    'Operationnel'=>'ROLE_OPERATIONNEL',
                ],
                'multiple' => true
            ])
            ->add('nom')
            ->add('prenom')
            ->add('dateDeNaissance',DateType::class, ['widget' => 'single_text', 'attr' => ['max' => date("Y-m-d")],])
            ->add('adresse')
            ->add('tel')
            ->add('description')
            ->add('salaireSouhaite')
            ->add('evalClient',IntegerType::class,[
                'attr'=>[
                    'min'=>0,
                    'max'=>5,
                ]
            ])
            ->add('linkLinkedin')
            ->add('linkSlack')
            ->add('evalClientDev',IntegerType::class,[
                'attr'=>[
                    'min'=>0,
                    'max'=>5,
                ]
            ])
            ->add('objectifMensuelCommercial')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
