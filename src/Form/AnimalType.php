<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Habitat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nikname')
            ->add('classification', ChoiceType::class, [
                'choices' => [
                    'Mammifères' => 'Mammifères',
                    'Oiseaux' => 'Oiseaux',
                    'Poissons' => 'Poissons',
                    'Amphibiens' => 'Amphibiens',
                    'Reptiles' => 'Reptiles',
                ],
            ])
            ->add('area', ChoiceType::class, [
                'choices' => [
                    'Afrique' => 'Afrique',
                    'Amérique du Nord' => 'Amérique du Nord',
                    'Amérique du Sud' => 'Amérique du Sud',
                    'Asie' => 'Asie',
                    'Europe' => 'Europe',
                    'Océanie' => 'Océanie',
                ],
            ])
            ->add('name')
            ->add('description')
            ->add('habitat', EntityType::class, [
                'class' => Habitat::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
