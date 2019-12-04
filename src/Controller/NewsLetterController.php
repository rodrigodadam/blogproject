<?php

namespace App\Controller;

use App\Entity\NewsLetter;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

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

        $email = (new TemplatedEmail())
            ->from(new Address('no-reply@blogproject.com', 'Blog Project'))
            ->to(new Address($newsLetter->getEmail()))
            ->subject('Thank you for sign our News Letter')
            ->htmlTemplate('email/news-letter.html.twig');

        $mailer->send($email);

        $previousRoute = $request->server->get('HTTP_REFERER');

        $routeToRedirect = explode("/",$previousRoute);

        $routeToRedirect[3] = $routeToRedirect[3] === "" ? "index" : $routeToRedirect[3];

        return $this->redirectToRoute($routeToRedirect[3]);

    }
}
