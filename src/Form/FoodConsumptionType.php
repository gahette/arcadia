<?php

namespace App\Form;

use App\Entity\FoodConsumption;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FoodConsumptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('food', null, [
                'label' => 'Nourriture donnée',
            ])
            ->add('quantity', null, [
                'label' => 'Quantité en gramme',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FoodConsumption::class,
        ]);
    }
}
