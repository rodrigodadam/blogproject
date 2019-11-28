<?php


namespace App\Controller\admin;


use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends AbstractController
{

    //TODO: Change after to Single Resp.

    public function authorList()
    {
        $authors = $this->getDoctrine()->getRepository(
            Author::class)->findAll();

        return $this->render('admin/author-list.html.twig', array(
            'authors' => $authors
        ));
    }

    public function authorNew(Request $request)
    {
        $author = new Author();

        $form = $this->createFormBuilder($author)
            ->add('name', TextType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('email', EmailType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('about', TextareaType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('author_list');
        }

        return $this->render('admin/author-new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function authorEdit(Request $request, $id)
    {
        $author = new Author();

        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        $form = $this->createFormBuilder($author)
            ->add('name', TextType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('email', EmailType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('about', TextareaType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('author_list');
        }

        return $this->render('admin/author-edit.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function authorInfo($id)
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        return $this->render('admin/author-info.html.twig', array('author' => $author));
    }

    public function authorDelete(Request $request, $id)
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($author);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

//    public function newAuthor()
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $author_mock = new Author();
//        $author_mock->setName('Leticia');
//        $author_mock->setEmail('leticia@gmail.com');
//        $author_mock->setAbout('About the author 02');
//
//        $entityManager->persist($author_mock);
//        $entityManager->flush();
//
//        return new Response('Saves a new author in database');
//    }

}