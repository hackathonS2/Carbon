<?php

namespace App\Controller\Operationnel;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/operationnel/actualite')]
class ActualiteOperationnelController extends AbstractController
{
    #[Route('/', name: 'app_operationnel_actualite_index', methods: ['GET'])]
    public function index(ActualiteRepository $actualiteRepository): Response
    {
        return $this->render('admin/actualite/index.html.twig', [
            'actualites' => $actualiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_operationnel_actualite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActualiteRepository $actualiteRepository): Response
    {
        $actualite = new Actualite();
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actualiteRepository->save($actualite, true);

            return $this->redirectToRoute('app_operationnel_actualite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/actualite/new.html.twig', [
            'actualite' => $actualite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_operationnel_actualite_show', methods: ['GET'])]
    public function show(Actualite $actualite): Response
    {
        return $this->render('admin/actualite/show.html.twig', [
            'actualite' => $actualite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_operationnel_actualite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Actualite $actualite, ActualiteRepository $actualiteRepository): Response
    {
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actualiteRepository->save($actualite, true);

            return $this->redirectToRoute('app_admin_actualite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/actualite/edit.html.twig', [
            'actualite' => $actualite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_operationnel_actualite_delete', methods: ['POST'])]
    public function delete(Request $request, Actualite $actualite, ActualiteRepository $actualiteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actualite->getId(), $request->request->get('_token'))) {
            $actualiteRepository->remove($actualite, true);
        }

        return $this->redirectToRoute('app_admin_actualite_index', [], Response::HTTP_SEE_OTHER);
    }
}
