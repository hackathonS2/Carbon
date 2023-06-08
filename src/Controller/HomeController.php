<?php

namespace App\Controller;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use App\Repository\FavoritesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class HomeController extends AbstractController
{
/************************ADMIN*************************/
    #[Route('/home', name: 'admin_home')]
    public function index(): Response
    { 
        return $this->render('admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/', name: 'admin_only')]
    public function redirectToAdmin() : Response
    {
        return $this->redirectToRoute('admin_home');
    }

    #[Route('/profil', name: 'admin_profil')]
    public function profile_consultant(): Response
    {
        return $this->render('admin/profil/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}