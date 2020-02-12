<?php

namespace App\Form;

use App\Entity\MaladieChronique;
use App\Entity\Profil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('gender', ChoiceType::class,[
                'choices' => [
                    'Male' => 'h',
                    'Female' => 'f'
                ]
            ])
            ->add('birth_date',DateType::class, [
                'years' => range(1960, 2020),
            ])
            ->add('blood_type')
            ->add('picture')
            ->add('information')
            ->add('maladieChroniques', EntityType::class, [
                'class' => MaladieChronique::class,
                'multiple' => true
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
