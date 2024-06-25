<?php

namespace App\Controller\Admin;

use App\Entity\Habitat;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HabitatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Habitat::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Habitats')
            ->setPageTitle(Crud::PAGE_DETAIL, fn (Habitat $habitat) => sprintf('Détails de l\'habitat<b>%s</b>', $habitat->getName()))
            ->setPageTitle(Crud::PAGE_EDIT, fn (Habitat $habitat) => sprintf('Modifier l\'habitat <b>%s</b>', $habitat->getName()))
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un nouvel Habitat');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
//            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Créer un nouvel animal');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        $animalsField = CollectionField::new('animals', 'Liste des animaux')->onlyOnForms();
        $imagesField = CollectionField::new('images')->onlyOnForms();

        if (Crud::PAGE_INDEX === $pageName) {
            $animalsField = TextEditorField::new('animals', 'Liste des animaux')
                ->formatValue(function ($value, $entity) {
                    $sortedAnimals = $entity->getAnimals()->toArray();
                    usort($sortedAnimals, function ($b, $a) {
                        return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                    });

                    return implode(PHP_EOL.PHP_EOL, array_map(function ($animal) {
                        $updatedAt = $animal->getUpdatedAt();
                        $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';

                        return sprintf(
                            '<strong>Race:</strong> %s (%s)'.PHP_EOL.'<strong>Date d\'entrée au Zoo:</strong> %s'.PHP_EOL.'<strong>Mise à jour:</strong> %s',
                            $animal->getName(),
                            $animal->getId(),
                            $animal->getCreatedAt()->format('d-m-Y H:i:s'),
                            $animal->getCreatedAt()->format('d-m-Y H:i:s'),
                        );
                    }, $sortedAnimals));
                })->onlyOnIndex();
        }

        if (Crud::PAGE_INDEX === $pageName) {
            $imagesField = TextEditorField::new('images')
                ->formatValue(function ($value, $entity) {
                    $sortedImages = $entity->getImages()->toArray();
                    usort($sortedImages, function ($a, $b) {
                        return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                    });

                    return implode(PHP_EOL.PHP_EOL, array_map(function ($image) {
                        $updatedAt = $image->getUpdatedAt();
                        $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';

                        if (null === $image->getAnimal()) {
                            return sprintf(
                                '<img src="/images/%s" alt="Image de l\'animal" style="max-width: 200px;">'
                                .PHP_EOL.'<strong>Image ID:</strong> %s'
                                .PHP_EOL.'<strong>Habitat:</strong> %s'
                                .PHP_EOL.'<strong>Mise à jour:</strong> %s',
                                $image->getPath(),
                                $image->getId(),
                                $image->getHabitat(),
                                $image->getCreatedAt()->format('d-m-Y H:i:s'),
                            );
                        } else {
                            return sprintf(
                                '<img src="/images/%s" alt="Image de l\'animal" style="max-width: 200px;">'
                                .PHP_EOL.'<strong>Image ID:</strong> %s'
                                .PHP_EOL.'<strong>Habitat:</strong> %s'
                                .PHP_EOL.'<strong>Animal:</strong> %s (%s)'
                                .PHP_EOL.'<strong>Mise à jour:</strong> %s',
                                $image->getPath(),
                                $image->getId(),
                                $image->getHabitat(),
                                $image->getAnimal()->getNikname(),
                                $image->getAnimal(),
                                $image->getCreatedAt()->format('d-m-Y H:i:s'),
                            );
                        }
                    }, $sortedImages));
                })->onlyOnIndex();
        }

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            $imagesField->hideOnForm(),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            CollectionField::new(propertyName: 'images')
                ->setEntryType(formTypeFqcn: ImageType::class)
                ->allowDelete()
                ->allowAdd()
                ->onlyOnForms(),
            TextEditorField::new('description', 'Description de l\'habitat'),
            TextEditorField::new('comment', 'Commentaire du vétérinaire'),
            $animalsField->hideOnForm(),
        ];
    }
}
