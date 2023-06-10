<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/admin/user/{id}', name: 'app_admin_user',methods: ['GET'])]
    public function admin_show_user(User $user): Response
    {

        return $this->render('admin/user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
