<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\FoodConsumption;
use App\Entity\Habitat;
use App\Entity\Image;
use App\Entity\OpeningHour;
use App\Entity\Service;
use App\Entity\Testimonial;
use App\Entity\VetReport;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route(path: '/admin', name: 'admin_dashboard_index')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->renderContentMaximized()
            ->setTitle('Arcadia');

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

        yield MenuItem::section('Données');


        yield MenuItem::linkToCrud('Services', 'fas fa-bell-concierge', Service::class);
        yield MenuItem::linkToCrud('Habitats', 'fas fa-tents', Habitat::class);
        yield MenuItem::linkToCrud('Animaux', 'fas fa-paw', Animal::class);
        yield MenuItem::linkToCrud('Horaires d\'ouvertures', 'fas fa-clock', OpeningHour::class);

        yield MenuItem::section('Sous-données');

        yield MenuItem::linkToCrud('Rapports vétérinaire', 'fas fa-file-medical', VetReport::class);
        yield MenuItem::linkToCrud('Consommation alimentaire', 'fas fa-bowl-food', FoodConsumption::class);


        yield MenuItem::linkToCrud('Images', 'fas fa-images', Image::class);

        yield MenuItem::section('');

        yield MenuItem::linkToCrud('Avis', 'fas fa-gavel', Testimonial::class);
    }
}
