<?php

namespace App\Controller\Operationnel;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use App\Repository\FavoritesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/operationnel')]
class OperationnelController extends AbstractController
{

    #[Route('/', name: 'operationnel_homepage')]
    public function redirectToOperationnel() : Response
    {
        return $this->redirectToRoute('operationnel_home');
    }

    #[Route('/home', name: 'operationnel_home')]
    public function index_operationnel(): Response
    {
        return $this->render('operationnel/home/index.html.twig', [
            'controller_name' => 'OperationnelController',
        ]);
    }

    #[Route('/profil', name: 'operationnel_profil')]
    public function profile_operationnel(): Response
    {
        return $this->render('operationnel/profil/index.html.twig', [
            'controller_name' => 'OperationnelController',
        ]);
    }

}