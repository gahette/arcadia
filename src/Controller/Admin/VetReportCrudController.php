<?php

namespace App\Controller\Admin;

use App\Entity\VetReport;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VetReportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VetReport::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Rapports vétérinaire')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du rapport')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier le rapport')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un nouveau rapport');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
//            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Créer un nouveau rapport');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('animal', 'Animal'),
            TextEditorField::new('content', 'Compte rendu'),
            TextField::new('state', 'État de l\'animal'),
            TextField::new('food', 'Nourriture proposée'),
            NumberField::new('quantity', 'grammage de la nourriture'),
            //            DateTimeField::new('createdAt', 'Date de creation')->hideOnForm(),
            DateTimeField::new('updatedAt', 'Date de passage')->hideOnForm(),
        ];
    }
}
