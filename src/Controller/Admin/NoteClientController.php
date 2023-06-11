<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MissionRepository;
use App\Entity\Mission;
use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/admin/note-client')]
class NoteClientController extends AbstractController
{
    #[Route('/form_feeback_client/{id}', name: 'app_note_client_index', methods: ['GET'])]
    public function index(UserRepository $userRepository,MissionRepository $missionRepository ,$id): Response
    {
        $mission = $missionRepository->findOneBy(['id' => $id]);
        $user = $mission->getConsultant();

        return $this->render('admin/note_client/index.html.twig', [
            'user' => $user,
            'mission' => $mission,
        ]);
    }

    #[Route('/{id}', name: 'note_client_missions', methods: ['GET'])]
    public function index_consultant(MissionRepository $missionRepository, $id ): Response
    {
        return $this->render('admin/note_client/missions.html.twig', [
            'controller_name' => 'NoteClientController',
            'missions' => $missionRepository->findByMissionId($id),
        ]);
    }

    #[Route('/form_feeback_client/{id}', name: 'form_feeback_client', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function feeback_client( Request $request, Mission $mission, UserRepository $userRepository, MissionRepository $missionRepository, EntityManagerInterface $entityManager): Response
    {
     
        //handle rating
        $rate = $request->request->get('mission_note');
        $comment = $request->request->get('user_comment');

        //handle a comment post
        if($comment && $request->request->get('mission_id') && $rate){

            $note = new Note();
            $note->setMission($mission);
            $note->setEval($rate);
            $note->setCommentaire($comment);


            //update average note
            $noteGlobale = 0;
            $notes = $mission->getClientNotes()->unwrap()->toArray();

            for ($i=0; $i < count($notes) ; $i++) {
                $noteGlobale = $noteGlobale + $notes[$i]->getEval();
            }

            $noteGlobale = $noteGlobale + $rate;

            $mission->setNote(count($notes)>0 ? round($noteGlobale/count($notes)+ 1) : $rate);


            $entityManager->persist($note);
            $entityManager->persist($mission);

            $entityManager->flush();
            $request->request->remove('user_comment');
            $request->request->remove('mission_id');
            $request->request->remove('rating-'.$rate);
            return $this->redirect($request->getUri());
        }

        $updated_mission = $missionRepository->findOneBy(['id' => $mission->getId()]);
        $user = $mission->getConsultant();

        return $this->render('admin/note_client/index.html.twig', [
            'user' => $user,
            'mission' => $updated_mission,
        ]);
    }

}
