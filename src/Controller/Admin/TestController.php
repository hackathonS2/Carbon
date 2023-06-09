<?php

namespace App\Controller\Admin;

use App\Entity\Test;
use App\Form\TestType;
use App\Repository\TechnoRepository;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/test')]
class TestController extends AbstractController
{
    #[Route('/', name: 'app_admin_test_index', methods: ['GET'])]
    public function index(TestRepository $testRepository): Response
    {
        return $this->render('admin/test/index.html.twig', [
            'tests' => $testRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_test_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TestRepository $testRepository): Response
    {
        $test = new Test();
        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testRepository->save($test, true);

            return $this->redirectToRoute('app_admin_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/test/new.html.twig', [
            'test' => $test,
            'form' => $form,
        ]);
    }

    #[Route('/new/{id}', name: 'app_admin_test_new_by_id_techno', methods: ['GET', 'POST'])]
    public function newByIdTechno(Request $request, TestRepository $testRepository,$id,TechnoRepository $technoRepository): Response
    {
        $test = new Test();
        $techno = $technoRepository->find($id);
        if (empty($techno))
        {
            $this->redirectToRoute("admin_only");
        }
        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);
        $test->setIdTechno($techno);
        if ($form->isSubmitted() && $form->isValid()) {
            $testRepository->save($test, true);
            return $this->redirectToRoute('app_admin_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/test/new.html.twig', [
            'test' => $test,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_test_show', methods: ['GET'])]
    public function show(Test $test): Response
    {
        return $this->render('admin/test/show.html.twig', [
            'test' => $test,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_test_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Test $test, TestRepository $testRepository): Response
    {
        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testRepository->save($test, true);

            return $this->redirectToRoute('app_admin_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/test/edit.html.twig', [
            'test' => $test,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_test_delete', methods: ['POST'])]
    public function delete(Request $request, Test $test, TestRepository $testRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$test->getId(), $request->request->get('_token'))) {
            $testRepository->remove($test, true);
        }

        return $this->redirectToRoute('app_admin_test_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/techno/{id}', name: 'app_admin_test_show_techno', methods: ['GET'])]
    public function show_test_techno($id,TestRepository $testRepository, TechnoRepository $technoRepository)
    {
        $techno = $technoRepository->find($id);
        return $this->render('admin/test/test-techno.html.twig', [
            'tests' => $testRepository->findAll(),
            'techno' => $techno
        ]);
    }

}
