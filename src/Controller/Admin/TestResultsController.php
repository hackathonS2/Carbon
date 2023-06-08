<?php

namespace App\Controller\Admin;

use App\Entity\TestResults;
use App\Form\TestResultsType;
use App\Repository\TestResultsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/test/results')]
class TestResultsController extends AbstractController
{
    #[Route('/', name: 'app_admin_test_results_index', methods: ['GET'])]
    public function index(TestResultsRepository $testResultsRepository): Response
    {
        return $this->render('admin/test_results/index.html.twig', [
            'test_results' => $testResultsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_test_results_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TestResultsRepository $testResultsRepository): Response
    {
        $testResult = new TestResults();
        $form = $this->createForm(TestResultsType::class, $testResult);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testResultsRepository->save($testResult, true);

            return $this->redirectToRoute('app_admin_test_results_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/test_results/new.html.twig', [
            'test_result' => $testResult,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_test_results_show', methods: ['GET'])]
    public function show(TestResults $testResult): Response
    {
        return $this->render('admin/test_results/show.html.twig', [
            'test_result' => $testResult,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_test_results_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestResults $testResult, TestResultsRepository $testResultsRepository): Response
    {
        $form = $this->createForm(TestResultsType::class, $testResult);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testResultsRepository->save($testResult, true);

            return $this->redirectToRoute('app_admin_test_results_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/test_results/edit.html.twig', [
            'test_result' => $testResult,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_test_results_delete', methods: ['POST'])]
    public function delete(Request $request, TestResults $testResult, TestResultsRepository $testResultsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testResult->getId(), $request->request->get('_token'))) {
            $testResultsRepository->remove($testResult, true);
        }

        return $this->redirectToRoute('app_admin_test_results_index', [], Response::HTTP_SEE_OTHER);
    }
}
