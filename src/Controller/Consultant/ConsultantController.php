<?php

namespace App\Controller\Consultant;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use App\Repository\FavoritesRepository;
use App\Repository\SoftSkillsRepository;
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
    public function index_consultant(Request $request, TechnoRepository $technoRepository, MissionRepository $missionRepository, SoftSkillsRepository $softskillrepo, UserRepository $userRepo ): Response
    {
        $user_id =  $this->getUser()->getId();
        $mySoftskillrepo = $softskillrepo->findBy(
            ['idUser' => $user_id]
        );

        $searchQuery = $request->query->get('q'); // Récupère le terme de recherche depuis la requête
        if($searchQuery == null) $searchQuery="";

        $users = $userRepo->searchBy($searchQuery);

        return $this->render('consultant/home/index.html.twig', [
            'controller_name' => 'ConsultantController',
            'technos' => $technoRepository->findAll(),
            'missions' => $missionRepository->findByMissionId($user_id),
            'mySoftskills' => $mySoftskillrepo,
            'users' => $users,
        ]);
    }

    #[Route('/profil', name: 'consultant_profil')]
    public function profile_consultant(): Response
    {
        return $this->redirectToRoute('consultant_home');


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