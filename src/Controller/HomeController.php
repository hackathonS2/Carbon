<?php

namespace App\Controller;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use App\Repository\FavoritesRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Mission;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'global_home')]
    public function globalHome() : Response
    {
        return $this->render('globalHome/globalHome.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/planning', name: 'planning_corporate')]
    public function redirectToPlanning() : Response
    {
        //if login

        if($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')){

        if($this->isGranted('ROLE_OPERATIONNEL')){
            return $this->render('operationnel/home/planning.html.twig', [
                'controller_name' => 'PlanningController',
            ]);
        }
        if ($this->isGranted('ROLE_CONSULTANT')){
            return $this->render('consultant/home/planning.html.twig', [
                'controller_name' => 'PlanningController',
            ]);
        }
        if ($this->isGranted('ROLE_ADMIN')){
            return $this->render('admin/home/planning.html.twig', [
                'controller_name' => 'PlanningController',
            ]);
        }
    }else{
        return $this->redirectToRoute('app_login');}
    }
    /*************************ADMIN*************************/
    #[Route('admin/home', name: 'admin_home')]
    public function index(): Response
    { 
        return $this->render('admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('admin/', name: 'admin_only')]
    public function redirectToAdmin() : Response
    {
        return $this->redirectToRoute('admin_home');
    }

    #[Route('admin/users', name: 'admin_users')]
    public function users(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
    
        return $this->render('admin/global/index.html.twig', [
            'controller_name' => 'HomeController',
            'users' => $users,
        ]);
    }

    #[Route('admin/profil', name: 'admin_profil')]
    public function profile_consultant(): Response
    {   

        $mission = new Mission();

        //find mission by consultant

        return $this->render('admin/profil/index.html.twig', [
            'controller_name' => 'HomeController',
            'missions' => $mission,
        ]);
    }

}