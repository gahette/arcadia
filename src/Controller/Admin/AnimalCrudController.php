<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Form\FoodConsumptionType;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Animaux')
            ->setPageTitle(Crud::PAGE_DETAIL, fn (Animal $animal) => sprintf('Détails de l\'animal <b>%s</b>', $animal->getNikname()))
            ->setPageTitle(Crud::PAGE_EDIT, fn (Animal $animal) => sprintf('Modifier l\'Animal <b>%s</b>', $animal->getNikname()))
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un nouvel Animal');
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions = parent::configureActions($actions);

        if ($this->isGranted('ROLE_EMPLOYEE')) {
            $actions
                ->disable(Action::NEW, Action::DELETE);
        }

        if ($this->isGranted('ROLE_VETERINARIAN')) {
            $actions
                ->disable(Action::EDIT, Action::NEW, Action::DELETE);
        }

        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        $vetReportsField = CollectionField::new('vetReports', 'Rapport du vétérinaire')->onlyOnForms();
        $foodConsumptionField = CollectionField::new('foodConsumption', 'Alimentation')->onlyOnForms();
        $imagesField = CollectionField::new('images')->onlyOnForms();

        if (Crud::PAGE_INDEX === $pageName) {
            $vetReportsField = TextEditorField::new('vetReports', 'Rapport du vétérinaire')
                ->formatValue(function ($value, $entity) {
                    $sortedReports = $entity->getVetReports()->toArray();
                    usort($sortedReports, function ($a, $b) {
                        return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                    });

                    return implode(PHP_EOL.PHP_EOL, array_map(function ($report) {
                        $updatedAt = $report->getUpdatedAt();
                        $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';

                        return sprintf(
                            '<strong>État de l\'animal:</strong> %s'.PHP_EOL.'<strong>Compte rendu:</strong> %s'.PHP_EOL.'<strong>Nourriture proposée:</strong> %s (%s)'.PHP_EOL.'<strong>Mise à jour:</strong> %s',
                            $report->getState(),
                            $report->getContent(),
                            $report->getFood(),
                            $report->getQuantity().' grammes',
                            $report->getCreatedAt()->format('d-m-Y H:i:s'),
                        );
                    }, $sortedReports));
                })->onlyOnIndex();

            $imagesField = TextEditorField::new('images')
                ->formatValue(function ($value, $entity) {
                    $sortedImages = $entity->getImages()->toArray();
                    usort($sortedImages, function ($a, $b) {
                        return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                    });

                    return implode(PHP_EOL.PHP_EOL, array_map(function ($image) {
                        $updatedAt = $image->getUpdatedAt();
                        $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';

                        return sprintf(
                            '<img src="/images/%s" alt="Image de l\'animal" style="max-width: 200px;">'
                            .PHP_EOL.'<strong>Image ID:</strong> %s'
                            .PHP_EOL.'<strong>Habitat:</strong> %s'
                            .PHP_EOL.'<strong>Animal:</strong> %s'
                            .PHP_EOL.'<strong>Mise à jour:</strong> %s',
                            $image->getPath(),
                            $image->getId(),
                            $image->getHabitat()->getName(),
                            $image->getAnimal()->getNikname(),
                            $image->getCreatedAt()->format('d-m-Y H:i:s'),
                        );
                    }, $sortedImages));
                })->onlyOnIndex();
        }

        if (Crud::PAGE_INDEX === $pageName) {
            $foodConsumptionField = TextEditorField::new('foodConsumptions', 'Alimentation consommée')->formatValue(function ($value, $entity) {
                $sortedConsumptions = $entity->getFoodConsumptions()->toArray();
                usort($sortedConsumptions, function ($a, $b) {
                    return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                });

                return implode(PHP_EOL.PHP_EOL, array_map(function ($alimentation) {
                    $updatedAt = $alimentation->getUpdatedAt();
                    $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';

                    return sprintf(
                        '<strong>Nourriture donnée:</strong> %s (%s)'.PHP_EOL.'<strong>Mise à jour:</strong> %s', $alimentation->getFood(), $alimentation->getQuantity().' grammes', $date);
                }, $sortedConsumptions));
            })->onlyOnIndex();
        }

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            return [
                IdField::new('id')->hideOnForm(),
                TextField::new('nikname', 'Prénom'),
                TextField::new('name', 'Race'),
                $imagesField,
                CollectionField::new('images')
                    ->setEntryType(ImageType::class)
                    ->allowDelete()
                    ->allowAdd()
                    ->onlyOnForms(),
                SlugField::new('slug')->setTargetFieldName('name'),
                ChoiceField::new('classification', 'Classification')
                    ->setChoices([
                        'Mammifères' => 'Mammifères',
                        'Oiseaux' => 'Oiseaux',
                        'Poissons' => 'Poissons',
                        'Amphibiens' => 'Amphibiens',
                        'Reptiles' => 'Reptiles',
                    ]),
                ChoiceField::new('area', 'Région')
                    ->setChoices([
                        'Afrique' => 'Afrique',
                        'Amérique du Nord' => 'Amérique du Nord',
                        'Amérique du Sud' => 'Amérique du Sud',
                        'Asie' => 'Asie',
                        'Europe' => 'Europe',
                        'Océanie' => 'Océanie',
                    ]),
                AssociationField::new('habitat'),
                TextEditorField::new('description'),
                CollectionField::new('foodConsumptions', 'Nourriture consommée')
                    ->setEntryType(FoodConsumptionType::class)
                    ->allowDelete()
                    ->allowAdd()
                    ->onlyOnForms(),
                $vetReportsField->hideOnForm(),
                $foodConsumptionField->hideOnForm(),
                NumberField::new('consultation_count', 'Nombre de vue')->hideOnForm(),
            ];
        }

        if ($this->isGranted('ROLE_VETERINARIAN')) {
            return [
                IdField::new('id')->hideOnForm(),
                TextField::new('nikname', 'Prénom')->hideOnForm(),
                TextField::new('name', 'Race')->hideOnForm(),
                $imagesField->hideOnForm(),
                CollectionField::new('images')
                    ->setEntryType(ImageType::class)
                    ->allowDelete()
                    ->allowAdd()
                    ->onlyOnForms()
                    ->hideOnForm(),
                SlugField::new('slug')->setTargetFieldName('name')->hideOnForm(),
                ChoiceField::new('classification', 'Classification')
                    ->setChoices([
                        'Mammifères' => 'Mammifères',
                        'Oiseaux' => 'Oiseaux',
                        'Poissons' => 'Poissons',
                        'Amphibiens' => 'Amphibiens',
                        'Reptiles' => 'Reptiles',
                    ])->hideOnForm(),
                ChoiceField::new('area', 'Région')
                    ->setChoices([
                        'Afrique' => 'Afrique',
                        'Amérique du Nord' => 'Amérique du Nord',
                        'Amérique du Sud' => 'Amérique du Sud',
                        'Asie' => 'Asie',
                        'Europe' => 'Europe',
                        'Océanie' => 'Océanie',
                    ])->hideOnForm(),
                AssociationField::new('habitat')->hideOnForm(),
                TextEditorField::new('description')->hideOnForm(),
                $vetReportsField->hideOnForm(),
                $foodConsumptionField->hideOnForm(),
                NumberField::new('consultation_count', 'Nombre de vue')->hideOnForm(),
            ];
        }

        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return [
                IdField::new('id')->hideOnForm(),
                TextField::new('nikname', 'Prénom')->hideOnForm(),
                TextField::new('name', 'Race')->hideOnForm(),
                $imagesField->hideOnForm(),
                CollectionField::new('images')
                    ->setEntryType(ImageType::class)
                    ->allowDelete()
                    ->allowAdd()
                    ->onlyOnForms(),
                SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex()->hideOnForm(),
                ChoiceField::new('classification', 'Classification')
                    ->setChoices([
                        'Mammifères' => 'Mammifères',
                        'Oiseaux' => 'Oiseaux',
                        'Poissons' => 'Poissons',
                        'Amphibiens' => 'Amphibiens',
                        'Reptiles' => 'Reptiles',
                    ])->hideOnForm(),
                ChoiceField::new('area', 'Région')
                    ->setChoices([
                        'Afrique' => 'Afrique',
                        'Amérique du Nord' => 'Amérique du Nord',
                        'Amérique du Sud' => 'Amérique du Sud',
                        'Asie' => 'Asie',
                        'Europe' => 'Europe',
                        'Océanie' => 'Océanie',
                    ])->hideOnForm(),
                AssociationField::new('habitat')->hideOnForm(),
                TextEditorField::new('description')->hideOnForm(),
                CollectionField::new('foodConsumptions', 'Nourriture consommée')
                    ->setEntryType(FoodConsumptionType::class)
                    ->allowDelete()
                    ->allowAdd()
                    ->onlyOnForms(),
                $vetReportsField->hideOnForm(),
                $foodConsumptionField->hideOnForm(),
                NumberField::new('consultation_count', 'Nombre de vue')->hideOnForm(),
            ];
        }

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nikname', 'Prénom'),
            TextField::new('name', 'Race'),
            CollectionField::new('images')
                ->setEntryType(ImageType::class)
                ->allowDelete()
                ->allowAdd(),
            SlugField::new('slug')->setTargetFieldName('name'),
            ChoiceField::new('classification', 'Classification')
                ->setChoices([
                    'Mammifères' => 'Mammifères',
                    'Oiseaux' => 'Oiseaux',
                    'Poissons' => 'Poissons',
                    'Amphibiens' => 'Amphibiens',
                    'Reptiles' => 'Reptiles',
                ]),
            ChoiceField::new('area', 'Région')
                ->setChoices([
                    'Afrique' => 'Afrique',
                    'Amérique du Nord' => 'Amérique du Nord',
                    'Amérique du Sud' => 'Amérique du Sud',
                    'Asie' => 'Asie',
                    'Europe' => 'Europe',
                    'Océanie' => 'Océanie',
                ]),
            AssociationField::new('habitat'),
            TextEditorField::new('description'),
            CollectionField::new('foodConsumptions', 'Nourriture consommée')
                ->setEntryType(FoodConsumptionType::class)
                ->allowDelete()
                ->allowAdd(),
            $vetReportsField,
            $foodConsumptionField,
            NumberField::new('consultation_count', 'Nombre de vue')->hideOnForm(),
        ];
    }
}
