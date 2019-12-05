<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Posts;

class HomeController extends AbstractController
{
    public function index()
    {
        //TODO: get the data from post table

        $posts = $this->getDoctrine()->getRepository(Posts::class)->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController','posts' => $posts
        ]);
    }
}
