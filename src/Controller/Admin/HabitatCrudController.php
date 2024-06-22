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

        if (Crud::PAGE_INDEX === $pageName) {
            $animalsField = TextEditorField::new('animals', 'Liste des animaux')
                ->formatValue(function ($value, $entity) {
                    $sortedReports = $entity->getAnimals()->toArray();
                    usort($sortedReports, function ($a, $b) {
                        return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                    });

                    return implode(PHP_EOL.PHP_EOL, array_map(function ($report) {
                        $updatedAt = $report->getUpdatedAt();
                        $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';

                        return sprintf(
                            '<strong>Race:</strong> %s (%s)'.PHP_EOL.'<strong>Date d\'entrée au Zoo:</strong> %s'.PHP_EOL.'<strong>Mise à jour:</strong> %s',
                            $report->getName(),
                            $report->getId(),
                            $report->getCreatedAt()->format('d-m-Y H:i:s'),
                            $report->getCreatedAt()->format('d-m-Y H:i:s'),
                        );
                    }, $sortedReports));
                })->onlyOnIndex();
        }

        $imagesField = CollectionField::new('images')->onlyOnForms();

        if (Crud::PAGE_INDEX === $pageName) {
            $imagesField = TextEditorField::new('images')
                ->formatValue(function ($value, $entity) {
                    $sortedReports = $entity->getImages()->toArray();
                    usort($sortedReports, function ($a, $b) {
                        return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                    });

                    return implode(PHP_EOL.PHP_EOL, array_map(function ($report) {
                        $updatedAt = $report->getUpdatedAt();
                        $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';

                        return sprintf(
                            '<strong>Image:</strong> %s (%s)'.PHP_EOL.'<strong>Habitat:</strong> %s'.PHP_EOL.'<strong>Animal:</strong> %s'.PHP_EOL.'<strong>Mise à jour:</strong> %s',
                            $report->getPath(),
                            $report->getId(),
                            $report->getHabitat(),
                            $report->getAnimal(),
                            $report->getCreatedAt()->format('d-m-Y H:i:s'),
                        );
                    }, $sortedReports));
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
