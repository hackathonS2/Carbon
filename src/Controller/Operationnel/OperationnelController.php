<?php


namespace App\Controller\Operationnel;

use App\Entity\Mission;

use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use App\Repository\FavoritesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

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
        return $this->render('admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/profil', name: 'operationnel_profil')]
    public function profile_operationnel(): Response
    {
        $mission = new Mission();


        return $this->render('admin/profil/index.html.twig', [
            'controller_name' => 'HomeController',
            'missions' => $mission,
        ]);
    }

    #[Route('/users', name: 'operationnel_users')]
    public function users(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
    
        return $this->render('admin/global/index.html.twig', [
            'controller_name' => 'HomeController',
            'users' => $users,
        ]);
    }

    #[Route('/user/{id}', name: 'app_operationnel_user',methods: ['GET'])]
    public function consultant_show_user(User $user): Response
    {

        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

}