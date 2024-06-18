<?php

namespace App\Controller\Admin;

use App\Entity\VetReport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class VetReportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VetReport::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('animal', 'Animal'),
            TextEditorField::new('content', 'Rapport'),
        ];
    }

}
