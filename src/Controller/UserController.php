<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\ConnectionType;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function userForms (EntityManagerInterface $em, Request $request) : Response{

        $user = new Users();
        $log_form = $this->createForm(ConnectionType::class, $user);
        $reg_form = $this->createForm(InscriptionType::class, $user);


        $this->formNewUser($em, $request, $user, $reg_form);


        return $this->render('user/index.html.twig', [
            'loginForm' => $log_form,
            'registerForm' => $reg_form,
        ]);
    }


    public function formConnectUser(EntityManagerInterface $em, Request $request, $user, $log_form)
    {

        $log_form->handleRequest($request);



    }

    public function formNewUser(EntityManagerInterface $em, Request $request, $user, $reg_form)
    {

        $reg_form->handleRequest($request);

        if ($reg_form->isSubmitted() && $reg_form->isValid()){
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_main');

        }

    }
}
