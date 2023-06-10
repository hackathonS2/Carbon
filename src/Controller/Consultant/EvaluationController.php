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
use App\Repository\TestRepository;
use App\Repository\TestResultsRepository;
use App\Repository\MissionRepository;
use stdClass;

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
    #[Route('/consultant/home/formations/{id}', name: 'tests_by_techno', methods: ['GET'])]
    public function indexByTechno(TestRepository $testRepository,MissionRepository $missionRepository, TechnoRepository $technoRepository, SoftSkillsRepository $softskillrepo,  $id): Response
    {
        $tech = $technoRepository->find($id); 
        $monUser =  $this->getUser();
        $testResults = [];
        $techno = null;
        foreach ($monUser->getTestResults() as $testResult) {
            if ($testResult->getIdTest()->getIdTechno()->getId() == $id) {
                $testResults[] = $testResult;
                $techno = $testResult->getIdTest()->getIdTechno();
            }
        }
        // conver $testResults to array
        $testResults = array_map(function ($testResult) {
            return [
                'id' => $testResult->getId(),
                'idTest' => $testResult->getIdTest()->getId(),
                'idTechno' => $testResult->getIdTest()->getIdTechno()->getId(),
                'idUser' => $testResult->getIdUser()->getId(),
                'result' => $testResult->getResult(),
                'date' => $testResult->getDate()->format('Y-m-d H:i:s')
            ];
        }, $testResults);

        $user_id =  $this->getUser()->getId();
        $mySoftskillrepo = $softskillrepo->findBy(
            ['idUser' => $user_id]
        );

        return $this->render('consultant/evaluations/tests.html.twig', [
            'tests' => $testRepository->findByTechnoId($id),
            'testResults' => $testResults,
            'technos' => [],
            'missions' => $missionRepository->findByMissionId($user_id),
            'techno' => $techno,
            'tech' => $tech,
            'mySoftskills' => $mySoftskillrepo,
        ]);
    }


}
