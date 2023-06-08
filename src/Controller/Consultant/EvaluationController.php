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
use App\Repository\TestRepository;

class EvaluationController extends AbstractController
{
    #[Route('/evaluations', name: 'consultant_evaluations')]
    public function index_consultant(): Response
    {
        return $this->render('consultant/evaluations/index.html.twig', [
            'controller_name' => 'EvaluationController'
        ]);
    }

    /**fetch all tests by techno id */
    #[Route('/consultant/home/{id}', name: 'tests_by_techno', methods: ['GET'])]
    public function indexByTechno(TestRepository $testRepository, $id): Response
    {
        return $this->render('consultant/evaluations/tests.html.twig', [
            'tests' => $testRepository->findByTechnoId($id),
            'isTest' => true
        ]);
    }
}
