<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;


class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="app_account")
     */
    public function newUser(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        //    public function newAuthor()
//    {
        $entityManager = $this->getDoctrine()->getManager();

        $user_mock = new User();
        $user_mock->setEmail('admin@gmail.com');
        $password = $passwordEncoder->encodePassword($user_mock, '123456');
        $user_mock->setPassword($password);
        $user_mock->setRoles(['ROLE_ADMIN']);


        $entityManager->persist($user_mock);
        $entityManager->flush();

        return new Response('Saves a new author in database');
    }
//        return $this->render('account/index.html.twig', [

//        ]);

}
