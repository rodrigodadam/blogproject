<?php


namespace App\Controller\Posts;

use App\Repository;
use App\Entity\Category;
use App\Entity\Author;
use App\Entity\Posts;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{

    public function postList()
    {
        $posts = $this->getDoctrine()->getRepository(
            Posts::class)->findAll();

        return $this->render('post/post-list.html.twig', array(
            'authors' => $posts
        ));
    }

//    public function postNew(Request $request, $name)
//    {
//        $post = new Posts();
//        $author = $this->getDoctrine()->getRepository(Author::class)->find($name);
//        $category = $this->getDoctrine()->getRepository(Category::class)->find($name);
//
//        $form = $this->createFormBuilder($post)
//            ->add('title', TextType::class, array(
//                'required' => true,
//                'attr' => array('class' => 'form-control')))
//            ->add('content', TextareaType::class, array(
//                'required' => true,
//                'attr' => array('class' => 'form-control')))
//            ->add('banner', FileType::class, array(
//                'required' => true,
//                'attr' => array('class' => 'form-control')))
//            ->add('author_id', Select::class)
//            ->add('save', SubmitType::class, array(
//                'label' => 'Create',
//                'attr' => array('class' => 'btn btn-primary mt-3')
//            ))
//            ->getForm();
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($post);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('post_list');
//        }
//
//        return $this->render('posts/post-new.html.twig', array(
//            'form' => $form->createView()
//        ));
//    }

        public function postNew(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $post_mock = new Posts();
        $post_mock->setTitle('First Title');
        $post_mock->setBanner('public/assets/img/blog-img/blog01.jpg');
        $post_mock->setContent('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
        $post_mock->setNumberOfComments('3');
        $post_mock->setCreatedAt(new \DateTime('NOW'));
        $post_mock->getCategory($this->getUser());

        $entityManager->persist($post_mock);
        $entityManager->flush();

        return new Response('Saves a category in database');


    }
}