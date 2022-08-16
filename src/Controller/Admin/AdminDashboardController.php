<?php

namespace App\Controller\Admin;

use App\Entity\Appetizer;
use App\Entity\Dessert;
use App\Entity\Meal;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $route = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($route->setController(AppetizerCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LaRegina');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to Site', "fa-solid fa-arrow-left", "app_home");

        yield MenuItem::section('Menu');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::subMenu('Appetizers', 'fa fa-tags')->setSubItems([
                MenuItem::linkToCrud('All', 'fa fa-file-text', Appetizer::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Add', 'fas fa-plus', Appetizer::class)->setAction(Crud::PAGE_NEW)
            ]);
        yield MenuItem::subMenu('Meal', 'fa fa-tags')->setSubItems([
                MenuItem::linkToCrud('All', 'fa fa-file-text', Meal::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Add', 'fas fa-plus', Meal::class)->setAction(Crud::PAGE_NEW)
            ]);
        yield MenuItem::subMenu('Desserts', 'fa fa-tags')->setSubItems([
                MenuItem::linkToCrud('All', 'fa fa-file-text', Dessert::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Add', 'fas fa-plus', Dessert::class)->setAction(Crud::PAGE_NEW)
            ]);
    }
}
