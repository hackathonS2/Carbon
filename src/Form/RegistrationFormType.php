<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class,[
                'choices' => [
                    'Consultant'=>'ROLE_CONSULTANT',
                    'Operationnel'=>'ROLE_OPERATIONNEL',
                ],
                'multiple' => true,
            ])
            ->add('nom')
            ->add('prenom')
            ->add('dateDeNaissance',DateType::class, [
                'widget' => 'single_text',
                'attr' => ['max' => date("Y-m-d")],
            ])
            ->add('adresse')
            ->add('tel')
            ->add('description')
            ->add('salaireSouhaite')
            ->add('Submit',SubmitType::class,[
                'label' => 'Envoyer',
                'attr' =>[
                'class' => 'flex w-full justify-center rounded-md  px-3 py-5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 red-button cta'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
