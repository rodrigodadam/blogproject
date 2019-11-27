<?php


namespace App\Controller\admin;


use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends AbstractController
{

    public function newAuthor()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $author_mock = new Author();
        $author_mock->setName('Rodrigo');
        $author_mock->setEmail('rodrigo@gmail.com');
        $author_mock->setAbout('About the author 01');

        $entityManager->persist($author_mock);
        $entityManager->flush();

        return new Response('Saves a new author in database');
    }

}