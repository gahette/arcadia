<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHour;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpeningHourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHour::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Horaires d\'ouvertures')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de la plage horaire')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier la plage horaire')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer une nouvelle plage horaire');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
//            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Créer un horaire');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('day', 'Jour'),
            TextField::new('opening_time', 'Heure d\'ouverture'),
            TextField::new('closing_time', 'Heure de fermeture'),
        ];
    }
}
