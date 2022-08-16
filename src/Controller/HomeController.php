<?php

namespace App\Controller;

use App\Repository\AppetizerRepository;
use App\Repository\DessertRepository;
use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/menu', name: 'app_menu')]
    public function menu(AppetizerRepository $appRepo, MealRepository $mealRepo, DessertRepository $dessRepo): Response
    {
        $appetizers = $appRepo->findAll();
        $meals = $mealRepo->findAll();
        $desserts = $dessRepo->findAll();
        return $this->render('home/menu.html.twig', [ 'appetizers' => $appetizers, 'meals' => $meals, 'desserts' => $desserts ]);
    }
}
