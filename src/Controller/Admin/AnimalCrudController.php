<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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

    public function configureFields(string $pageName): iterable
    {
        $vetReportsField = CollectionField::new('vetReports', 'Rapport du vétérinaire')->onlyOnForms();
        $foodConsumptionField = CollectionField::new('foodConsumption', 'Alimentation')->onlyOnForms();

        if (Crud::PAGE_INDEX === $pageName) {
            $vetReportsField = TextEditorField::new('vetReports', 'Rapport du vétérinaire')->formatValue(function ($value, $entity) {
                $sortedReports = $entity->getVetReports()->toArray();
                usort($sortedReports, function ($a, $b) {
                    return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                });

                return implode(', ', array_map(function ($report) {
                    $updatedAt = $report->getUpdatedAt();
                    $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';
                    return sprintf('%s (Mise à jour : %s)', $report->getContent(), $date);
                }, $sortedReports));
            })->onlyOnIndex();
        }

        if (Crud::PAGE_INDEX === $pageName) {
            $foodConsumptionField = TextEditorField::new('foodConsumptions', 'Alimentation')->formatValue(function ($value, $entity) {
                $sortedConsumptions = $entity->getFoodConsumptions()->toArray();
                usort($sortedConsumptions, function ($a, $b) {
                    return $b->getUpdatedAt() <=> $a->getUpdatedAt();
                });

                return implode(', ', array_map(function ($alimentation) {
                    $updatedAt = $alimentation->getUpdatedAt();
                    $date = $updatedAt ? $updatedAt->format('d-m-Y H:i:s') : 'Date non disponible';
                    return sprintf('%s (%s) - Mise à jour : %s', $alimentation->getFood(), $alimentation->getQuantity(), $date);
                }, $sortedConsumptions));
            })->onlyOnIndex();
        }

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Race'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            TextEditorField::new('description'),
            TextField::new('nikname', 'Prénom'),
            TextField::new('classification'),
            TextField::new('area', 'Région'),
            NumberField::new('consultation_count', 'Nbre de vue'),
            AssociationField::new('habitat'),
            $vetReportsField->hideOnForm(),
            $foodConsumptionField->hideOnForm(),
        ];
    }
}
