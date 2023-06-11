<?php

namespace App\Controller\Consultant;

use App\Entity\Test;
use App\Entity\TestResults;
use App\Form\DoTestType;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use App\Repository\FavoritesRepository;
use App\Repository\SoftSkillsRepository;

use Doctrine\ORM\EntityManagerInterface;
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
use Symfony\Component\Security\Core\User\UserInterface;

class EvaluationController extends AbstractController
{
    #[Route('/evaluations', name: 'consultant_evaluations')]
    public function index_consultant(): Response
    {
        return $this->render('consultant/evaluations/index.html.twig', [
            'controller_name' => 'EvaluationController'
        ]);
    }


    #[Route('/consultant/evualuation/resulat/{id}', name: 'consultant_evaluations')]
    public function do_test(Test $test,UserInterface $user,EntityManagerInterface $entityManager)
    {
        foreach ($user->getTestResults() as $mestest)
        {
            if ($mestest->getIdTest()->getNom() == $test->getNom())
            {
                $this->addFlash('error',"Vous avec déjà passer ce test");
                return $this->redirectToRoute('tests_by_techno',['id'=> $test->getId()]);
            }
        }
        $testresult = new TestResults();
        $testresult->setIdTest($test);
        $testresult->setIdUser($user);
        $testresult->setResult(rand(20,100));
        $testresult->setDate(new \DateTime());
        $entityManager->persist($testresult);
        $entityManager->flush();
        if ($test->getDifficulte() == 1)
        {
            $niv = "Starter";
        }
        elseif ($test->getDifficulte() == 2)
        {
            $niv = "Intermediare";
        }
        else{
            $niv = "Expert";
        }
        $testnom = $test->getNom();
        $note = $testresult->getResult();
        if($note>= 60)
        {
            $this->addFlash('success',"Félicitation Vous avec passé le test $testnom de niveau $niv, Vous aves eu $note/100, Vous avez eu le diplôme");
        }
        else
        {
            $this->addFlash('error',"Dommage, Vous avec passé le test $testnom de niveau $niv, Vous aves eu $note/100, Vous n'avez pas eu le diplôme");
        }
        return $this->redirectToRoute('tests_by_techno',['id'=> $test->getId()]);

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
