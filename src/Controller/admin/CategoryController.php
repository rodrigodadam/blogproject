<?php


namespace App\Controller\admin;



use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{

    //TODO: Change after to Single Resp.

    public function categoryList()
    {
        $categories = $this->getDoctrine()->getRepository(
            Category::class)->findAll();

        return $this->render('admin/category-list.html.twig', array(
            'categories' => $categories
        ));
    }

    public function categoryNew(Request $request)
    {
        $category = new Category();

        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_list');
        }

        return $this->render('admin/category-new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function categoryEdit(Request $request, $id)
    {
        $category = new Category();

        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('category_list');
        }

        return $this->render('admin/category-edit.html.twig', array(
            'form' => $form->createView()
        ));
    }


//    public function authorInfo($id)
//    {
//        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
//
//        return $this->render('admin/info-author.html.twig', array('author' => $author));
//    }

    public function categoryDelete(Request $request, $id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

//    public function newCategory(Request $request)
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $category_mock = new Category();
//        $category_mock->setName('LYFE STYLE');
//
//        $entityManager->persist($category_mock);
//        $entityManager->flush();
//
//        return new Response('Saves a category in database');


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
//    }


}