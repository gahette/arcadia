<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\FoodConsumption;
use App\Entity\Habitat;
use App\Entity\OpeningHour;
use App\Entity\Service;
use App\Entity\Testimonial;
use App\Entity\User;
use App\Entity\VetReport;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route(path: '/admin', name: 'admin_dashboard_index')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->renderContentMaximized()
            ->setTitle('Arcadia')
        ;
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->renderContentMaximized()
            ->showEntityActionsInlined()
            ->setDefaultSort([
                'id' => 'DESC',
            ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('');
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToCrud('Administrations personnels', 'fas fa-clipboard-user', User::class);
        }

        yield MenuItem::section('Données');
        if (!$this->isGranted('ROLE_VETERINARIAN')) {
            yield MenuItem::linkToCrud('Services', 'fas fa-bell-concierge', Service::class);
            yield MenuItem::linkToCrud('Habitats', 'fas fa-tents', Habitat::class);
        }
        if ($this->isGranted('ROLE_VETERINARIAN')) {
            yield MenuItem::linkToCrud('Habitats', 'fas fa-tents', Habitat::class);
        }

        yield MenuItem::linkToCrud('Animaux', 'fas fa-paw', Animal::class);

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToCrud('Horaires d\'ouvertures', 'fas fa-clock', OpeningHour::class);
        }
        yield MenuItem::section('Sous-données');

        if ($this->isGranted('ROLE_VETERINARIAN')) {
            yield MenuItem::linkToCrud('Rapports vétérinaire', 'fas fa-file-medical', VetReport::class);
        }
        if (!$this->isGranted('ROLE_VETERINARIAN')) {
            yield MenuItem::linkToCrud('Consommation alimentaire', 'fas fa-bowl-food', FoodConsumption::class);
        }
        yield MenuItem::section('');
        if (!$this->isGranted('ROLE_VETERINARIAN')) {
            yield MenuItem::linkToCrud('Avis', 'fas fa-gavel', Testimonial::class);
        }
    }
}
