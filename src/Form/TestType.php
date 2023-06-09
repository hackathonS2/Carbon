<?php

namespace App\Form;

use App\Entity\Techno;
use App\Entity\Test;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('difficulte', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 3,
                ],
                'constraints' => [
                    new Range([
                        'min' => 1,
                        'max' => 3,
                        'notInRangeMessage' => 'La difficulté doit être comprise entre 1 et 3.',
                    ]),
                ],
            ])
            ->add('actif',ChoiceType::class,[
                'choices'  => [
                    'Actif' => true,
                    'Test Fermé' => false,
                ],
            ])
            ->add('techno', EntityType::class, [
                'class' => Techno::class,
                'choice_label' => 'nom',
                'mapped' => false
            ]);            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
        ]);
    }
}
