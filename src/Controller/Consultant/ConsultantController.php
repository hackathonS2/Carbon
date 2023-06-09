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
use App\Repository\MissionRepository;

#[Route('/consultant')]
class ConsultantController extends AbstractController
{

    #[Route('/', name: 'consultant_homepage')]
    public function redirectToConsultant() : Response
    {
        return $this->redirectToRoute('consultant_home');
    }

    #[Route('/home', name: 'consultant_home')]
    public function index_consultant(TechnoRepository $technoRepository, MissionRepository $missionRepository): Response
    {
        $user_id =  $this->getUser()->getId();


        return $this->render('consultant/home/index.html.twig', [
            'controller_name' => 'ConsultantController',
            'technos' => $technoRepository->findAll(),
            'missions' => $missionRepository->findByMissionId($user_id)
        ]);
    }

    #[Route('/profil', name: 'consultant_profil')]
    public function profile_consultant(): Response
    {
        return $this->render('consultant/profil/index.html.twig', [
            'controller_name' => 'ConsultantController',
        ]);
    }
    #[Route('/users', name: 'consultant_users')]
    public function users(UserRepository $userRepository,TechnoRepository $technoRepository): Response
    {   
        $users = $userRepository->findAll();
        //dump($technoRepository->findAll());
        
        return $this->render('consultant/profil/users.html.twig', [
            'controller_name' => 'HomeController',
            'technos' => $technoRepository->findAll(),
            'users' => $users,
        ]);
    }

}