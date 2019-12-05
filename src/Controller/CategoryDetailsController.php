<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryDetailsController extends AbstractController
{

    public function index(int $category_id)
    {

        $posts = $this->getDoctrine()->getRepository(Posts::class)->findBy(['category'=> $category_id]);
        $category = $this->getDoctrine()->getRepository(Category::class)->find($category_id);

        return $this->render('category_details/index.html.twig', [
            'controller_name' => 'CategoryDetailsController', 'posts' => $posts, 'category' => $category
        ]);
    }
}
