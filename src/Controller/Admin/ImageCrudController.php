<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Images')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de l\'image')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier l\'image')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer une nouvelle image');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
//            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Créer une image');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            VichImageField::new('file'),
            AssociationField::new('habitat'),
            AssociationField::new('animal'),
            TextEditorField::new('description'),
            IntegerField::new('size')->hideOnForm(),
            IntegerField::new('priority'),
        ];
    }
}
