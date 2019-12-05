<?php

namespace App\Controller;

use App\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class SinglePostController extends AbstractController
{

    public function index(int $id)
    {
        $post = $this->getDoctrine()->getRepository(Posts::class)->find($id);
        return $this->render('posts/single-post.html.twig', [
            'controller_name' => 'SinglePostController', 'post' => $post
        ]);
    }
}
