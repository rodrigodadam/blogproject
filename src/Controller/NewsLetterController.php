<?php

namespace App\Controller;

use App\Entity\NewsLetter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class NewsLetterController extends AbstractController
{

    public function index()
    {
        return $this->render('news_letter/index.html.twig', [
            'controller_name' => 'NewsLetterController',
        ]);
    }

    public function newsLetterAction(Request $request, MailerInterface $mailer)
    {

        $form_data = $request->request->all();

        //TODO: validate fields


        $newsLetter = new NewsLetter();
        $newsLetter->setEmail($form_data['email']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($newsLetter);
        $entityManager->flush();


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);

    }
}
