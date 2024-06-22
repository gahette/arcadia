<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Habitat;
use App\Entity\Image;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', VichImageType::class, [
                'label' => 'Image',
                'required' => false,
            ])
            ->add('priority')
            ->add('description')
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'required' => false,
            ])
            ->add('habitat', EntityType::class, [
                'class' => Habitat::class,
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'label' => 'Créé par',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
