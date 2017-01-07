<?php

namespace booksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use booksBundle\Entity\book;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class AdController extends Controller
{
       public function addAction(Request $request)
    {
        $book = new Book();
        $form = $this->createForm('booksBundle\Form\adType', $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $book->upload();
            $em->persist($book);
            $em->flush($book);

            return $this->redirectToRoute('frontEnd_searchBooks', array('id' => $book->getId()));
        }

        return $this->render('booksBundle:ad:helloAD.html.twig', array(
            'book' => $book,
            'form' => $form->createView(),
        ));
    }
       
}
