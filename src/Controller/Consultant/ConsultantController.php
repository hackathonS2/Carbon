<?php

namespace App\Controller\Consultant;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use App\Repository\FavoritesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TechnoRepository;

#[Route('/consultant')]
class ConsultantController extends AbstractController
{

    #[Route('/', name: 'consultant_homepage')]
    public function redirectToConsultant() : Response
    {
        return $this->redirectToRoute('consultant_home');
    }

    #[Route('/home', name: 'consultant_home')]
    public function index_consultant(TechnoRepository $technoRepository): Response
    {
        return $this->render('consultant/home/index.html.twig', [
            'controller_name' => 'ConsultantController',
            'technos' => $technoRepository->findAll(),
            'isTest' => false
        ]);
    }

    #[Route('/profil', name: 'consultant_profil')]
    public function profile_consultant(): Response
    {
        return $this->render('consultant/profil/index.html.twig', [
            'controller_name' => 'ConsultantController',
        ]);
    }

}