<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_SUPER_ADMIN')]
class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Utilisateur')
            ->setPageTitle(Crud::PAGE_DETAIL, fn (User $user) => sprintf('Détails de l\'utilisateur <b>%s</b>', $user->getFirstname()))
            ->setPageTitle(Crud::PAGE_EDIT, fn (User $user) => sprintf('Modifier l\'utilisateur <b>%s</b>', $user->getFirstname()))
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un nouvel Utilisateur');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            //            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Créer un nouvel utilisateur');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('lastname'),
            TextField::new('firstname'),
            EmailField::new('email'),
            ChoiceField::new('roles')
                ->setChoices(
                    [
                        'Super admin' => 'ROLE_SUPER_ADMIN',
                        'Administrateur' => 'ROLE_ADMIN',
                        'Employé' => 'ROLE_EMPLOYEE',
                        'Vétérinaire' => 'ROLE_VETERINARIAN',
                    ]
                )
            ->setRequired(isRequired: false)
            ->allowMultipleChoices(),
            TextField::new('plainPassword', 'Mot de passe')->onlyOnForms(),
        ];
    }
}
