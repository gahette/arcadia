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
        return $actions
//            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Créer un nouvel animal');
            });
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
                            $date
                        );
                    }, $sortedReports));
                })->onlyOnIndex();

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
                            $date
                        );
                    }, $sortedReports));
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

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nikname', 'Prénom'),
            TextField::new('name', 'Race'),
            $imagesField->hideOnForm(),
            CollectionField::new(propertyName: 'images')
                ->setEntryType(formTypeFqcn: ImageType::class)
                ->allowDelete()
                ->allowAdd()
                ->onlyOnForms(),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
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
}
