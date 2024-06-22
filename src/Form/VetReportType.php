<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\VetReport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VetReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Comte rendu',
            ])
            ->add('state', TextType::class, [
                'label' => 'État de l\'animal',
            ])
            ->add('food', TextType::class, [
                'label' => 'Nourriture proposée',
            ])
            ->add('quantity', TextType::class, [
                'label' => 'grammage de la nourriture',
            ])

            ->add('animal', EntityType::class, [
                'class' => Animal::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VetReport::class,
        ]);
    }
}
