<?php



use App\Entity\Users;
use App\Entity\Techno;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher',
                    'class' => 'form-control'
                ]
            ])
            ->add('hardSkills',EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => TechnoType:: class,
                'expanded' => true,
                'multiple' => true
            ])
            ->add('softSkills',EntityType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Soft Skills',
                    'class' => 'form-control'
                ]]);
                

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}