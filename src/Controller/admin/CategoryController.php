<?php


namespace App\Controller\admin;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{

    public function newCategory(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $category_mock = new Category();
        $category_mock->setName('LYFE STYLE');

        $entityManager->persist($category_mock);
        $entityManager->flush();

        return new Response('Saves a category in database');


//        $form_data_mock = $request->request->all();
//        $form_data_mock = [
//            'name' => 'Design',
//        ];
//
//        //TODO: validate fields
//
//        $category = new Category();
//        $category->setName($form_data_mock['name']);
//
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($category);
//        $entityManager->flush();
//
//        //TODO: Create js banner with confirmation
//
//        return $this->render('home/home.html.twig', [
//            'controller_name' => 'HomeController',
//        ]);
    }


}