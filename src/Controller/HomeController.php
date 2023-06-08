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


class HomeController extends AbstractController
{
    #[Route('/consultant', name: 'consultant_only')]
    public function redirectToConsultant() : Response
    {
        return $this->redirectToRoute('consultant_home');
    }

    #[Route('/admin', name: 'admin_only')]
    public function redirectToAdmin() : Response
    {
        return $this->redirectToRoute('admin_home');
    }

    /*************************ADMIN*************************/
    #[Route('/admin/home', name: 'admin_home')]
    public function index(): Response
    { 
        return $this->render('admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /********************CONSULTANT****************************/

    #[Route('/consultant/home', name: 'consultant_home')]
    public function index_consultant(): Response
    {
        return $this->render('consultant/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /********************ADMIN****************************/
}