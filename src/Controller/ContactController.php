<?php

namespace App\Controller;

use App\Entity\ContactUs;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;




class ContactController extends AbstractController
{
    public function contact()
    {
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    public function contactAction(Request $request)
    {
        $form_data = $request->request->all();

        //TODO: validate fields

        $contactus = new ContactUs();
        $contactus->setName($form_data['name']);
        $contactus->setEmail($form_data['email']);
        $contactus->setSubject($form_data['subject']);
        $contactus->setMessage($form_data['message']);
        $contactus->setCreatedAt(new \DateTime('NOW'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contactus);
        $entityManager->flush();

        //TODO: Create js banner with confirmation

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

}

//        $form_data_mock = [
//            'name' => 'title',
//            'email' => '/src/images'
//            'subject' => '/src/images'
//            'message' => '/src/images'
//        ];
